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
        Schema::table('business_locations', function (Blueprint $table) {
            $table->text('accounting_default_map')->nullable()->after('custom_field4')
                ->comment('Default transactions mapping of accounting module');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_locations', function (Blueprint $table) {

        });
    }
};
