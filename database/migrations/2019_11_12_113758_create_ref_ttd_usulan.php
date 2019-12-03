<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTtdUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ttd_usulan', function (Blueprint $table) {
            $table->increments('id_ttd_usulan');
            $table->integer('id_unit_kerja');
            $table->string('nama_kepala', 150);
            $table->string('nip_kepala', 25);
            $table->string('jabatan', 150);
            $table->integer('status', 2);
            $table->foreign('id_unit_kerja')
                ->references('id_unit_kerja')
                ->on('mst_unit_kerja')
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
        Schema::dropIfExists('ref_ttd_usulan');
    }
}
