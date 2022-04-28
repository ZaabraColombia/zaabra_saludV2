<?php

namespace App\Http\Controllers\buscador;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\profesionales_instituciones;
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

    public function search(Request $request)
    {

        //Recuperamos lo que el usuario escribió en el buscador
        $term = $request->get('term');

        //si esta vacío
        if (empty($term))
        {
            //Busquedad profesiones paar envio a la vista de profesiones
            $profesiones = profesiones::query()
                ->where('estado', '=', 1)
                ->where('nombreProfesion','like','%' . $term . '%')
                ->select(
                    'nombreProfesion as label',
                    DB::raw('CONCAT("' . url('/ramas-de-la-salud/') . '/", slug) as url'),
                    DB::raw('CONCAT("fas fa-stethoscope icon_esp_med") as icon')
                )
                ->get();

            return response($profesiones->toArray(), 200);
        }

        //Busquedad profesiones paar envio a la vista de profesiones
        $profesiones = profesiones::query()
            ->where('estado', '=', 1)
            ->where('nombreProfesion','like','%' . $term . '%')
            ->select(
                'nombreProfesion as label',
                DB::raw('CONCAT("' . url('/ramas-de-la-salud/') . '/", slug) as url'),
                DB::raw('CONCAT("fas fa-stethoscope icon_esp_med") as icon')
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
                DB::raw('CONCAT("fas fa-user-md icon_esp_med") as icon'),
                DB::raw('IF (fotoperfil is not null, concat("' . url('/') . '/", fotoperfil) , null) as image')
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
                DB::raw('CONCAT("fas fa-hospital-alt icon_inst_med") as icon')
            )
            ->get();

        $ins_profesionales = profesionales_instituciones::query()
            ->select('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'id_profesional_inst', 'id_institucion')
            ->selectRaw('concat(primer_nombre, " ", primer_apellido) as nombre_prof')
            ->selectRaw('concat("especialidad") as type')
            ->addSelect([
                'type' => especialidades::query()
                    ->select('nombreEspecialidad as type')
                    ->join('institucion_profesionales_especialidades as prof_t', 'prof_t.id_especialidad', '=', 'especialidades.idEspecialidad', 'left')
                    ->join('profesionales_instituciones as prof_p', 'prof_p.id_especialidad', '=', 'especialidades.idEspecialidad', 'left')
                    ->where(function ($query) {
                        $query->whereColumn('prof_t.id_institucion_profesional', 'profesionales_instituciones.id_profesional_inst')
                            ->orWhereColumn('prof_p.id_profesional_inst', 'profesionales_instituciones.id_profesional_inst');
                    })
                    ->where('nombreEspecialidad', 'like', "%$term%")
                    ->take(1),
                'place' => User::query()
                    ->select('nombreinstitucion as place')
                    ->whereHas('institucion_public', function (Builder $query){
                        $query->whereColumn('instituciones.id', 'profesionales_instituciones.id_institucion');
                    })
                    ->take(1),
                'slug' => instituciones::query()
                    ->select('slug')
                    ->whereColumn('instituciones.id', 'profesionales_instituciones.id_institucion')
                    ->take(1),
            ])
            ->where(function ($query) use ($term) {
                $query
                    ->whereHas('especialidad_pricipal', function ($query) use ($term){
                        return $query->where('nombreEspecialidad', 'like', "%$term%");
                    })
                    ->orWhereHas('especialidades', function ($query) use ($term){
                        return $query->where('nombreEspecialidad', 'like', "%$term%");
                    });
            })
            ->orWhere(function ($query) use ($term){
                return $query->where('primer_nombre','like','%' . $term . '%')
                    ->orWhere('segundo_nombre','like','%' . $term . '%')
                    ->orWhere('primer_apellido','like','%' . $term . '%')
                    ->orWhere('segundo_apellido','like','%' . $term . '%');
            })
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->nombre_completo,
                    'type'  => "$item->type / $item->place",
                    'url'   => route('PerfilInstitucion-profesionales', ['slug' => $item->slug, 'prof' => "$item->primer_nombre $item->primer_apellido"]),
                    'icon' => 'fas fa-stethoscope icon_prof_inst'
                ];
            });

        $data = array_merge($profesiones->toArray(), $profesionales->toArray(), $instituciones->toArray(), $ins_profesionales->toArray());
        //$data = $ins_profesionales->toArray();

        return response($data, Response::HTTP_OK);
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
            ->select('numerodocumento as id', 'numerodocumento as text', 'primernombre', 'segundonombre', 'primerapellido', 'segundoapellido', 'email', 'tipodocumento', 'numerodocumento', 'email')
            ->selectRaw('CONCAT(primernombre, " ") as identificacion')
            ->selectRaw('CONCAT(primernombre, " ",segundonombre) as nombre, CONCAT(primerapellido, " ",segundoapellido) as apellido')
            ->addSelect([
                'foto' => Paciente::query()
                    ->selectRaw("IF(foto is not null, concat( '" . url('/') ."/', foto), '" . asset('img/menu/avatar.png') . "')")
                    ->whereColumn('pacientes.id_usuario', 'users.id')
                    ->take(1)
            ])
            ->where('numerodocumento','like','%' . $request->searchTerm . '%')
            ->orderBy('numerodocumento','ASC')
            ->whereHas('roles', function (Builder $query){
                $query->where('idrol', '=', 1);
            })->get();

        return response($patients, Response::HTTP_OK);
    }
}

