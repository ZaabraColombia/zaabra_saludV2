<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function pais(): BelongsTo
    {
        return $this->belongsTo(pais::class, 'pais_id', 'id_pais');
    }

    /**
     * @return BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(departamento::class, 'departamento_id', 'id_departamento');
    }

    /**
     * @return BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(provincia::class, 'provincia_id', 'id_provincia');
    }

    /**
     * @return BelongsTo
     */
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(municipio::class, 'ciudad_id', 'id_municipio');
    }
}
