<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_history extends Model
{
    protected $table = 'history';
    protected $guarded = ['id'];

    protected function jurnal(){
        return $this->belongsTo(Ms_jurnal::class, 'id');
    }
}
