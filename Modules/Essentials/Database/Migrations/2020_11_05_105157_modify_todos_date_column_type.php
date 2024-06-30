<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE essentials_to_dos MODIFY COLUMN `date` DATETIME');
        DB::statement('ALTER TABLE essentials_to_dos MODIFY COLUMN `end_date` DATETIME');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
