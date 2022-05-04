<?php

namespace App\Models;

use Hyn\Tenancy\Traits\UsesSystemConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cups extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'description'
    ];

    protected $table = 'cups';

    public $timestamps = false;

}
