<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\Paciente;
use App\Models\pais;
use App\Models\provincia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FormularioPaciente extends Controller
{

    public function index()
    {

        $user = auth()->user();

        $paciente = Paciente::with('municipio', 'municipio.provincia', 'municipio.provincia.departamento')
            ->where('id_usuario', '=', $user->id)->first();

        /*crea la información*/
        if (is_null($paciente))
        {
            $paciente = new Paciente(array('id_usuario' => $user->id));
            $paciente->save();
        }
        /*crea una nueva carpeta con el id del perfil nuevo*/
        $path = public_path().'img/pacientes/' . $user->id;
        if (!File::exists($path)) {
            File::makeDirectory($path,  0777, true);
        }


        //Lista de paises
        $listaPaises = pais::all();
        //llamar lista de departamento, provincias y municipios
        if (!is_null($paciente->id_municipio))
        {
            $paciente->id_provincia     = $paciente->municipio->id_provincia;
            $paciente->id_departamento  = $paciente->municipio->provincia->id_departamento;
            $paciente->id_pais          = $paciente->municipio->provincia->departamento->id_pais;

            $listaMunicipios    = municipio::where("id_provincia", $paciente->municipio->id_provincia)->get();
            $listaProvincias    = provincia::where("id_departamento", $paciente->municipio->provincia->id_departamento)->get();
            $listaDepartamentos = departamento::where("id_pais", $paciente->municipio->provincia->departamento->id_pais)->get();
        }else{

            $paciente->id_provincia     = null;
            $paciente->id_departamento  = null;
            $paciente->id_pais          = null;

            $listaDepartamentos = array();
            $listaProvincias = array();
            $listaMunicipios = array();
        }

        //Vista
        return view('paciente.formulario_paciente', compact(
            'user',
            'paciente',
            'listaPaises',
            'listaDepartamentos',
            'listaProvincias',
            'listaMunicipios'
        ));
    }


    //Guardar la información basica del paciente
    public function basico(Request $request)
    {
        //validar el formulario
        $validator = Validator::make($request->all(),[
            'foto_paciente'     => ['image'],
            'primer_nombre'     => ['required'],
            'primer_apellido'   => ['required'],
            'tipo_documento'    => ['required', 'in:1,2,3'],
            'numero_documento'  => ['required'],
            'pais'              => ['required', 'exists:pais,id_pais'],
            'departamento'      => ['required', 'exists:departamentos,id_departamento'],
            'provincia'         => ['required', 'exists:provincias,id_provincia'],
            'municipio'         => ['required', 'exists:municipios,id_municipio'],
            'celular'           => ['required', 'size:10'],
            'telefono'          => ['required', 'size:7'],
            'eps'               => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'mensaje' => 'Ingrese correctamente la información'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        //Modificar la información del usuario
        /*id usuario conectado*/
        $id_user    = auth()->user()->id;
        //Modificar nombres del usuario\
        $user       = User::find($id_user);

        $user->primernombre     = $request->primer_nombre;
        $user->segundonombre    = $request->segundo_nombre;
        $user->primerapellido   = $request->primer_apellido;
        $user->segundoapellido  = $request->segundo_apellido;
        $user->tipodocumento    = $request->tipo_documento;
        $user->numerodocumento  = $request->numero_documento;

        $user->save();

        //Información del perfil profesional
        $perfil = Paciente::where('id_usuario', '=', $user->id)->first();

        $perfil->telefono   = $request->telefono;
        $perfil->celular    = $request->celular;
        $perfil->direccion  = $request->direccion;
        $perfil->eps        = $request->eps;
        //$perfil->foto       = $request->foto;
        $perfil->id_municipio= $request->municipio;

        //Validar si llega la imagen
        if(!empty($request->file('foto_paciente')))
        {
            //borra foto anterior
            if (@getimagesize(public_path() . "/" . $perfil->foto)) unlink(public_path() . "/" . $perfil->foto);


            $foto_perfil = $request->file('foto_paciente');

            /*captura el nombre del logo*/
            $nombre_foto = $id_user . '-' .  time() . '.' . $foto_perfil->guessExtension();

            /*guarda la imagen en carpeta con el id del usuario*/
            $foto_perfil->move("img/pacientes/$id_user", $nombre_foto);

            //capturar la fotp
            $perfil->foto = "img/pacientes/$id_user/" . $nombre_foto;
        }

        $perfil->save();

        return response()->json([
            'mensaje' => 'Se modifico el perfil correctamente.'
        ], Response::HTTP_OK);
    }
}
