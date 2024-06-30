<?php

namespace Modules\Hms\Entities;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HmsRoomType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function Rooms(): HasMany
    {
        return $this->hasMany(HmsRoom::class);
    }

    public function Pricings(): HasMany
    {
        return $this->hasMany(HmsRoomTypePricing::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    /**
     * Get the project categories.
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(\App\Category::class, 'categorizable');
    }
}
