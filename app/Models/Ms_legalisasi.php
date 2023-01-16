<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_legalisasi extends Model
{
    use SoftDeletes;
    protected $table = 'legalisasi';
    protected $guarded = ['id'];
}
