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
        Schema::create('aiassistance_history', function (Blueprint $table) {
            $table->id();

            $table->integer('business_id');
            $table->integer('user_id');
            $table->string('tool_type');
            $table->text('input_data')->nullable();
            $table->integer('tokens_used')->default(0);
            $table->text('output_data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aiassistance_history');
    }
};
