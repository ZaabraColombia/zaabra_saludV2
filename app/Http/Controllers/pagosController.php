<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagosController extends Controller
{

    public function index()
    {
        return view('pagos.detalles-pago');
    }

}
