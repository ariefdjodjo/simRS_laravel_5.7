<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelaahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telaah', function (Blueprint $table) {
            $table->increments('id_telaah');
            $table->integer('id_usulan', 10);
            $table->string('no_telaah', 30);
            $table->date('tgl_telaah');
            $table->integer('penandatangan', 5);
            $table->text('analisis_kebutuhan');
            $table->text('alasan_kebutuhan');
            $table->string('urgency', 4);
            $table->date('tgl_kirim')->nullable();
            $table->data('tgl_baca')->nullable();
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
        Schema::dropIfExists('telaah');
    }
}
