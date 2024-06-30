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
            $table->text('clock_in_location')
                ->after('clock_out_note')
                ->nullable();
            $table->text('clock_out_location')
                ->after('clock_in_location')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
