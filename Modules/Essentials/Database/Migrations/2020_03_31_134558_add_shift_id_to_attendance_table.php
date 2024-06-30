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
        Schema::table('essentials_attendances', function (Blueprint $table) {
            $table->integer('essentials_shift_id')->nullable()->after('clock_out_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
