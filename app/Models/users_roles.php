<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_roles extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'iduser',
        'idrol'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }
}
