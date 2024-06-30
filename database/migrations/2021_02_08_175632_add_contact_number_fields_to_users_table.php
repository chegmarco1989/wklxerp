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
        Schema::table('users', function (Blueprint $table) {
            $table->string('alt_number')->nullable()->after('contact_number');
            $table->string('family_number')->nullable()->after('alt_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
