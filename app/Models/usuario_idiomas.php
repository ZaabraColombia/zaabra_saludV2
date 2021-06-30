<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_idiomas extends Model
{
    protected $fillable = [
        'idPerfilProfesional',
        'id',
        'id_idioma',
        'updated_at',
        'created_at'
    ];
}
