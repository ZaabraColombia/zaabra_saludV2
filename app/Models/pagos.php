<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    protected $fillable = [
        'fecha',
        'fechaFin',
        'idUsuario',
        'idtipopago',
        'referenceCode',
        'valor',
        'aprobado',
        'numeroAutorizacion'
    ];
}
