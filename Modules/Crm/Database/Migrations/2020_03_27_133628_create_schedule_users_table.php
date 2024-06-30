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
        Schema::create('crm_schedule_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')
                ->references('id')->on('crm_schedules')
                ->onDelete('cascade');

            $table->integer('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_schedule_users');
    }
};
