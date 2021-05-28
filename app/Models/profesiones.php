<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profesiones extends Model
{
    protected $fillable = [
        'idProfesion',
        'nombreProfesion',
        'idArea',
        'estado',
        'urlimagen',
        'descripcion',
        'orden'
    ];
}
