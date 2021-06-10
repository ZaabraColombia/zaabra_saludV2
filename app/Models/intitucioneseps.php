<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intitucioneseps extends Model
{
    protected $fillable = [
        'id',
        'idinstitucion',
        'ideps'
    ];
}
