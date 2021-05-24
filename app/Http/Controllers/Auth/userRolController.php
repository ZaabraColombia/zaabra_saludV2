<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userRolController extends Controller
{


   
    protected function create(array $data)
    {
        $user = User::create([
            'iduser' => $data['primernombre'],
            'idrol' => $data['segundonombre'],
        ]);
        return $user;
    }

}
