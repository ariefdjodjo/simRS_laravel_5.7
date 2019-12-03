<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefTtdTelaah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_ttd_telaah', function (Blueprint $table) {
            $table->increments('id_ttd_telaah');
            $table->string('nama_penelaah', 150);
            $table->string('nip_penelaah', 25);
            $table->string('jabatan', 150);
            $table->string('file_ttd', 100);
            $table->integer('status', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_ttd_telaah');
    }
}
