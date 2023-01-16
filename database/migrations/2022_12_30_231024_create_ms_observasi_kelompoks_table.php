<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsObservasiKelompoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observasi_kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen')->nullable();
            $table->string('pengirim');
            $table->string('agenda');
            $table->string('tempat');
            $table->string('alamat');
            $table->string('nama');
            $table->string('nim');
            $table->string('semester');
            $table->string('pengampu');
            $table->string('tanggal');
            $table->enum('jenis',['observasi','wawancara','survei']);
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
        Schema::dropIfExists('observasi_kelompok');
    }
}
