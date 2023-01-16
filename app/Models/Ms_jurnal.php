<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_jurnal extends Model
{
    use SoftDeletes;

    protected $table = 'jurnal';
    protected $guarded = ['id'];

    protected function history(){
        return $this->hasMany(Ms_history::class, 'jurnal_id');
    }
}
