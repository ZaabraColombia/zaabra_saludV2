<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        //'horario_id',
        'lugar',
        'tipo_cita_id'
    ];

    protected $primaryKey = 'id_cita';

    protected $table = 'citas';

    protected $casts = [
        'fecha_inicio'  => 'datetime',
        'fecha_fin'     => 'datetime',
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

}
