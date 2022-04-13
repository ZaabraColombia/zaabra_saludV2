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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function intitucion_profesionales(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(profesionales_instituciones::class, 'institucion_profesionales_especialidades',
            'id_especialidad', 'id_institucion_profesional');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Servicio::class, 'especialidad_id', 'idEspecialidad' );
    }
}
