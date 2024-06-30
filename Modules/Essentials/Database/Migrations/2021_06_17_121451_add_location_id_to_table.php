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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('location_id')
                ->after('id_proof_number')
                ->comment('user primary work location')
                ->nullable();
        });

        Schema::table('essentials_payroll_groups', function (Blueprint $table) {
            $table->integer('location_id')
                ->after('business_id')
                ->comment('payroll for work location')
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
