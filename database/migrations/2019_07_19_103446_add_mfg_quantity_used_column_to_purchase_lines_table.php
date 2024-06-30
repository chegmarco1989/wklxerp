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
        Schema::table('purchase_lines', function (Blueprint $table) {
            $table->decimal('mfg_quantity_used', 22, 4)->default(0)->after('quantity_returned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
