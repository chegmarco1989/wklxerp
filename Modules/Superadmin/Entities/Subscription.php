<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'package_details' => 'array',    ];

    /**
     * Scope a query to only include approved subscriptions.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    public function scopeDeclined($query)
    {
        return $query->where('status', 'declined');
    }

    /**
     * Get the package that belongs to the subscription.
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo('\Modules\Superadmin\Entities\Package')
            ->withTrashed();
    }

    /**
     * Returns the active subscription details for a business
     *
     * @param  $business_id  int
     */
    public static function active_subscription($business_id): Response
    {
        $date_today = \Carbon::today()->toDateString();

        $subscription = Subscription::where('business_id', $business_id)
            ->whereDate('start_date', '<=', $date_today)
            ->whereDate('end_date', '>=', $date_today)
            ->approved()
            ->first();

        return $subscription;
    }

    /**
     * Returns the upcoming subscription details for a business
     *
     * @param  $business_id  int
     */
    public static function upcoming_subscriptions($business_id): Response
    {
        $date_today = \Carbon::today();

        $subscription = Subscription::where('business_id', $business_id)
            ->whereDate('start_date', '>', $date_today)
            ->approved()
            ->get();

        return $subscription;
    }

    /**
     * Returns the subscriptions waiting for approval for superadmin
     *
     * @param  $business_id  int
     */
    public static function waiting_approval($business_id): Response
    {
        $subscriptions = Subscription::where('business_id', $business_id)
            ->whereNull('start_date')
            ->waiting()
            ->get();

        return $subscriptions;
    }

    public static function end_date($business_id)
    {
        $date_today = \Carbon::today();

        $subscription = Subscription::where('business_id', $business_id)
            ->approved()
            ->select(DB::raw('MAX(end_date) as end_date'))
            ->first();

        if (empty($subscription->end_date)) {
            return $date_today;
        } else {
            $end_date = $subscription->end_date->addDay();
            if ($date_today->lte($end_date)) {
                return $end_date;
            } else {
                return $date_today;
            }
        }
    }

    /**
     * Returns the list of packages status
     */
    public static function package_subscription_status(): array
    {
        return ['approved' => trans('superadmin::lang.approved'), 'declined' => trans('superadmin::lang.declined'), 'waiting' => trans('superadmin::lang.waiting')];
    }

    /**
     * Get the created_by.
     */
    public function created_user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_id');
    }

    /**
     * Get the subscription business relationship.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(\App\Business::class, 'business_id');
    }
}
