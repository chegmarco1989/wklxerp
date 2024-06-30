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
        Permission::create(['name' => 'list_drafts']);
        Permission::create(['name' => 'list_quotations']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
