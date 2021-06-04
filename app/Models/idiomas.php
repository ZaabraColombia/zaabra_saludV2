<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idiomas extends Model
{
    protected $fillable = [
        'id_idioma',
        'nombreidioma',
        'imgidioma'
    ];
}
