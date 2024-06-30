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
        Schema::create('sheet_spreadsheets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('business_id');
            $table->foreign('business_id')
                ->references('id')->on('business')
                ->onDelete('cascade');

            $table->string('name');
            $table->longText('sheet_data');
            $table->integer('created_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheet_spreadsheets');
    }
};
