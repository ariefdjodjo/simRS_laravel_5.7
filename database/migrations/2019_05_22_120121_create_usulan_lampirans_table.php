<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanLampiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_lampiran', function (Blueprint $table) {
            $table->increments('id_lampiran_usulan');
            $table->integer('id_usulan');
            $table->string('nama_dokumen', 250);
            $table->text('link_file');
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
        Schema::dropIfExists('usulan_lampiran');
    }
}
