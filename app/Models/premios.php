<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premios extends Model
{
    protected $fillable = [
        'id',
        'idPerfilProfesional',
        'idinstitucion',
        'nombrepremio',
        'imgpremio',
        'fechapremio',
        'descripcionpremio'
    ];

    protected $primaryKey = 'id';


}
