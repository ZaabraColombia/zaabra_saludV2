<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicaciones extends Model
{
    protected $fillable = [
        'id',
        'idPerfilProfesional',
        'idInstitucion',
        'nombrepublicacion',
        'descripcion',
        'imgpublicacion'
    ];
}
