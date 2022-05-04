<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'horarios';

    protected $fillable = [
        'id',
        'horario',
        'color_cita_pagada',
        'color_cita_precencial',
        'color_cita_agendada',
        'color_cita_cancelada',
        'color_bloqueado',
        'dias_agenda',
        'user_id'
    ];

    protected $casts = [
        'horario' => 'array'
    ];

    /**
     * @return BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
