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
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('pjt_project_id')
                ->nullable()
                ->after('pay_term_type');

            $table->foreign('pjt_project_id')
                ->references('id')->on('pjt_projects')
                ->onDelete('cascade');

            $table->string('pjt_title')
                ->nullable()
                ->after('pjt_project_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('transactions');
    }
};
