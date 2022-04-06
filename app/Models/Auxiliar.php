<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'celular',
        'pais_id',
        'departamento_id',
        'provincia_id',
        'ciudad_id',
        'user_id'
    ];

    protected $table = 'auxiliares';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
