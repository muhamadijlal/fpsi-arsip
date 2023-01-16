<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsLegalisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legalisasi', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_legalisasi')->nullable();
            $table->string('nomor_ijazah');
            $table->string('nama');
            $table->string('tahun_lulus');
            $table->string('tanggal_lulus');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legalisasi');
    }
}
