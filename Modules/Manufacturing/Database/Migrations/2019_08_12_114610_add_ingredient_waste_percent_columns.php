<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mfg_recipe_ingredients', function (Blueprint $table) {
            $table->decimal('waste_percent', 22, 4)->default(0)->after('quantity');
        });

        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->decimal('mfg_waste_percent', 22, 4)->default(0)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
