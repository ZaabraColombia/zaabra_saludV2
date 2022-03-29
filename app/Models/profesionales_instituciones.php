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
        'tipo_documento_id',
        'numero_documento',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'celular',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
        'correo',
        'sitio_web',
        'linkedin',
        'red_social',
        'rethus',
        'numero_profesional',
        'foto_perfil_institucion',
        'cargo',
        'horario',
        'disponibilidad_agenda',
    ];

    protected $primaryKey = "id_profesional_inst";

    protected $casts = [
        'horario' => 'array',
        'fecha_nacimiento' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function especialidad_pricipal(): BelongsTo
    {
        return $this->belongsTo(especialidades::class, 'id_especialidad', 'idEspecialidad');
    }

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

    /**
     * @return BelongsTo
     */
    public function institucion(): BelongsTo
    {
        return $this->belongsTo(instituciones::class, 'id_institucion', 'id');
    }

    /**
     * @return string
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}";
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'profesional_ins_id', 'id_profesional_inst');
    }


    public function getNombreEspecialidadAttribute(): ?string
    {
        if (!empty($this->especialidad_pricipal)) return $this->especialidad_pricipal->nombreEspecialidad;
        return null;
    }

    /**
     * @return BelongsTo
     */
    public function tipo_documento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
}
