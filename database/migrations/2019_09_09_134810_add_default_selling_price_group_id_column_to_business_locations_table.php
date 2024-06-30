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
        Schema::table('business_locations', function (Blueprint $table) {
            $table->integer('selling_price_group_id')->nullable()->after('invoice_layout_id');
        });

        Schema::table('business_locations', function (Blueprint $table) {
            $table->text('default_payment_accounts')->nullable()->after('website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
