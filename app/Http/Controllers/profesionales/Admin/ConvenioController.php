<?php

namespace App\Http\Controllers\profesionales\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadEconomica;
use App\Models\Convenios;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\paises;
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

class ConvenioController extends Controller
{
    public function index()
    {
        Gate::authorize('accesos-profesional', 'ver-convenios');
        $convenios = Convenios::query()
            ->where('id_user', Auth::user()->profesional->idUser)
            ->with('tipo_identificacion')
            ->get();
        return view('profesionales.admin.configuracion.convenios.index', compact('convenios'));
    }

    public function create()
    {
        Gate::authorize('accesos-profesional', 'agregar-convenio');

        $tipo_contribuyentes = TipoContribuyente::all();
        $actividades_economicas = ActividadEconomica::all();
        $tipo_documentos = TipoDocumento::all();
        $tipo_convenios = tipoinstituciones::activado()->get();

        $paises = paises::all();


        return view('profesionales.admin.configuracion.convenios.crear', compact('tipo_documentos',
            'actividades_economicas', 'tipo_contribuyentes', 'paises', 'tipo_convenios'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Gate::authorize('accesos-profesional', 'editar-convenio');

        $this->validator($request);

        $id_profesional = Auth::user()->profesional->idUser;

        //Guardar foto
        if ($request->file('foto'))
        {
            $foto = $request->file('foto');
            $nombre_foto = Str::random(10) . '.' . $foto->guessExtension();
            $url = $foto->move("img/profesional/{$id_profesional}/convenios", $nombre_foto);
            $request->merge(['url_image' => $url->getPathname()]);
        }

        //Obtener ??l, id del profesional, se hace el recorrido por los diferentes roles
        $request->merge(['id_user' => $id_profesional]);


        $convenio = Convenios::query()->create($request->all());

        return redirect()->route('profesional.configuracion.convenios.index')
            ->with('success', "El convenio {$convenio->nombre_completo} se ha creado");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($convenio)
    {
        Gate::authorize('accesos-profesional', 'ver-convenios');

        $validate = Validator::make(['convenio' => $convenio], [
            'convenio' => [
                'required',
                Rule::exists('convenios', 'id')
                    ->where('id_user', Auth::user()->profesional->idUser)
            ]
        ]);

        if ($validate->fails())
            return response([
                'message' => [
                    'title' => 'No se encontr?? el convenio',
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
                'pais' => paises::query()->select('nombre as pais')->whereColumn('pais_id', 'pais.id_pais')->take(1),
                'departamento' => departamento::query()->select('nombre as departamento')->whereColumn('departamento_id', 'departamentos.id_departamento')->take(1),
                'provincia' => provincia::query()->select('nombre as provincia')->whereColumn('provincia_id', 'provincias.id_provincia')->take(1),
                'ciudad' => municipio::query()->select('nombre as ciudad')->whereColumn('ciudad_id', 'municipios.id_municipio')->take(1)
            ])
            ->where('id', $convenio)
            ->first();


        $convenio->foto = asset($convenio->url_image ?? 'img/menu/avatar.png');

        return response([
            'item' => $convenio
        ], Response::HTTP_OK);
    }

    /**
     * @param Convenios $convenio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Convenios $convenio)
    {
        Gate::authorize('accesos-profesional', 'editar-convenio');
        Gate::authorize('update-convenio-profesional', $convenio);

        $tipo_contribuyentes = TipoContribuyente::all();
        $actividades_economicas = ActividadEconomica::all();
        $tipo_documentos = TipoDocumento::all();
        $paises = paises::all();
        $tipo_convenios = tipoinstituciones::activado()->get();

        return view('profesionales.admin.configuracion.convenios.editar', compact('tipo_documentos',
            'actividades_economicas','tipo_contribuyentes', 'paises', 'convenio', 'tipo_convenios'));
    }

    /**+
     * @param Request $request
     * @param Convenios $convenio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Convenios $convenio)
    {
        Gate::authorize('accesos-profesional', 'editar-convenio');
        Gate::authorize('update-convenio-profesional', $convenio);

        $this->validator($request);

        $id_profesional = Auth::user()->profesional->idUser;

        //Guardar foto
        if ($request->file('foto'))
        {
            if (File::exists($convenio->url_image)) File::delete($convenio->url_image);


            //Subir la foto
            $foto = $request->file('foto');
            $nombre_foto = Str::random(10) . '.' . $foto->guessExtension();
            $url = $foto->move("img/profesional/{$id_profesional}/convenios", $nombre_foto);

            //Guardar la Url
            $request->merge(['url_image' => $url->getPathname()]);

        }

        $convenio->update($request->all());

        return redirect()->route('profesional.configuracion.convenios.index')
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
            'forma_pago'            => ['required', Rule::in('efectivo', 'transferencia', 'tarjeta', 'consignaci??n')],
            'tipo_establecimiento'  => ['required', Rule::in('oficina', 'consultorio', 'instituci??n', 'edificio')],
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
            'numero_documento'      => 'N??mero de documento',
            'dv_documento'          => 'DV',
            'sgsss_id'              => 'C??digo del prestador del servicio',
            'codigo_convenio'       => 'C??digo del convenio',
            'tipo_contribuyente_id' => 'Tipo de contribuyente',
            'actividad_economica_id'=> 'Actividad econ??mica',
            'forma_pago'            => 'Forma de pago',
            'tipo_establecimiento'  => 'Tipo de establecimiento',
            'direccion'             => 'Direcci??n',
            'codigo_postal'         => 'C??digo postal',
            'pais_id'               => 'Pa??s',
            'departamento_id'       => 'Departamento',
            'provincia_id'          => 'Provincia',
            'ciudad_id'             => 'Ciudad',
            'telefono'              => 'Tel??fono',
            'celular'               => 'M??vil',
            'correo'                => 'Correo',
            'foto'                  => 'Foto'
        ]);
    }
}
