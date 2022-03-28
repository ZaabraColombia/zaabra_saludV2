<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\profesionales_instituciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfesionalesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profesionales = profesionales_instituciones::query()
            ->where('id_institucion', '=', $user->institucion->id)
            ->get();

        return view('instituciones.admin.profesionales.index',compact('profesionales'));
    }

    public function create()
    {
        return view('instituciones.admin.profesionales.crear');
    }

    public function store(Request $request)
    {
        //Validar
        $this->validator($request);

        //Guardar foto
        if ($request->file('foto'))
        {
            $foto = $request->file('foto');
            $nombre_foto = 'profesional-' . time() . '.' . $foto->guessExtension();

            $request->merge(['foto_perfil_institucion' => $foto->move("img/instituciones/{}/profesionales/", $nombre_foto)]);
        }

        $profesional = profesionales_instituciones::query()->create($request->all());

        return redirect()->route('institucion.profesionales.index')
            ->with('success', "El profesional {$profesional->nombre_completo} se ha creado");

    }

    private function validator (Request $request)
    {
        $request->validate([
            'id_institucion'    => ['required', 'exists:instituciones,id'],
            'id_universidad'    => ['required', 'exists:universidades,id_universidad'],
            'id_especialidad'   => ['required', 'exists:especialidades,idEspecialidad'],
            'primer_nombre'     => ['required', 'max:45'],
            'segundo_nombre'    => ['required', 'max:45'],
            'primer_apellido'   => ['required', 'max:45'],
            'segundo_apellido'  => ['required', 'max:45'],
            'tipo_documento_id' => ['required', 'exists:tipo_documentos,id'],
            'numero_documento'  => ['required', 'max:50'],
            'fecha_nacimiento'  => ['required', 'date_format:Y-m-d'],
            'direccion'         => ['required', 'max:100'],
            'telefono'          => ['required', 'max:45'],
            'celular'           => ['required', 'max:45'],
            'pais_id'           => ['required', 'exists:pais,id_pais'],
            'departamento_id'   => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'      => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'         => ['required', 'exists:municipios,id_municipio'],
            'correo'            => ['required', 'email', 'max:45'],
            'sitio_web'         => ['required', 'url', 'max:100'],
            'linkedin'          => ['required', 'url', 'max:100'],
            'red_social'        => ['required', 'url', 'max:100'],
            'rethus'            => ['required', 'max:45'],
            'numero_profesional'=> ['required', 'max:45'],
            'foto'              => ['nullable', 'image']
        ]);
    }
}
