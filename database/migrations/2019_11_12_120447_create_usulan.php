<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan', function (Blueprint $table) {
            $table->increments('id_usulan');
            $table->integer('tahun', 4);
            $table->integer('id', 5);
            $table->integer('id_unit_kerja', 5);
            $table->string('no_usulan', 30);
            $table->date('tgl_usulan');
            $table->string('perihal_usulan', 250);
            $table->string('jenis_usulan', 40);
            $table->text('isi_usulan');
            $table->integer('pengirim_usulan', 5);
            $table->date('tgl_kirim')->nullable();
            $table->date('dibaca')->nullable();
            $table->timestamps();
            $table->foreign('tahun')
                ->references('tahun')
                ->on('rkakl_tahun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_unit_kerja')
                ->references('id_unit_kerja')
                ->on('mst_unit_kerja')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('pengirim_usulan')
                ->references('id_ttd_usulan')
                ->on('ref_ttd_usulan')
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
        Schema::dropIfExists('usulan');
    }
}
