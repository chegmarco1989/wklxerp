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
            $table->string('change_return_label')->nullable()->after('prev_bal_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
