<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypesOfService extends Model
{
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
            'location_price_group' => 'array',
        ];
    }

    /**
     * Return list of types of service for a business
     */
    public static function forDropdown(int $business_id): array
    {
        $types_of_service = TypesOfService::where('business_id', $business_id)
            ->pluck('name', 'id');

        return $types_of_service;
    }
}
