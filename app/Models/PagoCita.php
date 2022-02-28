<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoCita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'fecha',
        'vencimiento',
        'valor',
        'aprobado',
        'referencia_autorizacion',
        'cita_id'
    ];

    protected $table = 'pago_citas';

    public function cita(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function historial_pagos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HistorialPagoCita::class);
    }
}
