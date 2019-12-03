<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTtdSp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ttd_sp', function (Blueprint $table) {
            $table->increments('id_ttd_sp');
            $table->string('nama_penandatangan', 150);
            $table->string('nip_penandatangan', 25);
            $table->string('jabatan', 150);
            $table->string('file_ttd', 100);
            $table->integer('status', 2);
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
        Schema::dropIfExists('ref_ttd_sp');
    }
}
