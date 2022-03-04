<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoconsultas extends Model
{
    protected $fillable = [
        'id',
        'idperfil',
        'idinstitucion',
        'nombreconsulta',
        'valorconsulta',
        'updated_at',
        'created_at',
    ];

    protected $table = 'tipoconsultas';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(perfilesprofesionales::class, 'idperfil', 'idPerfilProfesional');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institucion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(instituciones::class, 'idinstitucion', 'id');
    }


}
