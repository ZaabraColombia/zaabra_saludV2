<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'profesional_id',
        'convenios',
        'tipo_atencion',
        'citas_activas',
        'codigo_cups',
        'tipo_servicio_id',
        'agendamiento_virtual',
        'estado'
    ];

    protected $table = 'servicios';

    /**
     * @return BelongsTo
     */
    public function profesional(): BelongsTo
    {
        return $this->belongsTo(perfilesprofesionales::class, 'profesional_id', 'idPerfilProfesional');
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


    public function tipo_servicio(): BelongsTo
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id', 'id');
    }

    public function cups(): BelongsTo
    {
        return $this->belongsTo(Cups::class, 'codigo_cups', 'code');
    }

    /**
     * Permite buscar en servicios
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch(Builder $query, $value)
    {
        if (empty($value)) return $query;

        return $query->where(function ($query) use ($value) {
            return $query->where('duracion', 'like', "%$value%")
                ->orWhere('descanso', 'like', "%$value%")
                ->orWhere('valor', 'like', "%$value%")
                ->orWhere('nombre', 'like', "%$value%")
                ->orWhere('descripcion', 'like', "%$value%")
                ->orWhere('convenios', 'like', "%$value%")
                ->orWhere('citas_activas', 'like', "%$value%")
                ->orWhereHas('especialidad', function ($q) use ($value) {
                    return $q->where('nombreEspecialidad', 'like', "%$value%");
                })
                ->orWhereHas('tipo_servicio', function ($q) use ($value) {
                    return $q->where('nombre', 'like', "%$value%");
                })
                ->orWhereHas('cups', function ($q) use ($value) {
                    return $q->where('description', 'like', "%$value%");
                });
        });
    }

}
