<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class universidades extends Model
{
    protected $fillable = [
        'id_universidad',
        'nombreuniversidad',
        'logouniversidad'
    ];


}
