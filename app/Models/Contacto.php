<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'telefono',
        'telefono_adicional',
        'numero_identificacion',
        'dependencia',
        'correo',
        'tipo',
        'tipo_cuenta',
        'numero_cuenta',
        'observacion',
        'user_id'
    ];

    protected $table = 'contactos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
