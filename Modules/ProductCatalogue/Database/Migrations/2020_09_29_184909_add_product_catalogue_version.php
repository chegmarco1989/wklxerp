<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('system')->insert([
            'key' => 'productcatalogue_version',
            'value' => config('productcatalogue.module_version', 0.1),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
