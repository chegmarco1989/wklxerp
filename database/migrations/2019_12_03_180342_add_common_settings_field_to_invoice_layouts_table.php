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
        Schema::table('invoice_layouts', function (Blueprint $table) {
            $table->text('common_settings')->nullable()->after('module_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
