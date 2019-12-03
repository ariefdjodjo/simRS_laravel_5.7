<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_barang', function (Blueprint $table) {
            $table->increments('id_barang_usulan');
            $table->integer('id_usulan', 10);
            $table->string('nama_barang', 250);
            $table->text('spesifikasi');
            $table->string('satuan', 30);
            $table->decimal('harga_usulan', 30, 2);
            $table->decimal('qty_usulan', 10, 2);
            $table->decimal('jumlah_usulan', 30,2);
            $table->text('catatan_usulan')->nullable();
            $table->decimal('qty_telaah', 10,2)->nullable();
            $table->decimal('harga_telaah', 30,2)->nullable();
            $table->decimal('jumlah_harga_telaah', 30,2)->nullable();
            $table->string('dasar_harga', 250)->nullable();
            $table->text('catatan_kebutuhan')->nullable();
            $table->integer('status_barang_telaah', 2)->nullable();
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
        Schema::dropIfExists('usulan_barang');
    }
}
