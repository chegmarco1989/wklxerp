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
        Schema::create('crm_lead_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('contact_id');
            $table->foreign('contact_id')
                ->references('id')->on('contacts')
                ->onDelete('cascade');

            $table->integer('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_lead_users');
    }
};
