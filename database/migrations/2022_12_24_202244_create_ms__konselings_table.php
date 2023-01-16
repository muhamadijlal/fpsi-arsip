<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsKonselingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konseling', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_dokumen')->nullable();
            $table->string('nama_dokumen');
            $table->string('perihal')->nullable();
            $table->string('tanggal_awal');
            $table->string('tanggal_akhir');
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
        Schema::dropIfExists('konseling');
    }
}
