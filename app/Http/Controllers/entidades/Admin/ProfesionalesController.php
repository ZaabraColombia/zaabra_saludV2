<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\especialidades;
use App\Models\pais;
use App\Models\profesionales_instituciones;
use App\Models\TipoDocumento;
use App\Models\universidades;
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

        return view('instituciones.admin.profesionales.index',compact(
            'profesionales'
        ));
    }

    public function create()
    {
        $tipo_documentos = TipoDocumento::all();
        $paises = pais::all();
        $universidades = universidades::all();
        $especialidades = especialidades::all();


        return view('instituciones.admin.profesionales.crear', compact(
            'tipo_documentos',
            'paises',
            'universidades',
            'especialidades',
        ));
    }

    public function store(Request $request)
    {
        //Validar
        //$this->validator($request);

        $id_institucion = Auth::user()->institucion->id;
        $request->merge(['id_institucion' => $id_institucion]);

        //Guardar foto
        if ($request->file('foto'))
        {
            $foto = $request->file('foto');
            $nombre_foto = 'profesional-' . time() . '.' . $foto->guessExtension();
            $url = $foto->move("img/instituciones/{$id_institucion}/profesionales/", $nombre_foto);
            $request->merge(['foto_perfil_institucion' => $url->getPathname()]);
        }

        $profesional = profesionales_instituciones::query()->create($request->all());

        $profesional->especialidades()->sync($request->get('especialidades'));

        return redirect()->route('institucion.profesionales.index')
            ->with('success', "El profesional {$profesional->nombre_completo} se ha creado");

    }

    private function validator (Request $request)
    {
        $request->validate([
            'id_universidad'    => ['required', 'exists:universidades,id_universidad'],
            'id_especialidad'   => ['required', 'exists:especialidades,idEspecialidad'],
            'especialidades.*'  => ['nullable', 'exists:especialidades,idEspecialidad'],
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
            'correo'            => ['required', 'email', 'max:45', 'unique:profesionales_instituciones,correo'],
            'sitio_web'         => ['nullable', 'url', 'max:100'],
            'linkedin'          => ['nullable', 'url', 'max:100'],
            'red_social'        => ['nullable', 'url', 'max:100'],
            'rethus'            => ['required', 'max:45'],
            'numero_profesional'=> ['required', 'max:45'],
            'foto'              => ['nullable', 'image']
        ], [], [
            'id_universidad'    => 'Universidad',
            'id_especialidad'   => 'Especialidad',
            'especialidades.*'  => 'Otras especialidades',
            'primer_nombre'     => 'Primer nombre',
            'segundo_nombre'    => 'Segundo nombre',
            'primer_apellido'   => 'Primer apellido',
            'segundo_apellido'  => 'Segundo apellido',
            'tipo_documento_id' => 'Tipo de documento',
            'numero_documento'  => 'Número de identificación',
            'fecha_nacimiento'  => 'Fecha de nacimiento',
            'direccion'         => 'Dirección',
            'telefono'          => 'Teléfono',
            'celular'           => 'Celular',
            'pais_id'           => 'País',
            'departamento_id'   => 'Departamento',
            'provincia_id'      => 'Provincia',
            'ciudad_id'         => 'Ciudad',
            'correo'            => 'Correo',
            'sitio_web'         => 'Sitio web',
            'linkedin'          => 'Linkedin',
            'red_social'        => 'Otra red social',
            'rethus'            => 'RETHUS',
            'numero_profesional'=> 'Número profesional',
            'foto'              => 'Foto',
        ]);
    }
}
