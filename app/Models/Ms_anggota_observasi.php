<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_anggota_observasi extends Model
{
    protected $table = 'anggota_observasi';
    protected $guarded = ['id'];

    protected function observasi(){
        return $this->belongsTo(Ms_observasi::class, 'id');
    }
}
