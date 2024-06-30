<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariationValueTemplate extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the variation that owns the attribute.
     */
    public function variationTemplate(): BelongsTo
    {
        return $this->belongsTo(\App\VariationTemplate::class);
    }
}
