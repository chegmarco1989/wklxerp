<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('system')->insert(
            [
                ['key' => 'superadmin_version', 'value' => config('superadmin.module_version')],
                ['key' => 'app_currency_id', 'value' => 2],
                ['key' => 'invoice_business_name', 'value' => env('APP_NAME')],
                ['key' => 'invoice_business_landmark', 'value' => 'Landmark'],
                ['key' => 'invoice_business_zip', 'value' => 'Zip'],
                ['key' => 'invoice_business_state', 'value' => 'State'],
                ['key' => 'invoice_business_city', 'value' => 'City'],
                ['key' => 'invoice_business_country', 'value' => 'Country'],
                ['key' => 'email', 'value' => 'superadmin@example.com'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system', function (Blueprint $table) {
        });
    }
};
