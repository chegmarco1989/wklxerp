<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CashRegister extends Model
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
            'denominations' => 'array',
        ];
    }

    /**
     * Get the Cash registers transactions.
     */
    public function cash_register_transactions(): HasMany
    {
        return $this->hasMany(\App\CashRegisterTransaction::class);
    }
}
