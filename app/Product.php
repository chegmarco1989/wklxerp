<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['image_url'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sub_unit_ids' => 'array',
    ];

    /**
     * Get the products image.
     */
    public function getImageUrlAttribute(): string
    {
        if (! empty($this->image)) {
            $image_url = asset('/uploads/img/'.rawurlencode($this->image));
        } else {
            $image_url = asset('/img/default.png');
        }

        return $image_url;
    }

    /**
     * Get the products image path.
     */
    public function getImagePathAttribute(): string
    {
        if (! empty($this->image)) {
            $image_path = public_path('uploads').'/'.config('constants.product_img_path').'/'.$this->image;
        } else {
            $image_path = null;
        }

        return $image_path;
    }

    public function product_variations(): HasMany
    {
        return $this->hasMany(\App\ProductVariation::class);
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(\App\Brands::class);
    }

    /**
     * Get the unit associated with the product.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(\App\Unit::class);
    }

    /**
     * Get the unit associated with the product.
     */
    public function second_unit(): BelongsTo
    {
        return $this->belongsTo(\App\Unit::class, 'secondary_unit_id');
    }

    /**
     * Get category associated with the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Category::class);
    }

    /**
     * Get sub-category associated with the product.
     */
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(\App\Category::class, 'sub_category_id', 'id');
    }

    /**
     * Get the tax associated with the product.
     */
    public function product_tax(): BelongsTo
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax', 'id');
    }

    /**
     * Get the variations associated with the product.
     */
    public function variations(): HasMany
    {
        return $this->hasMany(\App\Variation::class);
    }

    /**
     * If product type is modifier get products associated with it.
     */
    public function modifier_products(): BelongsToMany
    {
        return $this->belongsToMany(\App\Product::class, 'res_product_modifier_sets', 'modifier_set_id', 'product_id');
    }

    /**
     * If product type is modifier get products associated with it.
     */
    public function modifier_sets(): BelongsToMany
    {
        return $this->belongsToMany(\App\Product::class, 'res_product_modifier_sets', 'product_id', 'modifier_set_id');
    }

    /**
     * Get the purchases associated with the product.
     */
    public function purchase_lines(): HasMany
    {
        return $this->hasMany(\App\PurchaseLine::class);
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('products.is_inactive', 0);
    }

    /**
     * Scope a query to only include inactive products.
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('products.is_inactive', 1);
    }

    /**
     * Scope a query to only include products for sales.
     */
    public function scopeProductForSales(Builder $query): Builder
    {
        return $query->where('not_for_selling', 0);
    }

    /**
     * Scope a query to only include products not for sales.
     */
    public function scopeProductNotForSales(Builder $query): Builder
    {
        return $query->where('not_for_selling', 1);
    }

    public function product_locations(): BelongsToMany
    {
        return $this->belongsToMany(\App\BusinessLocation::class, 'product_locations', 'product_id', 'location_id');
    }

    /**
     * Scope a query to only include products available for a location.
     */
    public function scopeForLocation(Builder $query, $location_id): Builder
    {
        return $query->where(function ($q) use ($location_id) {
            $q->whereHas('product_locations', function ($query) use ($location_id) {
                $query->where('product_locations.location_id', $location_id);
            });
        });
    }

    /**
     * Get warranty associated with the product.
     */
    public function warranty(): BelongsTo
    {
        return $this->belongsTo(\App\Warranty::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function rack_details(): HasMany
    {
        return $this->hasMany(\App\ProductRack::class);
    }
}
