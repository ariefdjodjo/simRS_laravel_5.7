<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaklSubAlokasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl_sub_alokasi', function (Blueprint $table) {
            $table->increments('id_sub_alokasi');
            $table->integer('tahun', 4);
            $table->string('uraian_sub_alokasi', 250);
            $table->string('kode_kl_satker', 50);
            $table->integer('id_kegiatan', 5);
            $table->integer('id_output', 5);
            $table->integer('id_sub_output', 5);
            $table->integer('id_komponen', 5);
            $table->integer('id_sub_komponen', 5);
            $table->integer('id_akun', 5);
            $table->deciman('pagu_alokasi', 30,2);
            $table->integer('id_ppk', 5);
            $table->foreign('tahun')
                ->references('tahun')
                ->on('rkakl_tahun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_kegiatan')
                ->references('id_kegiatan')
                ->on('rkakl_kegiatan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_output')
                ->references('id_output')
                ->on('rkakl_output')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_sub_output')
                ->references('id_sub_output')
                ->on('rkakl_sub_output')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_komponen')
                ->references('id_komponen')
                ->on('rkakl_komponen')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_sub_komponen')
                ->references('id_sub_komponen')
                ->on('rkakl_sub_komponen')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_akun')
                ->references('id_akun')
                ->on('rkakl_akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_ppk')
                ->references('id_ppk')
                ->on('mst_ppk')
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
        Schema::dropIfExists('rkakl_sub_alokasi');
    }
}
