<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelaahLampiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telaah_lampiran', function (Blueprint $table) {
            $table->increments('id_lampiran_telaah');
            $table->integer('id_telaah');
            $table->string('nama_dokumen', 150);
            $table->string('link_file', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telaah_lampiran');
    }
}
