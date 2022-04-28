<?php

namespace App\Http\Controllers\entidades\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\especialidades;
use App\Models\pais;
use App\Models\profesionales_instituciones;
use App\Models\sedesinstituciones;
use App\Models\Servicio;
use App\Models\TipoDocumento;
use App\Models\universidades;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfesionalesController extends Controller
{
    /**
     * Retorna vista para listar a todos los profesionales
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        Gate::authorize('accesos-institucion','ver-profesionales');

        $user = Auth::user();
        $profesionales = profesionales_instituciones::query()
            ->where('id_institucion', '=', $user->institucion->id)
            ->get();

        return view('instituciones.admin.profesionales.index',compact(
            'profesionales'
        ));
    }

    /**
     * Retorna vista para poder crear a un profesional
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        Gate::authorize('accesos-institucion','agregar-profesional');

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

    /**
     * Obtiene la información necesaria para crear a un profesional
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        Gate::authorize('accesos-institucion','agregar-profesional');

        //Validar
        $this->validator($request, 'created');

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

        $profesional->update(['password' => Hash::make($request->get('password'))]);

        $profesional->especialidades()->sync($request->get('especialidades'));

        return redirect()->route('institucion.profesionales.index')
            ->with('success', "El profesional {$profesional->nombre_completo} se ha creado");

    }

    /**
     * Retorna vista para poder editar un usuario
     *
     * @param profesionales_instituciones $profesional
     * @return Application|Factory|View
     */
    public function edit(profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','editar-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        $tipo_documentos = TipoDocumento::all();
        $paises = pais::all();
        $universidades = universidades::all();
        $especialidades = especialidades::all();


        return view('instituciones.admin.profesionales.editar', compact(
            'tipo_documentos',
            'paises',
            'universidades',
            'especialidades',
            'profesional',
        ));
    }

    /**
     * Obtiene y valida la información para editar un profesional
     *
     * @param Request $request
     * @param profesionales_instituciones $profesional
     * @return RedirectResponse
     */
    public function update(Request $request, profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','editar-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        //dd($request->all());

        //Validar
        $this->validator($request, 'updated', $profesional->id_profesional_inst);

        $id_institucion = Auth::user()->institucion->id;
        $request->merge(['id_institucion' => $id_institucion]);

        //Guardar foto
        if ($request->file('foto'))
        {
            if (File::exists($profesional->foto_perfil_institucion)) File::delete($profesional->foto_perfil_institucion);

            $foto = $request->file('foto');
            $nombre_foto = 'profesional-' . time() . '.' . $foto->guessExtension();
            $url = $foto->move("img/instituciones/{$id_institucion}/profesionales/", $nombre_foto);
            $request->merge(['foto_perfil_institucion' => $url->getPathname()]);
        }

        $profesional->update($request->all());

        if (!empty($request->get('password')))
        {
            $profesional->update(['password' => Hash::make($request->get('password'))]);
        }

        $profesional->especialidades()->sync($request->get('especialidades'));

        return redirect()->route('institucion.profesionales.index')
            ->with('success', "El profesional {$profesional->nombre_completo} se ha editado");
    }

    /**
     * Retorna vista de configurar calendario
     *
     * @param profesionales_instituciones $profesional
     * @return Application|Factory|View
     */
    public function configurar_calendario(profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','configurar-calendario-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        $sedes = sedesinstituciones::query()
            ->where('idInstitucion', '=', Auth::user()->institucion->id)
            ->get();

        $servicios = Servicio::query()
            ->where('institucion_id', '=', Auth::user()->institucion->id )
            ->get();

        $servicios_profesional = $profesional->servicios->map(function ($item){
            return $item->id;
        });

        return view('instituciones.admin.profesionales.configuracion-calendario', compact(
            'profesional',
            'sedes',
            'servicios',
            'servicios_profesional'
        ));
    }

    /**
     * Guarda la configuración del calendario
     *
     * @param Request $request
     * @param profesionales_instituciones $profesional
     * @return Application|ResponseFactory|Response
     */
    public function guardar_calendario(Request $request, profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','configurar-calendario-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        $validator = Validator::make( $request->all(), [
            'disponibilidad_agenda' => ['required', 'integer'],
            'sede_id'               => ['required', 'exists:sedesinstituciones,id'],
            'consultorio'           => ['required', 'max:50'],
            'servicios.*'           => ['nullable', 'exists:servicios,id']
        ], [], [
            'disponibilidad_agenda' => 'Tiempo de disponibilidad de agenda',
            'sede_id'               => 'Sede',
            'consultorio'           => 'Número de consultorio',
            'servicios.*'           => 'Servicios',
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $servicios = $request->get('servicios');

        $profesional->update($request->all());

        $profesional->servicios()->sync($servicios);

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Disponibilidad actualizada'
            ]
        ], Response::HTTP_ACCEPTED);

    }

    /**
     * Permite guardar el horario
     *
     * @param Request $request
     * @param profesionales_instituciones $profesional
     * @return Application|ResponseFactory|Response
     */
    public function guardar_horario(Request $request, profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','configurar-calendario-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        $validator = Validator::make( $request->all(), [
            'semana'        => ['required'],
            'semana.*'      => ['required', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'hora_inicio'   => ['required', 'date_format:H:i'],
            'hora_final'    => ['required', 'date_format:H:i']
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        $schedule[] = [
            'id' => Str::random(10),
            'daysOfWeek'    => $request->get('semana'),
            'startTime'     => $request->get('hora_inicio'),
            'endTime'       => $request->get('hora_final'),
        ];
        //add schedule
        if (is_array($profesional->horario))
        {
            $profesional->horario = array_merge($profesional->horario, $schedule);
        } else {
            $profesional->horario = $schedule;
        }

        $profesional->save();

        //parce days in text
        foreach ($schedule[0]['daysOfWeek'] as $key => $item) $schedule[0]['daysOfWeek'][$key] = daysWeekText($item);

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Horario Agregado'
            ],
            'item'      => $schedule[0]
        ], Response::HTTP_ACCEPTED);
    }


    /**
     *  Eliminar un horario de un profesional
     *
     * @return Application|ResponseFactory|Response
     */
    public function eliminar_horario(Request $request, profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','configurar-calendario-profesional');
        Gate::authorize('update-profesional-institucion', $profesional);

        $validator = Validator::make( $request->all(), [
            'id'    => ['required']
        ]);

        if ($validator->fails())
        {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validator->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //schedule
        $schedule = $profesional->horario;

        //delete schedule
        $array = array_filter(array_combine(array_keys($schedule), array_column($schedule, 'id')));
        $key_schedule_delete = array_search($request->id, $array);

        unset($schedule[$key_schedule_delete]);

        //save
        $profesional->horario = $schedule;
        $profesional->save();

        return response([
            'message'   => [
                'title' => 'Hecho',
                'text'  => 'Horario Eliminado'
            ],
        ], Response::HTTP_OK);
    }

    public function bloquear_calendario(Request $request, profesionales_instituciones $profesional)
    {
        Gate::authorize('accesos-institucion','configurar-calendario-profesional');
        //Gate::authorize('update-bloquear-calendario', $profesional);

        //Validate date
        $validate = Validator::make($request->all(), [
            'fecha_inicio'  => ['required', 'date_format:Y-m-d\TH:i'],
            'fecha_fin'     => ['required', 'date_format:Y-m-d\TH:i'],
        ]);

        if ($validate->fails()) {
            return response([
                'message' => [
                    'title' => 'Error',
                    'text'  => '<ul><li>' . collect($validate->errors()->all())->implode('</li><li>') . '</li></ul>'
                ]
            ], Response::HTTP_NOT_FOUND);
        }


        $inicio = $request->fecha_inicio;
        $fin    = $request->fecha_fin;

        $validar_cita = Cita::query()
            ->validar($inicio, $fin)
            ->whereNotIn('estado', ['cancelado', 'completado'])
            ->count();

        if ($validar_cita > 0)
        {
            return response([
                'message' => [
                    'title'     => 'error',
                    'text'   => 'Existen citas en este rango de tiempo'
                ]
            ], Response::HTTP_NOT_FOUND);
        }

        //crear bloqueo
        $bloque = Cita::query()->create([
            'fecha_inicio'  => date('Y-m-d H:i', strtotime($inicio)),
            'fecha_fin'     => date('Y-m-d H:i', strtotime($fin)),
            'comentario'    => $profesional->observacion,
            'estado'        => 'reservado',
            'profesional_ins_id'=> $profesional->id_profesional_inst,
        ]);

        return response([
            'message' => [
                'title' => 'Hecho',
                'text'  => "El bloqueo del profesional {$profesional->nombre_completo}esta creado correctamente"
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Permite validar el formulario principal
     *
     * @param Request $request
     * @param string|null $method
     * @param null $id
     * @return void
     */
    private function validator(Request $request, string $method = null,$id = null)
    {
        $request->validate([
            'id_universidad'    => ['required', 'exists:universidades,id_universidad'],
            'id_especialidad'   => ['required', 'exists:especialidades,idEspecialidad'],
            'especialidades.*'  => ['nullable', 'exists:especialidades,idEspecialidad'],
            'primer_nombre'     => ['required', 'max:45'],
            'segundo_nombre'    => ['nullable', 'max:45'],
            'primer_apellido'   => ['required', 'max:45'],
            'segundo_apellido'  => ['nullable', 'max:45'],
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
            //'correo'            => ['required', 'email', 'max:45', 'unique:profesionales_instituciones,correo' . (!empty($id)) ? ",{$id}":""],
            'correo'            => ['required', 'email', 'max:45', Rule::unique("profesionales_instituciones","correo")->ignore($id, 'id_profesional_inst')],
            'sitio_web'         => ['nullable', 'url', 'max:100'],
            'linkedin'          => ['nullable', 'url', 'max:100'],
            'red_social'        => ['nullable', 'url', 'max:100'],
            'rethus'            => ['required', 'max:45'],
            'numero_profesional'=> ['required', 'max:45'],
            'foto'              => ['nullable', 'image'],
            'password'          => [
                ($method == 'created') ? 'required':'nullable',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ]
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
