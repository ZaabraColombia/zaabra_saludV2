<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
use App\Models\Convenios;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\pais;
use App\Models\provincia;
use App\Models\Sgsss;
use App\Models\TipoContribuyente;
use App\Models\TipoDocumento;
use App\Models\tipoinstituciones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ConveniosController extends Controller
{

    /**
     * Listar todos los registros de convenio
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        Gate::authorize('accesos-institucion','ver-convenios');

        //Obtener él id de la institución, se hace el recorrido por los diferentes roles
        $id_institucion =  Auth::user()->institucion->user->id;
        $convenios = Convenios::query()->where('id_user', $id_institucion)->get();

        return view('instituciones.admin.configuracion.convenios.index', compact('convenios'));
    }

    /**
     * Mostrar la vista que tiene el formulario para crear convenio
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        Gate::authorize('accesos-institucion','agregar-convenio');

        $tipo_contribuyentes = TipoContribuyente::all();
        $actividades_economicas = ActividadEconomica::all();
        $tipo_documentos = TipoDocumento::all();
        $tipo_convenios = tipoinstituciones::activado()->get();

        $paises = pais::all();

        return view('instituciones.admin.configuracion.convenios.crear', compact('tipo_documentos',
            'actividades_economicas', 'tipo_contribuyentes', 'paises', 'tipo_convenios'));
    }

    public function show($convenio)
    {
        $validate = Validator::make(['convenio' => $convenio], [
            'convenio' => [
                'required',
                Rule::exists('convenios', 'id')
                    ->where('id_user', Auth::user()->institucion->idUser)
            ]
        ]);

        if ($validate->fails())
            return response([
                'message' => [
                    'title' => 'No se encontró el convenio',
                    'text'  => ''
                ]
            ]);

        $convenio = Convenios::query()
            ->select('convenios.*')
            ->addSelect([
                'sgsss' => Sgsss::query()->select('codigo as sgsss')->whereColumn('sgsss_id', 'sgsss.id')->take(1),
                'tipo_contribuyente' => TipoContribuyente::query()->select('nombre as tipo_contribuyente')->whereColumn('tipo_contribuyente_id', 'tipo_contribuyentes.id')->take(1),
                'actividad_economica' => ActividadEconomica::query()->select('nombre as actividad_economica')->whereColumn('actividad_economica_id', 'actividades_economicas.id')->take(1),
                'tipo_convenio' => tipoinstituciones::query()->select('nombretipo as tipo_convenio')->whereColumn('id_tipo_convenio', 'tipoinstituciones.id')->take(1),
                'pais' => pais::query()->select('nombre as pais')->whereColumn('pais_id', 'pais.id_pais')->take(1),
                'departamento' => departamento::query()->select('nombre as departamento')->whereColumn('departamento_id', 'departamentos.id_departamento')->take(1),
                'provincia' => provincia::query()->select('nombre as provincia')->whereColumn('provincia_id', 'provincias.id_provincia')->take(1),
                'ciudad' => municipio::query()->select('nombre as ciudad')->whereColumn('ciudad_id', 'municipios.id_municipio')->take(1)
            ])
            ->where('id', $convenio)
            ->first();

        return response([
            'item' => $convenio
        ], Response::HTTP_OK);
    }

    /**
     * Validar y guarda el convenio
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Gate::authorize('accesos-institucion','agregar-convenio');

        $this->validator($request);

        //Guardar foto
        if ($request->file('foto'))
        {
            $id_institucion = Auth::user()->institucion->id;
            $foto = $request->file('foto');
            $nombre_foto = Str::random(10) . '.' . $foto->guessExtension();
            $url = $foto->move("img/instituciones/{$id_institucion}/convenios/", $nombre_foto);
            $request->merge(['url_image' => $url->getPathname()]);
        }

        //Cambia el estado a activo
        $request->merge(['estado' => 1]);

        //Obtener el id de la institución, se hace el recorrido por los diferentes roles
        $id_institucion =  Auth::user()->institucion->user->id;
        $request->merge(['id_user' => $id_institucion]);


        $convenio = Convenios::query()->create($request->all());

        return redirect()->route('institucion.configuracion.convenios.index')
            ->with('success', "El convenio {$convenio->nombre_completo} se ha creado");
    }

    /**
     * Mostrar el formulario para editar el convenio
     *
     * @param Convenios $convenio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Convenios $convenio)
    {
        Gate::authorize('accesos-institucion','editar-convenio');
        Gate::authorize('update-convenio-institucion', $convenio);

        $tipo_contribuyentes = TipoContribuyente::all();
        $actividades_economicas = ActividadEconomica::all();
        $tipo_documentos = TipoDocumento::all();
        $paises = pais::all();
        $tipo_convenios = tipoinstituciones::activado()->get();

        return view('instituciones.admin.configuracion.convenios.editar', compact('tipo_documentos',
            'actividades_economicas','tipo_contribuyentes', 'paises', 'convenio', 'tipo_convenios'
        ));
    }

    public function update(Request $request, Convenios $convenio)
    {
        Gate::authorize('accesos-institucion','editar-convenio');
        Gate::authorize('update-convenio-institucion', $convenio);

        $this->validator($request);

        //Guardar foto
        if ($request->file('foto'))
        {
            if (File::exists($convenio->url_image)) File::delete($convenio->url_image);

            //Obtener él id de institución
            $id_institucion = Auth::user()->institucion->id;

            //Subir la foto
            $foto = $request->file('foto');
            $nombre_foto = Str::random(10) . '.' . $foto->guessExtension();
            $url = $foto->move("img/instituciones/{$id_institucion}/convenios/", $nombre_foto);

            //Guardar la Url
            $request->merge(['url_image' => $url->getPathname()]);

        }

        $convenio->update($request->all());

        return redirect()->route('institucion.configuracion.convenios.index')
            ->with('success', "El convenio {$convenio->nombre_completo} se ha editado");

    }
    public function validator(Request $request)
    {
        $request->validate([
            'primer_nombre'         => ['required', 'max:255'],
            'segundo_nombre'        => ['nullable', 'max:45'],
            'primer_apellido'       => ['nullable', 'max:45'],
            'segundo_apellido'      => ['nullable', 'max:45'],
            'tipo_documento_id'     => ['required', 'exists:tipo_documentos,id'],
            'numero_documento'      => ['required', 'max:45'],
            'dv_documento'          => ['nullable', 'max:45'],
            'sgsss_id'              => ['nullable', 'exists:sgsss,id'],
            'codigo_convenio'       => ['required', 'max:45'],
            'tipo_contribuyente_id' => ['required', 'exists:tipo_contribuyentes,id'],
            'actividad_economica_id'=> ['required', 'exists:actividades_economicas,id'],
            'forma_pago'            => ['required', Rule::in('efectivo', 'transferencia', 'tarjeta', 'consignación')],
            'tipo_establecimiento'  => ['required', Rule::in('oficina', 'consultorio', 'institución', 'edificio')],
            'direccion'             => ['required', 'max:100'],
            'codigo_postal'         => ['required', 'max:10'],
            'pais_id'               => ['required', 'exists:pais,id_pais'],
            'departamento_id'       => ['required', 'exists:departamentos,id_departamento'],
            'provincia_id'          => ['required', 'exists:provincias,id_provincia'],
            'ciudad_id'             => ['required', 'exists:municipios,id_municipio'],
            'telefono'              => ['nullable', 'max:100'],
            'celular'               => ['nullable', 'max:100'],
            'correo'                => ['required', 'max:255', 'email'],
            'foto'                  => ['nullable', 'image'],
        ], [], [
            'primer_nombre'         => 'Primer nombre',
            'segundo_nombre'        => 'Segundo nombre',
            'primer_apellido'       => 'Primer apellido',
            'segundo_apellido'      => 'Segundo apellido',
            'tipo_documento_id'     => 'Tipo de documento',
            'numero_documento'      => 'Número de documento',
            'dv_documento'          => 'DV',
            'sgsss_id'              => 'Código del prestador del servicio',
            'codigo_convenio'       => 'Código del convenio',
            'tipo_contribuyente_id' => 'Tipo de contribuyente',
            'actividad_economica_id'=> 'Actividad económica',
            'forma_pago'            => 'Forma de pago',
            'tipo_establecimiento'  => 'Tipo de establecimiento',
            'direccion'             => 'Dirección',
            'codigo_postal'         => 'Código postal',
            'pais_id'               => 'País',
            'departamento_id'       => 'Departamento',
            'provincia_id'          => 'Provincia',
            'ciudad_id'             => 'Ciudad',
            'telefono'              => 'Teléfono',
            'celular'               => 'Móvil',
            'correo'                => 'Correo',
            'foto'                  => 'Foto'
        ]);
    }
}
