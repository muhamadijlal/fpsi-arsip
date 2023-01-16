<?php

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsObservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observasi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen')->nullable();
            $table->string('pengirim');
            $table->string('lokasi');
            $table->string('kecamatan');
            $table->string('nama');
            $table->string('nim');
            $table->string('semester');
            $table->string('judul');
            $table->enum('jenis',['pra penelitian','observasi','penelitian','try out']);
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
        Schema::dropIfExists('observasi');
    }
}
