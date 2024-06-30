<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Transaction;

class ProjectTransaction extends Transaction
{
    /**
     * Get the invoice lines for the transaction.
     */
    public function invoiceLines(): HasMany
    {
        return $this->hasMany('Modules\Project\Entities\InvoiceLine', 'transaction_id');
    }

    /**
     * Get the project for the transaction.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'pjt_project_id');
    }

    /**
     * Returns the list of invoice status.
     */
    public static function invoiceStatuses()
    {
        return [
            'final' => __('sale.final'),
            'draft' => __('sale.draft'),
        ];
    }
}
