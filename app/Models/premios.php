<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premios extends Model
{
    protected $fillable = [
        'idPerfilProfesional',
        'idinstitucion',
        'nombrepremio',
        'imgpremio',
        'fechapremio',
        'descripcionpremio'
    ];
}
