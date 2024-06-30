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
        Schema::table('variation_group_prices', function (Blueprint $table) {
            $table->string('price_type')->default('fixed')->after('price_inc_tax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variation_group_prices', function (Blueprint $table) {
            //
        });
    }
};
