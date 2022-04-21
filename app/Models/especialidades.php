<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @return BelongsToMany
     */
    public function intitucion_profesionales(): BelongsToMany
    {
        return $this->belongsToMany(profesionales_instituciones::class, 'institucion_profesionales_especialidades',
            'id_especialidad', 'id_institucion_profesional');
    }

    /**
     * Delimita por otras especialidades de un profesional de una institución
     *
     * @return BelongsToMany
     */
    public function total_ins_profesionales(): BelongsToMany
    {
        return $this->belongsToMany(profesionales_instituciones::class, 'institucion_profesionales_especialidades',
            'id_especialidad', 'id_institucion_profesional');
    }

    /**
     * Delimita por especialidad principal de un profesional de una institución
     *
     * @return HasMany
     */
    public function ins_profesionales(): HasMany
    {
        return $this->hasMany(profesionales_instituciones::class, 'id_especialidad', 'idEspecialidad');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicios(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Servicio::class, 'especialidad_id', 'idEspecialidad' );
    }
}
