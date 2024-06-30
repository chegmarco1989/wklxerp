<?php

namespace Modules\Essentials\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EssentialsHoliday extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function location(): BelongsTo
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }
}
