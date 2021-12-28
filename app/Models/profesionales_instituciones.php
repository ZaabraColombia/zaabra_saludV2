<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'foto_perfil_institucion',
        'cargo',
    ];

    protected $primaryKey = "id_profesional_inst";

    /**
     * @return BelongsToMany
     */
    public function especialidades(): BelongsToMany
    {
        return $this->belongsToMany(especialidades::class, 'institucion_profesionales_especialidades',
            'id_institucion_profesional', 'id_especialidad');
    }

    /**
     * @return BelongsTo
     */
    public function universidad(): BelongsTo
    {
        return $this->belongsTo(universidades::class, 'id_universidad', 'id_universidad');
    }
}
