<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaklKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl_kegiatans', function (Blueprint $table) {
            $table->increments('id_kegiatan');
            $table->integer('tahun');
            $table->string('kode_kegiatan', 10);
            $table->string('uraian_kegiatan', 250);
            $table->foreign('tahun')
                ->references('tahun')
                ->on('rkakl_tahun')
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
        Schema::dropIfExists('rkakl_kegiatans');
    }
}
