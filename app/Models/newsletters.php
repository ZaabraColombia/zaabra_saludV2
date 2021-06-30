<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsletters extends Model
{
    protected $fillable = [
        'id_user',
        'correo_newsletter',
    ];
}
