<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPintarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pintar', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->integer('jml_siswa');
            $table->string('jenis_training');
            $table->integer('jml_peserta');
            $table->string('inovasi_program');
            $table->integer('serapan_industri');
            $table->string('level');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_pintar');
    }
}
