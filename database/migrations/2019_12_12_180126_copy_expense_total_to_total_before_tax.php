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
        DB::statement('UPDATE transactions SET total_before_tax=final_total WHERE type="expense" ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
