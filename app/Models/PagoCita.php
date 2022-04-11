<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoCita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'vencimiento',
        'valor',
        'valor_convenio',
        'aprobado',
        'tipo',
        'referencia_autorizacion',
        'cita_id'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'vencimiento' => 'datetime',
    ];

    protected $table = 'pago_citas';

    public function cita(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cita::class, 'cita_id', 'id_cita');
    }

    public function historial_pagos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HistorialPagoCita::class);
    }
}
