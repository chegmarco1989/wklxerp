<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class InvoiceLayout extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_custom_fields' => 'array',
        'contact_custom_fields' => 'array',
        'location_custom_fields' => 'array',
        'common_settings' => 'array',
        'qr_code_fields' => 'array',
    ];

    /**
     * Get the location associated with the invoice layout.
     */
    public function locations(): HasMany
    {
        return $this->hasMany(\App\BusinessLocation::class);
    }

    /**
     * Return list of invoice layouts for a business
     */
    public static function forDropdown(int $business_id): array
    {
        $layouts = InvoiceLayout::where('business_id', $business_id)
            ->pluck('name', 'id');

        return $layouts;
    }
}
