<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE cash_register_transactions MODIFY COLUMN transaction_type VARCHAR(191);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
