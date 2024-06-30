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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('allow_login')->default(1)->after('business_id');
        });

        DB::statement('ALTER TABLE users CHANGE username username VARCHAR(191) NULL;');
        DB::statement('ALTER TABLE users CHANGE password password VARCHAR(191) NULL;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
