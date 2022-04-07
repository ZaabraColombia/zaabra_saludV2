<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'duracion',
        'descanso',
        'valor',
        'nombre',
        'descripcion',
        'especialidad_id',
        'institucion_id',
        'convenios',
        'tipo_atencion',
        'citas_activas',
        'codigo_cups',
        'tipo_servicio_id',
        'estado'
    ];

    protected $table = 'servicios';

    /**
     * @return BelongsTo
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(profesionales_instituciones::class, 'profesional_id', 'id_profesional_inst');
    }

    /**
     * @return BelongsTo
     */
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(especialidades::class, 'especialidad_id', 'idEspecialidad');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function convenios_lista(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Convenios::class, 'convenios_has_servicios', 'servicio_id', 'convenio_id')
            ->withPivot(['valor_paciente', 'valor_convenio']);
    }



}
