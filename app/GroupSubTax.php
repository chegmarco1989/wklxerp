<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupSubTax extends Model
{
    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(\App\TaxRate::class, 'group_tax_id');
    }
}
