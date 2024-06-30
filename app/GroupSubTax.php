<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class GroupSubTax extends Model
{
    public function tax_rate(): BelongsTo
    {
        return $this->belongsTo(\App\TaxRate::class, 'group_tax_id');
    }
}
