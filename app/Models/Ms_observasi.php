<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_observasi extends Model
{
    use SoftDeletes;
    protected $table = 'observasi';
    protected $guarded = ['id'];

    protected function anggota_observasi(){
        return $this->hasMany(Ms_anggota_observasi::class, 'observasi_id');
    }
}
