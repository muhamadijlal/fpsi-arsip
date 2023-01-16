<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ms_Konseling extends Model
{
    use SoftDeletes;
    protected $table = 'konseling';
    protected $guarded = ['id'];
}
