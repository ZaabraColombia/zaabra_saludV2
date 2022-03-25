<?php

namespace App\Http\Controllers\buscador;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\profesiones;
use App\Models\especialidades;
use App\Models\perfilesprofesionales;
use App\Models\instituciones;
use App\Models\pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class buscadorController extends Controller
{
    public function filtroBusquedad(Request $request){

        //tomamos la ruta actual
        $ruta='http://127.0.0.1:8000/';

        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->get('term');

        //Busquedad profesiones paar envio a la vista de profesiones
        $queryProfesion = profesiones::where('nombreProfesion','like','%' . $term . '%')->get();


        //Busquedad profesionales junto a la especialidad y envia a la landing del mismo
        $querysProfeespe = DB::table('perfilesprofesionales')
            ->select(DB::raw('CONCAT("Dr/Dra. ",users.primernombre," ", users.primerapellido," / " ,especialidades.nombreEspecialidad) as nombreEspecialidad, perfilesprofesionales.idPerfilProfesional as idprofe') )
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->leftjoin('especialidades', 'perfilesprofesionales.idespecialidad', '=', 'especialidades.idEspecialidad')
            ->where('especialidades.nombreEspecialidad','like','%' . $term . '%')
            ->where('perfilesprofesionales.aprobado', '<>',0)
            ->get();


        //Busquedad profesionales del filtro para envio la landing del mismo
        $querysProfesional = DB::table('perfilesprofesionales')
            ->select(DB::raw('CONCAT("Dr/Dra. ",users.primernombre, " " ,users.primerapellido) as nombreProfesional, perfilesprofesionales.idPerfilProfesional as idprofe'))
            ->join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->where('users.primernombre','like','%' . $term . '%')
            ->where('perfilesprofesionales.aprobado', '<>',0)
            ->get();


        //Busquedad instituciones del filtro para envio la landing del mismo
        $querysInstitucion = DB::table('instituciones')
            ->select(DB::raw('users.nombreinstitucion, instituciones.id as idInstitucion'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->where('users.nombreinstitucion','like','%' . $term . '%')
            ->where('instituciones.aprobado', '<>',0)
            ->get();

        //Busquedad instituciones junto a su tipo del filtro para envio la landing del mismo
        $querysTipoInstitucion = DB::table('instituciones')
            ->select(DB::raw('CONCAT(users.nombreinstitucion, " / " ,tipoinstituciones.nombretipo) as nombretipo,instituciones.id as idInstitucion'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->join('tipoinstituciones', 'instituciones.idtipoInstitucion', '=', 'tipoinstituciones.id')
            ->where('tipoinstituciones.nombretipo','like','%' . $term . '%')
            ->where('instituciones.aprobado', '<>',0)
            ->get();

        $data1=[];

        /*Recorrido para profesiones*/
        foreach($queryProfesion as $queryprofesion){
            $data1[]=[
                'id'=> $ruta."ramas-de-la-salud",
                'label'=>$queryprofesion->nombreProfesion,
            ];
        }

        /*Recorrido para profesionales junto a especialidades*/
        foreach($querysProfeespe as $queryprofeespe){
            $data1[]=[
                'id'=> $ruta.'PerfilProfesional/'.$queryprofeespe->idprofe,
                'label'=>$queryprofeespe->nombreEspecialidad,
            ];
        }
        /*Recorrido para profesionales solo el nombre*/
        foreach($querysProfesional as $queryprofesional){
            $data1[]=[
                'id'=> $ruta."PerfilProfesional/".$queryprofesional->idprofe,
                'label'=>$queryprofesional->nombreProfesional,
            ];
        }
        /*Recorrido para institucion solo el nombre*/
        foreach($querysInstitucion as $querysinstitucion){
            $data1[]=[
                'id'=> $ruta."PerfilInstitucion/".$querysinstitucion->idInstitucion,
                'label'=>$querysinstitucion->nombreinstitucion
            ];
        }
        /*Recorrido para institucion junto al tipo de institucion*/
        foreach($querysTipoInstitucion as $querysTipoinstitucion){
            $data1[]=[
                'value'=> $ruta."PerfilInstitucion/".$querysTipoinstitucion->idInstitucion,
                'label'=>$querysTipoinstitucion->nombretipo
            ];
        }


        return $data1;

    }

    public function search(Request $request)
    {

        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->get('term');

        //si esta vacío
        if (empty($term))
        {
            //Busquedad profesiones paar envio a la vista de profesiones
            $profesiones = profesiones::where('nombreProfesion','like','%' . $term . '%')
                ->select(
                    'nombreProfesion as label',
                    DB::raw('CONCAT("' . url('/Especialidades/') . '/", slug) as url'),
                    DB::raw('CONCAT("fas fa-stethoscope") as icon')
                )
                ->get();

            return response($profesiones->toArray(), 200);
        }

        //Busquedad profesiones paar envio a la vista de profesiones
        $profesiones = profesiones::where('nombreProfesion','like','%' . $term . '%')
            ->select(
                'nombreProfesion as label',
                DB::raw('CONCAT("' . url('/Especialidades/') . '/", slug) as url'),
                DB::raw('CONCAT("fas fa-stethoscope") as icon')
            )
            ->get();


        $profesionales = perfilesprofesionales::join('users', 'perfilesprofesionales.idUser', '=', 'users.id')
            ->join('especialidades', 'perfilesprofesionales.idespecialidad', '=', 'especialidades.idEspecialidad')
            ->where('perfilesprofesionales.aprobado', '=', 1)
            ->where(function ($query) use ($term){
                return $query->where('users.primernombre','like','%' . $term . '%')
                    ->orWhere('users.segundonombre','like','%' . $term . '%')
                    ->orWhere('users.primerapellido','like','%' . $term . '%')
                    ->orWhere('users.segundoapellido','like','%' . $term . '%');
            })
            ->orWhere('especialidades.nombreEspecialidad','like','%' . $term . '%')
            ->select(
                DB::raw('CONCAT(COALESCE(users.primernombre, ""), " ", COALESCE(users.segundonombre, ""), " ", COALESCE(users.primerapellido, "")) as label'),
                DB::raw('especialidades.nombreEspecialidad as type'),
                DB::raw('CONCAT("' . url('/PerfilProfesional') . '/", perfilesprofesionales.slug) as url'),
                DB::raw('CONCAT("fas fa-user-md") as icon')
            )->get();

        $instituciones = instituciones::join('users', 'instituciones.idUser', '=', 'users.id')
            ->join('tipoinstituciones', 'instituciones.idtipoInstitucion', '=', 'tipoinstituciones.id')
            ->where('instituciones.aprobado', '=', 1)
            ->where(function ($query) use ($term){
                return $query->where('users.nombreinstitucion','like','%' . $term . '%')
                    ->orWhere('tipoinstituciones.nombretipo','like','%' . $term . '%');
            })
            ->select(
                DB::raw('tipoinstituciones.nombretipo as label'),
                DB::raw('users.nombreinstitucion as type'),
                DB::raw('CONCAT("' . url('/PerfilInstitucion') . '/", instituciones.slug) as url'),
                DB::raw('CONCAT("fas fa-hospital-alt") as icon')
            )
            ->get();

        $data = array_merge($profesiones->toArray(), $profesionales->toArray(), $instituciones->toArray());

        return response($data, 200);
    }


    public function buscar_paciente(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(),[
            'searchTerm' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'     => $validator->errors(),
                'mensaje'   => __('trans.search-incorrect')
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $patients = User::query()
            ->select('numerodocumento as id', 'numerodocumento as text', 'primernombre', 'segundonombre', 'primerapellido', 'segundoapellido', 'email')
            ->selectRaw('CONCAT(primernombre, " ",segundonombre) as nombre, CONCAT(primerapellido, " ",segundoapellido) as apellido')
            ->where('numerodocumento','like','%' . $request->searchTerm . '%')
            ->orderBy('numerodocumento','ASC')
            ->whereHas('roles', function (Builder $query){
                $query->where('idrol', '=', 1);
            })->get();

        return response($patients, Response::HTTP_OK);
    }
}

