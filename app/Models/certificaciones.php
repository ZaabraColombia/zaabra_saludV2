<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificaciones extends Model
{
    protected $fillable = [
        'id_certificacion',
        'id_institucion',
        'imgcertificado',
        'fechacertificado',
        'titulocertificado',
        'descrpcioncertificado'
    ];
}
