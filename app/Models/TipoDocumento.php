<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'tipo',
    ];

    protected $table = 'tipo_documentos';

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeNatural(Builder $query): Builder
    {
        return $query->where('tipo', '=', 'natural');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeJuridica(Builder $query): Builder
    {
        return $query->where('tipo', '=', 'juridica');
    }


}
