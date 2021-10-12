<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class profesionales_instituciones extends Model
{
    protected $fillable = [
        'id_profesional_inst',
        'id_institucion',
        'id_universidad',
        'id_especialidad',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'foto_perfil_institucion'
    ];

    protected $primaryKey = "id_profesional_inst";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function especialidades(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(especialidades::class, 'institucion_profesionales_especialidades',
            'id_institucion_profesional', 'id_especialidad');
    }
}
