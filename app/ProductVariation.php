<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function variations(): HasMany
    {
        return $this->hasMany(\App\Variation::class);
    }

    public function variation_template(): BelongsTo
    {
        return $this->belongsTo(\App\VariationTemplate::class);
    }
}
