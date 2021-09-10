<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class sedesinstituciones extends Model
{
    //use \Conner\Tagging\Taggable;

    protected $fillable = [
        'idInstitucion',
        'imgsede',
        'nombre',
        'direccion',
        'horario_sede',
        'telefono',
        'url_map'
    ];

    protected $primaryKey = "id";
}
