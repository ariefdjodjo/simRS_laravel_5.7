<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefStandartBiaya extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_standart_biaya', function (Blueprint $table) {
            $table->increments('id_kebutuhan_barang');
            $table->integer('tahun');
            $table->integer('id_master_barang');
            $table->decimal('barang_tersedia', 5, 2);
            $table->decimal('kebutuhan', 5, 2);
            $table->decimal('harga_satuan', 30, 2);
            $table->text('dasar_harga');
            $table->char('lampiran', 250);
            $table->timestamps();
            $table->foreign('id_master_barang')
                ->references('id_master_barang')
                ->on('ref_master_barang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_standart_biaya');
    }
}
