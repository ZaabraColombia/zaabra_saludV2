<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
        'valor',
        'respuesta',
        'estado',
        'fecha_generar_pago',
        'fecha_pago',
        'id_usuario',
        'id_tipo_pago'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $table = 'historial_pagos';
}
