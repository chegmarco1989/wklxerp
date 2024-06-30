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
        Schema::create('crm_proposals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')
                ->references('id')->on('business')
                ->onDelete('cascade');

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')
                ->references('id')->on('contacts')
                ->onDelete('cascade');

            $table->text('subject');
            $table->longText('body');
            $table->integer('sent_by')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_proposals');
    }
};
