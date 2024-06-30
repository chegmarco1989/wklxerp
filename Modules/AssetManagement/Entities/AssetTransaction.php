<?php

namespace Modules\AssetManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetTransaction extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * get asset for transaction
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo('Modules\AssetManagement\Entities\Asset', 'asset_id');
    }

    public function revokeTransaction(): HasMany
    {
        return $this->hasMany('Modules\AssetManagement\Entities\AssetTransaction', 'parent_id');
    }
}
