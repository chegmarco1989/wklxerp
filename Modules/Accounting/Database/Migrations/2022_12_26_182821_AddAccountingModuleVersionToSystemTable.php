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
        $is_exist = DB::table('system')->where('key', 'accounting_version')->exists();

        if (! $is_exist) {
            DB::table('system')->insert([
                'key' => 'accounting_version',
                'value' => config('accounting.module_version', config('accounting.module_version')),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
