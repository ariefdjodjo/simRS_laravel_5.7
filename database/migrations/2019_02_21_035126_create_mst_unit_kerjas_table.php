<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstUnitKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_unit_kerja', function (Blueprint $table) {
            $table->increments('id_unit_kerja');
            $table->string('nama_unit_kerja');
            $table->string('no_telp');
            $table->string('email_unit_kerja');
            $table->string('kode_agenda_satker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_unit_kerja');
    }
}
