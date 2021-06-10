<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prepagada extends Model
{
    protected $fillable = [
        'id_prepagada',
        'nombre',
        'urlimagen'
    ];
}
