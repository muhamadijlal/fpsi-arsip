<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsSuratIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izin', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen')->nullable();
            $table->string('pengirim');
            $table->string('tujuan');
            $table->string('nama');
            $table->string('nim');
            $table->string('semester');
            $table->string('tanggal_awal');
            $table->string('tanggal_akhir');
            $table->enum('jenis',['ujian tengah semester ganjil','ujian tengah semester genap','ujian akhir semester ganjil','ujian akhir semester genap','sidang tugas akhir','sidang kerja praktik','dispensasi']);
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
        Schema::dropIfExists('surat_izin');
    }
}
