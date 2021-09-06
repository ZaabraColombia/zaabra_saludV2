<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especialidades extends Model
{
    use Sluggable;
    protected $fillable = [
        'idEspecialidad',
        'nombreEspecialidad',
        'idProfesion',
        'estado',
        'urlimagen',
        'orden',
        'slug'
    ];

    public $timestamps = false;

    protected $primaryKey = 'idEspecialidad';

    public function perfiles_profesionales()
    {
        return $this->hasMany(perfilesprofesionales::class, 'idespecialidad', 'idEspecialidad');
    }

    public function sluggable(): array
    {
        return [
            'slug' =>[
                'source' => 'nombreEspecialidad'
            ]
        ];
    }
}
