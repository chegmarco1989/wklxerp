<?php

namespace Modules\Hms\Entities;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Transaction;

class HmsTransactionClass extends Transaction
{
    public function hms_booking_lines(): HasMany
    {
        return $this->hasMany(\Modules\Hms\Entities\HmsBookingLine::class, 'transaction_id', 'id');
    }

    public function hms_booking_extras(): HasMany
    {
        return $this->hasMany(\Modules\Hms\Entities\HmsBookingExtra::class, 'transaction_id', 'id');
    }
}
