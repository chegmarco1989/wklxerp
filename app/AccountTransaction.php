<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTransaction extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'operation_date' => 'datetime',
        ];
    }

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(\App\Transaction::class, 'transaction_id');
    }

    /**
     * Gives account transaction type from payment transaction type
     *
     * @param  string  $payment_transaction_type
     */
    public static function getAccountTransactionType($tansaction_type): string
    {
        $account_transaction_types = [
            'sell' => 'credit',
            'purchase' => 'debit',
            'expense' => 'debit',
            'purchase_return' => 'credit',
            'sell_return' => 'debit',
            'payroll' => 'debit',
            'expense_refund' => 'credit',
            'hms_booking' => 'credit',
        ];

        return $account_transaction_types[$tansaction_type];
    }

    /**
     * Creates new account transaction
     */
    public static function createAccountTransaction($data): obj
    {
        $transaction_data = [
            'amount' => $data['amount'],
            'account_id' => $data['account_id'],
            'type' => $data['type'],
            'sub_type' => ! empty($data['sub_type']) ? $data['sub_type'] : null,
            'operation_date' => ! empty($data['operation_date']) ? $data['operation_date'] : \Carbon::now(),
            'created_by' => $data['created_by'],
            'transaction_id' => ! empty($data['transaction_id']) ? $data['transaction_id'] : null,
            'transaction_payment_id' => ! empty($data['transaction_payment_id']) ? $data['transaction_payment_id'] : null,
            'note' => ! empty($data['note']) ? $data['note'] : null,
            'transfer_transaction_id' => ! empty($data['transfer_transaction_id']) ? $data['transfer_transaction_id'] : null,
        ];

        $account_transaction = AccountTransaction::create($transaction_data);

        return $account_transaction;
    }

    /**
     * Updates transaction payment from transaction payment
     *
     * @param  array  $inputs
     */
    public static function updateAccountTransaction(obj $transaction_payment, string $transaction_type): string
    {
        if (! empty($transaction_payment->account_id)) {
            $account_transaction = AccountTransaction::where(
                'transaction_payment_id',
                $transaction_payment->id
            )
                ->first();
            if (! empty($account_transaction)) {
                $account_transaction->amount = $transaction_payment->amount;
                $account_transaction->account_id = $transaction_payment->account_id;
                $account_transaction->operation_date = $transaction_payment->paid_on;
                $account_transaction->save();

                return $account_transaction;
            } else {
                $accnt_trans_data = [
                    'amount' => $transaction_payment->amount,
                    'account_id' => $transaction_payment->account_id,
                    'type' => empty($transaction_type) ? $transaction_payment->payment_type : self::getAccountTransactionType($transaction_type),
                    'operation_date' => $transaction_payment->paid_on,
                    'created_by' => $transaction_payment->created_by,
                    'transaction_id' => $transaction_payment->transaction_id,
                    'transaction_payment_id' => $transaction_payment->id,
                ];

                //If change return then set type as debit
                if (! empty($transaction_payment->transaction) && $transaction_payment->transaction->type == 'sell' && $transaction_payment->is_return == 1) {
                    $accnt_trans_data['type'] = 'debit';
                }

                self::createAccountTransaction($accnt_trans_data);
            }
        }
    }

    public function transfer_transaction(): BelongsTo
    {
        return $this->belongsTo(\App\AccountTransaction::class, 'transfer_transaction_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(\App\Account::class, 'account_id');
    }
}
