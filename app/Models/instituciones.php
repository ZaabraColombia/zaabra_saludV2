<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instituciones extends Model
{
    protected $fillable = [
        'id',
        'idUser',
        'idPais',
        'id_departamento',
        'id_provincia',
        'id_municipio',
        'idtipoInstitucion',
        'imagen',
        'logo',
        'razonSocial',
        'quienessomos',
        'DescripcionGeneralServicios',
        'url',
        'fechainicio',
        'telefonouno',
        'telefono2',
        'direccion',
        'propuestavalor'
    ];
}
