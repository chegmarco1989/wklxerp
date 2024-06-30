<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->datetime('check_in')->after('hms_coupon_id')->nullable();
            $table->datetime('check_out')->after('check_in')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

        });
    }
};
