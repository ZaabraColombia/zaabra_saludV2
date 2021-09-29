<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Nombre',
        'estado',
        'valor'
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $table = 'tipopago';
}
