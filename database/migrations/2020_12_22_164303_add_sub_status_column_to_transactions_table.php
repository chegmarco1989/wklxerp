<?php

use App\Transaction;
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('sub_status')->after('status')->nullable()->index();
        });

        Transaction::where('is_quotation', 1)->update(['sub_status' => 'quotation']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
