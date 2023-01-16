<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_kerjaPraktik extends Model
{
    use SoftDeletes;

    protected $table = 'kerja_praktik';
    protected $guarded = ['id'];
}
