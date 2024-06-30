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
        Schema::create('sheet_spreadsheet_shares', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sheet_spreadsheet_id');
            $table->foreign('sheet_spreadsheet_id')
                ->references('id')->on('sheet_spreadsheets')
                ->onDelete('cascade');

            $table->string('shared_with')
                ->index()
                ->comment('Shared with like user/role/todo');

            $table->integer('shared_id')
                ->index()
                ->comment('Id of shared with like user_id/role_id/todo_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheet_spreadsheet_shares');
    }
};
