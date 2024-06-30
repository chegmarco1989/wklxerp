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
        DB::statement("ALTER TABLE purchase_lines MODIFY COLUMN quantity DECIMAL(22, 4) NOT NULL DEFAULT  '0'");

        DB::statement("ALTER TABLE transaction_sell_lines MODIFY COLUMN quantity DECIMAL(22, 4) NOT NULL DEFAULT  '0'");

        DB::statement("ALTER TABLE transactions MODIFY COLUMN discount_amount DECIMAL(22, 4) DEFAULT  '0'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
