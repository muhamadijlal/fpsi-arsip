<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsAktifKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktif_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_dokumen')->nullable();
            $table->string('nama');
            $table->string('nim');
            $table->string('semester');
            $table->string('kota_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat')->nullable();
            $table->string('nama_orangtua')->nullable();
            $table->string('instansi_orangtua')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nip_orangtua')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->enum('keperluan',['beasiswa karawang cerdas','dinas','umum']);
            $table->enum('jenis_surat',['umum','dinas']);
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
        Schema::dropIfExists('aktif_kuliah');
    }
}
