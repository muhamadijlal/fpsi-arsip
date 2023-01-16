<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_aktifKuliah extends Model
{
    use SoftDeletes;

    protected $table = 'aktif_kuliah';
    protected $guarded = ['id'];
}
