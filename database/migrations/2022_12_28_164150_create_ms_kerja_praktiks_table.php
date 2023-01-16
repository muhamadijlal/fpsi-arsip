<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsKerjaPraktiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerja_praktik', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('nomor_dokumen')->nullable();
            $table->string('tempat');
            $table->string('instansi')->nullable();
            $table->string('nama');
            $table->string('nim');
            $table->enum('jenis_kp',['dinas','umum']);
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
        Schema::dropIfExists('kerja_praktik');
    }
}
