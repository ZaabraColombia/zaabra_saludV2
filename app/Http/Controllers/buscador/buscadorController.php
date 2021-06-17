<?php

namespace App\Http\Controllers\buscador;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\profesiones;
use App\Models\especialidades;
use App\Models\perfilesprofesionales;
use App\Models\instituciones;
use App\Models\pais;
use Illuminate\Http\Request;

class buscadorController extends Controller
{
    public function filtroBusquedad(Request $request){
       
        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->get('term');

        //Busqued profesionales junto a la especialidad y envia a la landing del mismo
        $querysProfeespe = DB::table('perfilesprofesionales')
        ->select(DB::raw('CONCAT(users.primernombre," ", users.primerapellido," / " ,especialidades.nombreEspecialidad) as nombreEspecialidad'))
        ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
        ->leftjoin('especialidades', 'perfilesprofesionales.idespecialidad', '=', 'especialidades.idEspecialidad')
        ->where('especialidades.nombreEspecialidad','like','%' . $term . '%')
        ->where('perfilesprofesionales.aprobado', '<>',0)
        ->get();

        //Busquedad profesiones paar envio a la vista de profesiones
        $queryProfesion = profesiones::where('nombreProfesion','like','%' . $term . '%')->get();


        //Busquedad profesionales del filtro para envio la landing del mismo
        $querysProfesional = DB::table('perfilesprofesionales')
        ->select(DB::raw('CONCAT(users.primernombre, " " ,users.primerapellido) as nombreProfesional, perfilesprofesionales.fotoperfil'))
        ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
        ->where('users.primernombre','like','%' . $term . '%')
        ->where('perfilesprofesionales.aprobado', '<>',0)
        ->get();


        //Busquedad instituciones del filtro para envio la landing del mismo
        $querysInstitucion = DB::table('instituciones')
        ->select('users.nombreinstitucion')
        ->join('users', 'instituciones.idUser', '=', 'users.id')
        ->where('users.nombreinstitucion','like','%' . $term . '%')
        ->where('instituciones.aprobado', '<>',0)
        ->get();

        //Busquedad instituciones junto a su tipo del filtro para envio la landing del mismo
        $querysTipoInstitucion = DB::table('instituciones')
        ->select(DB::raw('CONCAT(users.nombreinstitucion, " / " ,tipoinstituciones.nombretipo) as nombretipo'))
        ->join('users', 'instituciones.idUser', '=', 'users.id')
        ->join('tipoinstituciones', 'instituciones.idtipoInstitucion', '=', 'tipoinstituciones.id')
        ->where('tipoinstituciones.nombretipo','like','%' . $term . '%')
        ->where('instituciones.aprobado', '<>',0)
        ->get();

        $data1=[];
   
        foreach($queryProfesion as $queryprofesion){
            $data1[]=[
                'value'=>"/hola",
                'label'=>$queryprofesion->nombreProfesion,
            ];
           }

        foreach($querysProfeespe as $queryprofeespe){
            $data1[]=[
                'value'=>"/Profesiones",
                'label'=>$queryprofeespe->nombreEspecialidad,
            ];
        }
       foreach($querysProfesional as $queryprofesional){
        $data1[]=[
            'value'=>"/hola2",
            'label'=>$queryprofesional->nombreProfesional,
            'icon'=> $queryprofesional->fotoperfil
        ];
       }
       foreach($querysInstitucion as $querysinstitucion){
        $data1[]=[
            'value'=>"/hola2",
            'label'=>$querysinstitucion->nombreinstitucion
        ];
       }
       foreach($querysTipoInstitucion as $querysTipoinstitucion){
        $data1[]=[
            'value'=>"/hola2",
            'label'=>$querysTipoinstitucion->nombretipo
        ];
       }


        return $data1;

        }
}

