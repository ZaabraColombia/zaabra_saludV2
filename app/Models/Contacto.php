<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'nombre',
        'direccion',
        'telefono',
        'telefono_adicional',
        'correo',
        'user_id'
    ];

    protected $table = 'contactos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
