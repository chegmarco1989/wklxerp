<?php

namespace Modules\AssetManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AssetMaintenance extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    /**
     * user added asset.
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(\Modules\AssetManagement\Entities\Asset::class, 'asset_id');
    }

    /**
     * user added asset maintence.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    /**
     * user assigned asset maintence.
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'assigned_to');
    }
}
