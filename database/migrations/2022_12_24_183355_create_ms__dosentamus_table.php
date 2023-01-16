<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsDosentamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen')->nullable();
            $table->string('pengirim');
            $table->string('pemohon');
            $table->string('nama_lengkap_gelar');
            $table->string('instansi');
            $table->string('mata_kuliah');
            $table->string('semester');
            $table->string('tanggal');
            $table->string('waktu');
            $table->string('tempat');
            $table->string('jenis_pelaksanaan');
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
        Schema::dropIfExists('dosen_tamu');
    }
}
