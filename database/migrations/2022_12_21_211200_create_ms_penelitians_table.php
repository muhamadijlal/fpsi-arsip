<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsPenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitian', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_dokumen');
            $table->string('nama_dokumen');
            $table->enum('jenis_dokumen', ['jurnal_penelitian_prosiding','surat_penelitian','laporan_artikel_penelitian','surat_tugas_penelitian']);
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
        Schema::dropIfExists('penelitian');
    }
}
