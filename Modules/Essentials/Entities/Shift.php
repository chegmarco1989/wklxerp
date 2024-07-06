<?php

namespace Modules\Essentials\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'essentials_shifts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'holidays' => 'array',
        ];
    }

    public function user_shifts($value = ''): HasMany
    {
        return $this->hasMany(\Modules\Essentials\Entities\EssentialsUserShift::class, 'essentials_shift_id');
    }

    public static function getGivenShiftInfo($business_id, $shift_id)
    {
        $shift = Shift::where('business_id', $business_id)
            ->find($shift_id);

        return $shift;
    }
}
