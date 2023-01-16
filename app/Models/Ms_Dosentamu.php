<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_Dosentamu extends Model
{
    use SoftDeletes;
    protected $table = 'dosen_tamu';
    protected $guarded = ['id'];
}
