<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antiguedad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'paciente_id',
        'profesional_id',
        'institucion_id',
        'confirmacion'
    ];

    protected $table = 'atiguedades';

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
}
