<?php

use App\Contact;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE contacts MODIFY COLUMN `type` VARCHAR(191) NOT NULL');

        Contact::where('type', '=', '')
            ->orWhereNull('type')
            ->update(['type' => 'lead']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
