<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sedesinstituciones extends Model
{
    use \Conner\Tagging\Taggable;
    
    protected $fillable = [
        'id',
        'idinstitucion',
        'nombre',
        'direccion',
        'telefono',
        'idPais',
        'id_departamento',
        'id_provincia',
        'id_municipio'
    ];
}
