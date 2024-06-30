<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function sub_types(): HasMany
    {
        return $this->hasMany(\App\AccountType::class, 'parent_account_type_id');
    }

    public function parent_account(): BelongsTo
    {
        return $this->belongsTo(\App\AccountType::class, 'parent_account_type_id');
    }
}
