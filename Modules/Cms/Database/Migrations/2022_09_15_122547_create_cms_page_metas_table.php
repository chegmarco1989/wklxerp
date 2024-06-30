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
        Schema::create('cms_page_metas', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cms_page_id');
            $table->foreign('cms_page_id')
                ->references('id')->on('cms_pages')
                ->onDelete('cascade');

            $table->string('meta_key');
            $table->longText('meta_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_page_metas');
    }
};
