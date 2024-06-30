<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create(['name' => 'manufacturing.access_recipe']);
        Permission::create(['name' => 'manufacturing.access_production']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
