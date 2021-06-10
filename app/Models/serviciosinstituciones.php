<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviciosinstituciones extends Model
{
    protected $fillable = [
        'id_servicio',
        'id',
        'tituloServicios',
        'DescripcioServicios',
        'sucursalservicio'
    ];
}
