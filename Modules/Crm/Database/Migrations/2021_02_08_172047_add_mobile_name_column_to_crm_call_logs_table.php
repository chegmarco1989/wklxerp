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
        Schema::table('crm_call_logs', function (Blueprint $table) {
            $table->string('mobile_name')->nullable()->after('mobile_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
