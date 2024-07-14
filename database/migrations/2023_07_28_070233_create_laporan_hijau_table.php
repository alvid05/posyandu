<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHijauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hijau', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->integer('jml_telur_ditemukan');
            $table->integer('jml_telur_menetas');
            $table->integer('jml_tukik_dilepas');
            $table->integer('jml_pengunjung');
            $table->string('inovasi_program');
            $table->integer('jenis_penyu');
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
        Schema::dropIfExists('laporan_hijau');
    }
}
