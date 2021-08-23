<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favoritos_especialistas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_favorito_especialista',
        'id_users',
        'created_at',
        'updated_at'
    ];
}
