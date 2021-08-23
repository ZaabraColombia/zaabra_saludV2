<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favoritos_instituciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_favorito_institucion',
        'id_users',
        'created_at',
        'updated_at'
    ];
}
