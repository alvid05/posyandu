<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanSehatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_sehat', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->integer('jml_kader');
            $table->integer('jml_balita');
            $table->integer('jml_ibu_hamil');
            $table->string('jenis_vaksin');
            $table->integer('jml_vaksin');
            $table->string('inovasi_program');
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
        Schema::dropIfExists('laporan_sehat');
    }
}
