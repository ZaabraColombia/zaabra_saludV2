<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Acceso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'tipo'
    ];

    /**
     * Permite ver todos los usuarios de un acceso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'accesos_has_users', 'acceso_id', 'user_id');
    }

    /**
     * Scope para delimitar los accesos
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInstitucion(Builder $query): Builder
    {
        return $query->where('tipo', 'like', 'institucion');
    }

    /**
     * Scope para delimitar los accesos
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeProfesional(Builder $query): Builder
    {
        return $query->where('tipo', 'like', 'profesional');
    }
}
