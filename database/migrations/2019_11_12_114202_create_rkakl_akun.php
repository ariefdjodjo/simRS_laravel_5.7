<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRkaklAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkakl_akun', function (Blueprint $table) {
            $table->increments('id_akun');
            $table->integer('tahun');
            $table->string('kode_akun', 10);
            $table->string('uraian_akun', 150);
            $table->string('sumber_dana', 6);
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
        Schema::dropIfExists('rkakl_akun');
    }
}
