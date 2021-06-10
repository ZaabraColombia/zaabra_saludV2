<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoinstituciones extends Model
{
    protected $fillable = [
        'id',
        'nombretipo',
        'descripcioninstitucion',
        'urlimagen',
        'estado'
    ];
}
