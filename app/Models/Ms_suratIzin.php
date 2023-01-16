<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_suratIzin extends Model
{
    use SoftDeletes;
    protected $table = 'surat_izin';
    protected $guarded = ['id'];
}
