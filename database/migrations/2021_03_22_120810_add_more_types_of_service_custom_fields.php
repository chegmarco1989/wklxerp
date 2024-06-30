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
            $table->text('service_custom_field_5')->nullable()->after('service_custom_field_4');
            $table->text('service_custom_field_6')->nullable()->after('service_custom_field_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
