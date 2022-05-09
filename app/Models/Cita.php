<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cita',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'paciente_id',
        'profesional_id',
        'profesional_ins_id',
        'convenio_id',
        'lugar',
        'tipo_cita_id',
        'especialidad_id',
        'duracion',
        'comentario',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
    ];

    protected $primaryKey = 'id_cita';

    protected $table = 'citas';

    protected $casts = [
        'fecha_inicio'  => 'datetime',
        'fecha_fin'     => 'datetime',
    ];


    protected $appends = [
        'fecha',
        'hora'
    ];

    /**
     * @return BelongsTo
     */
    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }

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
    public function profesional_ins(): BelongsTo
    {
        return $this->belongsTo(profesionales_instituciones::class, 'profesional_ins_id', 'id_profesional_inst');
    }

    /**
     * @return HasOne
     */
    public function pago(): HasOne
    {
        return $this->hasOne(PagoCita::class, 'cita_id', 'id_cita');
    }

    /**
     * @return BelongsTo
     */
    public function tipo_consulta(): BelongsTo
    {
        return $this->belongsTo(tipoconsultas::class, 'tipo_cita_id');
    }


    /**
     * @return BelongsTo
     */
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'tipo_cita_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(pais::class, 'pais_id', 'id_pais');
    }
    /**
     * @return BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(departamento::class, 'departamento_id', 'id_departamento');
    }
    /**
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(provincia::class, 'provincia_id', 'id_provincia');
    }
    /**
     * @return BelongsTo
     */
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'ciudad_id', 'id_municipio');
    }

    /**
     * @return BelongsTo
     */
    public function especialidad(): BelongsTo
    {
        return $this->belongsTo(especialidades::class, 'especialidad_id');
    }

    /**
     * @return string
     */
    public function getBgEstadoAttribute(): string
    {
        switch ($this->estado)
        {
//            case 'agendado':
//                $bg = 'primary';
//                break;
            case 'cancelado':
                $bg = 'danger';
                break;
            case 'completado':
                $bg = 'success';
                break;
            case 'reservado':
                $bg = 'info';
                break;
            default:
                $bg = 'primary';
                break;
        }

        return $bg;
    }

    public function getFechaAttribute(): string
    {
        return date('Y-m-d', strtotime($this->fecha_inicio));
    }

    public function getHoraAttribute(): string
    {
        //return date('h:i a', strtotime($this->fecha_inicio)) . " - " . date('h:i a', strtotime($this->fecha_fin));
        return "{$this->fecha_inicio->format('h:i a')} - {$this->fecha_fin->format('h:i a')}";
    }


    /**
     * Permite
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeValidar(Builder $query, $inicio, $fin): Builder
    {
        return $query->where(function ($query) use ($inicio, $fin){
            $query->whereRaw('(fecha_inicio >= "' . date('Y-m-d H:i:s', strtotime($inicio)) .
                '" and fecha_inicio < "' . date('Y-m-d H:i', strtotime($fin)) . '")')
                ->orWhereRaw('(fecha_fin > "' . date('Y-m-d H:i:s', strtotime($inicio)) .
                    '" and fecha_fin <= "' . date('Y-m-d H:i:s', strtotime($fin)) . '")')
                ->orWhereRaw('(fecha_inicio <= "' . date('Y-m-d H:i:s', strtotime($inicio)) .
                    '" and fecha_fin > "' . date('Y-m-d H:i:s', strtotime($inicio)) . '")')
                ->orWhereRaw('(fecha_inicio < "' . date('Y-m-d H:i:s', strtotime($fin)) .
                    '" and fecha_fin >= "' . date('Y-m-d H:i:s', strtotime($fin)) . '")');
        });
    }
}
