<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialPagoCita extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'referencia_autorizacion',
        'metodo',
        'estado',
        'respuesta',
        'fecha',
        'pago_cita_id'
    ];

    protected $table = 'historial_pago_citas';

    protected $casts = [
        'fecha' => 'datetime'
    ];

    public function pago_cita(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PagoCita::class);
    }
}
