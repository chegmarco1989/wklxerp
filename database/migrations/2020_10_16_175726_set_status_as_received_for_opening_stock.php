<?php

use App\Transaction;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Transaction::where('type', 'opening_stock')
            ->where('status', '!=', 'received')
            ->update(['status' => 'received']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
