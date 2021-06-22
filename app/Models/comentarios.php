<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentarios extends Model
{
    protected $fillable = [
        'idusuariorol',
        'idperfil',
        'idinstitucion',
        'calificacion',
        'comentario',
        'fecha'
    ];
}
