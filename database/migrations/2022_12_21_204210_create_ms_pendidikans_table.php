<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_dokumen');
            $table->string('nama_dokumen');
            $table->enum('jenis_dokumen', ['sk_pembimbing','sk_yudisium','sk_koordinator_prodi','sk_jadwal_kuliah','sk_lainnya']);
            $table->string('perihal')->nullable();
            $table->string('tanggal');
            $table->string('file');
            $table->string('keterangan');
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
        Schema::dropIfExists('pendidikan');
    }
}
