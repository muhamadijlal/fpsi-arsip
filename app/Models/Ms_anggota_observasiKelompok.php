<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_anggota_observasiKelompok extends Model
{
    protected $table = 'anggota_observasi_kelompok';
    protected $guarded = ['id'];

    protected function observasi_kelompok(){
        return $this->belongsTo(Ms_observasiKelompok::class, 'id');
    }
}
