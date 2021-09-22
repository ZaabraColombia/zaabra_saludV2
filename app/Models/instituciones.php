<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instituciones extends Model
{

    use Sluggable;

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
        'propuestavalor',
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user.nombreinstitucion'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }
}
