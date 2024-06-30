<?php

namespace App\Utils;

use App\TaxRate;

class TaxUtil extends Util
{
    /**
     * Updates tax amount of a tax group
     */
    public function updateGroupTaxAmount(int $group_tax_id): void
    {
        $amount = 0;
        $tax_rate = TaxRate::where('id', $group_tax_id)->with(['sub_taxes'])->first();
        foreach ($tax_rate->sub_taxes as $sub_tax) {
            $amount += $sub_tax->amount;
        }
        $tax_rate->amount = $amount;
        $tax_rate->save();
    }
}
