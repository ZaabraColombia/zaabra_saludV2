<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class institucionprepagada extends Model
{
    protected $fillable = [
        'id',
        'idinstitucion',
        'id_prepagada'
    ];
}
