<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ips extends Model
{
    protected $fillable = [
        'id',
        'id_institucion',
        'urlimagen'
    ];
}
