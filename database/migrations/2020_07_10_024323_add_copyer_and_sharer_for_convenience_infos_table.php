<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCopyerAndSharerForConvenienceInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('convenience_infos', function (Blueprint $table) {
            $table->integer('copyer')->default(0);
            $table->integer('sharer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convenience_infos', function (Blueprint $table) {
            //
        });
    }
}
