<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefMasterBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_master_barang', function (Blueprint $table) {
            $table->increments('id_master_barang');
            $table->increments('kode_jenis_barang');
            $table->string('nama_barang', 150);
            $table->text('spesifikasi');
            $table->string('satuan', 30);
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
        Schema::dropIfExists('ref_master_barang');
    }
}
