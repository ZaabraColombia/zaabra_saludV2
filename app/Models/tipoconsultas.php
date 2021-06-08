<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoconsultas extends Model
{
    protected $fillable = [
        'id',
        'idperfil',
        'idinstitucion',
        'nombreconsulta',
        'valorconsulta',
        'updated_at',
        'created_at',

    ];
}
