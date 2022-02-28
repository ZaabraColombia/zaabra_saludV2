<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'paciente_id',
        'profesional_id',
        'profesional_ins_id',
        'horario_id',
        'tipo_cita_id'
    ];

    protected $table = 'citas';


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
     * @return HasMany
     */
    public function pagos(): HasMany
    {
        return $this->hasMany(PagoCita::class);
    }

}