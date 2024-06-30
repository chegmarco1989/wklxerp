<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionSellLine extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(\App\Transaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Product::class, 'product_id');
    }

    public function variations(): BelongsTo
    {
        return $this->belongsTo(\App\Variation::class, 'variation_id');
    }

    public function modifiers(): HasMany
    {
        return $this->hasMany(\App\TransactionSellLine::class, 'parent_sell_line_id')
            ->where('children_type', 'modifier');
    }

    public function sell_line_purchase_lines(): HasMany
    {
        return $this->hasMany(\App\TransactionSellLinesPurchaseLines::class, 'sell_line_id');
    }

    /**
     * Get the quantity column.
     *
     * @return float $value
     */
    public function getQuantityAttribute(string $value): float
    {
        return (float) $value;
    }

    public function lot_details(): BelongsTo
    {
        return $this->belongsTo(\App\PurchaseLine::class, 'lot_no_line_id');
    }

    public function get_discount_amount()
    {
        $discount_amount = 0;
        if (! empty($this->line_discount_type) && ! empty($this->line_discount_amount)) {
            if ($this->line_discount_type == 'fixed') {
                $discount_amount = $this->line_discount_amount;
            } elseif ($this->line_discount_type == 'percentage') {
                $discount_amount = ($this->unit_price_before_discount * $this->line_discount_amount) / 100;
            }
        }

        return $discount_amount;
    }

    /**
     * Get the unit associated with the purchase line.
     */
    public function sub_unit(): BelongsTo
    {
        return $this->belongsTo(\App\Unit::class, 'sub_unit_id');
    }

    public function order_statuses()
    {
        $statuses = [
            'received',
            'cooked',
            'served',
        ];
    }

    public function service_staff(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'res_service_staff_id');
    }

    /**
     * The warranties that belong to the sell lines.
     */
    public function warranties(): BelongsToMany
    {
        return $this->belongsToMany(\App\Warranty::class, 'sell_line_warranties', 'sell_line_id', 'warranty_id');
    }

    public function line_tax(): BelongsTo
    {
        return $this->belongsTo(\App\TaxRate::class, 'tax_id');
    }

    public function so_line(): BelongsTo
    {
        return $this->belongsTo(\App\TransactionSellLine::class, 'so_line_id');
    }
}
