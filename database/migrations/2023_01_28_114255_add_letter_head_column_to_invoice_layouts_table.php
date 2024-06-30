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
            $table->boolean('show_letter_head')->default(0)->after('business_id');
            $table->string('letter_head')->nullable()->after('show_letter_head');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
