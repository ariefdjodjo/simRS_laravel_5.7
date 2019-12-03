<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaklSubKomponensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl_sub_komponens', function (Blueprint $table) {
            $table->increments('id_sub_komponen');
            $table->string('kode_sub_komponen', 10);
            $table->string('uraian_sub_komponen', 250);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rkakl_sub_komponens');
    }
}
