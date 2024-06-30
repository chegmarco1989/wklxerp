<?php

namespace App;

use App\Notifications\RegisterSuccessful;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
// Implémentation de MessengerProvider et de la Façade de "Messenger" (https://github.com/RTippin/messenger):
use Laravel\Passport\HasApiTokens;
use RTippin\Messenger\Contracts\MessengerProvider;
use RTippin\Messenger\Facades\Messenger;
use RTippin\Messenger\Traits\Messageable;
use RTippin\Messenger\Traits\Search;						// AJOUTE
use Spatie\Permission\Traits\HasRoles;				// Notification généré avec "php artisan make:notification RegisterSuccessful"

class User extends Authenticatable implements MessengerProvider
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;

    //Default trait to satisfy MessengerProvider interface:
    use Messageable;
    use Notifiable;
    use Search;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    /**
     * Get the business that owns the user.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(\App\Business::class);
    }

    public function scopeUser($query)
    {
        return $query->where('users.user_type', 'user');
    }

    /**
     * The contact the user has access to.
     * Applied only when selected_contacts is true for a user in
     * users table
     */
    public function contactAccess(): BelongsToMany
    {
        return $this->belongsToMany(\App\Contact::class, 'user_contact_access');
    }

    /**
     * Get all of the users's notes & documents.
     */
    public function documentsAndnote(): MorphMany
    {
        return $this->morphMany(\App\DocumentAndNote::class, 'notable');
    }

    /**
     * Creates a new user based on the input provided.
     */
    public static function create_user($details): object
    {
        $user = User::create([
            'surname' => $details['surname'],
            'first_name' => $details['first_name'],
            'last_name' => $details['last_name'],
            'username' => $details['username'],
            'email' => $details['email'],
            'password' => Hash::make($details['password']),
            'name' => $details['surname'].' '.$details['first_name'],
            'language' => ! empty($details['language']) ? $details['language'] : 'en',
        ]);

        if ($user) {
            // Set the application's locale to the user's preferred language
            App::setLocale($user->language);

            // Send the notification to the newly created user
            $user->notify(new RegisterSuccessful($user->username));

            Messenger::getProviderMessenger($user);				// USAGE de "Messenger" (https://github.com/RTippin/messenger) importé ci-dessus.
        }

        return $user;
    }

    /**
     * Gives locations permitted for the logged in user
     *
     * @param: int $business_id
     *
     * @return string or array
     */
    public function permitted_locations($business_id = null): string
    {
        $user = $this;

        if ($user->can('access_all_locations')) {
            return 'all';
        } else {
            $business_id = ! is_null($business_id) ? $business_id : null;
            if (empty($business_id) && auth()->check()) {
                $business_id = auth()->user()->business_id;
            }
            if (empty($business_id) && session()->has('business')) {
                $business_id = session('business.id');
            }

            $permitted_locations = [];
            $all_locations = BusinessLocation::where('business_id', $business_id)->get();
            foreach ($all_locations as $location) {
                if ($user->can('location.'.$location->id)) {
                    $permitted_locations[] = $location->id;
                }
            }

            return $permitted_locations;
        }
    }

    /**
     * Returns if a user can access the input location
     *
     * @param: int $location_id
     */
    public static function can_access_this_location($location_id, $business_id = null): bool
    {
        $permitted_locations = auth()->user()->permitted_locations($business_id);

        if ($permitted_locations == 'all' || in_array($location_id, $permitted_locations)) {
            return true;
        }

        return false;
    }

    public function scopeOnlyPermittedLocations($query)
    {
        $user = auth()->user();
        $permitted_locations = $user->permitted_locations();
        $is_admin = $user->hasAnyPermission('Admin#'.$user->business_id);
        if ($permitted_locations != 'all' && ! $user->can('superadmin') && ! $is_admin) {
            $permissions = ['access_all_locations'];
            foreach ($permitted_locations as $location_id) {
                $permissions[] = 'location.'.$location_id;
            }

            return $query->whereHas('permissions', function ($q) use ($permissions) {
                $q->whereIn('permissions.name', $permissions);
            });
        } else {
            return $query;
        }
    }

    /**
     * Return list of users dropdown for a business
     *
     * @param  $business_id  int
     * @param  $prepend_none  = true (boolean)
     * @param  $include_commission_agents  = false (boolean)
     * @return array users
     */
    public static function forDropdown($business_id, $prepend_none = true, $include_commission_agents = false, $prepend_all = false, $check_location_permission = false): array
    {
        $query = User::where('business_id', $business_id)
            ->user();

        if (! $include_commission_agents) {
            $query->where('is_cmmsn_agnt', 0);
        }

        if ($check_location_permission) {
            $query->onlyPermittedLocations();
        }

        $all_users = $query->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"))->get();
        $users = $all_users->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        //Prepend all
        if ($prepend_all) {
            $users = $users->prepend(__('lang_v1.all'), '');
        }

        return $users;
    }

    /**
     * Return list of sales commission agents dropdown for a business
     *
     * @param  $business_id  int
     * @param  $prepend_none  = true (boolean)
     * @return array users
     */
    public static function saleCommissionAgentsDropdown($business_id, $prepend_none = true): array
    {
        $all_cmmsn_agnts = User::where('business_id', $business_id)
            ->where('is_cmmsn_agnt', 1)
            ->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"));

        $users = $all_cmmsn_agnts->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        return $users;
    }

    /**
     * Return list of users dropdown for a business
     *
     * @param  $business_id  int
     * @param  $prepend_none  = true (boolean)
     * @param  $prepend_all  = false (boolean)
     * @return array users
     */
    public static function allUsersDropdown($business_id, $prepend_none = true, $prepend_all = false): array
    {
        $all_users = User::where('business_id', $business_id)
            ->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"));

        $users = $all_users->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        //Prepend all
        if ($prepend_all) {
            $users = $users->prepend(__('lang_v1.all'), '');
        }

        return $users;
    }

    /**
     * Get the user's full name.
     */
    public function getUserFullNameAttribute(): string
    {
        return "{$this->surname} {$this->first_name} {$this->last_name}";
    }

    /**
     * Return true/false based on selected_contact access
     */
    public static function isSelectedContacts($user_id): bool
    {
        $user = User::findOrFail($user_id);

        return (bool) $user->selected_contacts;
    }

    public function getRoleNameAttribute()
    {
        $role_name_array = $this->getRoleNames();
        $role_name = ! empty($role_name_array[0]) ? explode('#', $role_name_array[0])[0] : '';

        return $role_name;
    }

    public function media()
    {
        return $this->morphOne(\App\Media::class, 'model');
    }

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username): User
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Get the contact for the user.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(\Modules\Crm\Entities\CrmContact::class, 'crm_contact_id');
    }

    /**
     * Get the products image.
     */
    public function getImageUrlAttribute(): string
    {
        if (isset($this->media->display_url)) {
            $img_src = $this->media->display_url;
        } else {
            $img_src = 'https://ui-avatars.com/api/?name='.$this->first_name;
        }

        return $img_src;
    }

    /* 1er USAGE de "MessengerProvider" (https://github.com/RTippin/messenger) à travers la méthode "getProviderSettings" :*/
    public static function getProviderSettings(): array
    {
        return [
            'alias' => 'user',
            'searchable' => true,
            'friendable' => true,
            'devices' => true,
            'default_avatar' => public_path('vendor/messenger/images/users.png'),
            'cant_message_first' => [],
            'cant_search' => [],
            'cant_friend' => [],
        ];
    }

    /* 2ème USAGE de "MessengerProvider" (https://github.com/RTippin/messenger) à travers la méthode "getProviderAvatarColumn" :*/
    //User model override (Réécriture ou écrasement de la méthode "getProviderAvatarColumn" appelant la colonne "messenger_avatar" de la Migration "users"):
    public function getProviderAvatarColumn(): string
    {
        return 'messenger_avatar';
    }

    // AJOUTE POUR RECUPERER LA LANGUE
    public function preferredLocale()
    {
        // Here you retrieve the user's preferred language from the 'language' column
        return $this->language;
    }
}
