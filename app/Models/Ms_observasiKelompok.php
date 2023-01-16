<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_observasiKelompok extends Model
{
    use SoftDeletes;
    protected $table = 'observasi_kelompok';
    protected $guarded = ['id'];

    protected function anggota_observasi_kelompok(){
        return $this->hasMany(Ms_anggota_observasiKelompok::class, 'observasi_kelompok_id');
    }
}
