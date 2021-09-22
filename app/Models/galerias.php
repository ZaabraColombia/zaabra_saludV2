<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galerias extends Model
{
    protected $fillable = [
        'id_galeria',
        'idPerfilProfesional',
        'idinstitucion',
        'nombrefoto',
        'descripcion',
        'imggaleria'
    ];

    protected $primaryKey = 'id_galeria';
}
