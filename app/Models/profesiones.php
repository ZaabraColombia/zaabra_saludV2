<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class profesiones extends Model
{

    use Sluggable;

    protected $fillable = [
        'idProfesion',
        'nombreProfesion',
        'idArea',
        'estado',
        'urlimagen',
        'descripcion',
        'orden',
        'slug'
    ];

    protected $table = 'profesiones';

    public $timestamps = false;

    protected $primaryKey = 'idProfesion';

    public function perfiles_profesionales()
    {
        return $this->hasMany(perfilesprofesionales::class, 'idprofesion', 'idProfesion');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombreProfesion'
            ]
        ];
    }
}
