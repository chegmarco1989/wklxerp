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
        DB::statement('ALTER TABLE essentials_to_dos MODIFY COLUMN `date` DATETIME');
        DB::statement('ALTER TABLE essentials_to_dos MODIFY COLUMN `end_date` DATETIME');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
