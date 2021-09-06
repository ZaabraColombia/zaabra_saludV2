<?php

namespace App\Http\Controllers;

use App\Models\especialidades;
use App\Models\instituciones;
use App\Models\perfilesprofesionales;
use App\Models\profesiones;
use App\Models\tipoinstituciones;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
//        $pro = perfilesprofesionales::all();
//
//        foreach ($pro as $p)
//        {
//            //$p->slugging();
//            $p->update();
//        }

//        $tIns = tipoinstituciones::all();
//
//        foreach ($tIns as $p)
//        {
//            //$p->slugging();
//            $p->update();
//        }

//        $ins = instituciones::all();
//
//        foreach ($ins as $p)
//        {
//            //$p->slugging();
//            $p->update();
//        }

//        $esp = especialidades::all();
//
//        foreach ($esp as $p)
//        {
//            //$p->slugging();
//            $p->update();
//        }
        $prof = profesiones::all();

        foreach ($prof as $p)
        {
            //$p->slugging();
            $p->update();
            //dd($p);
        }
    }
}
