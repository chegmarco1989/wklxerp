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
            $table->string('crm_department')
                ->nullable()
                ->comment("Contact person's department")
                ->after('id_proof_number');

            $table->string('crm_designation')
                ->nullable()
                ->comment("Contact person's designation")
                ->after('crm_department');
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
