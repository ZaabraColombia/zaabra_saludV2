<?php

namespace App\Http\Controllers\entidades;
use App\Http\Controllers\Controller;
use App\Models\destacados;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\instituciones;
use App\Models\tipoinstituciones;
use App\Models\serviciosinstituciones;
use App\Models\eps;
use App\Models\ips;
use App\Models\prepagadas;
use App\Models\intitucioneseps;
use App\Models\intitucionesips;
use App\Models\institucionprepagada;
use App\Models\profesionales_instituciones;
use App\Models\certificaciones;
use App\Models\sedesinstituciones;
use App\Models\pais;
use App\Models\departamento;
use App\Models\municipio;
use App\Models\provincia;
use App\Models\galerias;
use App\Models\videos;
use File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class formularioInstitucionController extends Controller{

    public function index(){

        $id_user=auth()->user()->id;/*id usuario logueado*/

        //Crear el registro de perfil profesional si no existe
        $ins = instituciones::where('idUser', '=', $id_user)->select('id')->first();
        if (empty($ins))
        {
            $ins = new instituciones(['idUser' => $id_user]);
            $ins->save();
        }

        /*crea una nueva carpeta con el id del perfil nuevo*/
        $path = public_path().'img/instituciones/' . $id_user;
        if (!File::exists($path)) {
            File::makeDirectory($path,  0777, true);
        }

        $tipoinstitucion = tipoinstituciones::all();

        $objFormulario      = $this->cargaFormulario($id_user);
        $objFormulario      = $objFormulario[0];
        $objuser            = $this->cargaDatosUser($id_user);
        $objuser            = $objuser[0];

        $objServicio=$this->cargaServicios($id_user);
        $objContadorServicio=$this->contadorServicios($id_user);
        $objIps=$this->cargaIps($id_user);
        $objContadorIps=$this->contadorIps($id_user);
        $objEps=$this->cargaEps($id_user);
        $objContadorEps=$this->contadorEps($id_user);
        $objPrepa=$this->cargaPrepa($id_user);
        $objContadorPrepa=$this->contadorPrepa($id_user);
        $objProfeInsti=$this->cargaProfeInsti($id_user);
        $objContadorProfeInsti=$this->contadorProfeInsti($id_user);
        $objCertificaciones=$this->cargaCertificaciones($id_user);
        $objContadorCertificaciones=$this->contadorCertificaciones($id_user);
        $objSedes=$this->cargaSedes($id_user);
        $objContadorSedes=$this->contadorSedes($id_user);
        $objGaleria=$this->cargaGaleria($id_user);
        $objContadorGaleria=$this->contadorGaleria($id_user);
        $objVideo=$this->cargaVideo($id_user);
        $objContadorVideo=$this->contadorVideo($id_user);

        //Lista de paises
        $listaPaises = pais::all();

        //llamar la lista de departamentos según el pais
        if (!is_null($objFormulario->id_pais)) {
            $listaDepartamentos = departamento::where("id_pais", $objFormulario->id_pais)->get();
        }else{
            $listaDepartamentos = array();
        }
        //llamar la lista de provincias según el departamento
        if (!is_null($objFormulario->id_departamento)) {
            $listaProvincias = provincia::where("id_departamento", $objFormulario->id_departamento)->get();
        }else{
            $listaProvincias = array();
        }
        //llamar la lista de municipios según la provincia
        if (!is_null($objFormulario->id_provincia)) {
            $listaMunicipios = municipio::where("id_provincia", $objFormulario->id_provincia)->get();
        }else{
            $listaMunicipios = array();
        }


        return view('instituciones.FormularioInstitucion',compact(
            'tipoinstitucion',
            'objuser',
            'listaPaises',
            'listaDepartamentos',
            'listaProvincias',
            'listaMunicipios',
            'objFormulario',
            'objServicio',
            'objContadorServicio',
            'objPrepa',
            'objContadorPrepa',
            'objIps',
            'objContadorIps',
            'objEps',
            'objContadorEps',
            'objProfeInsti',
            'objContadorProfeInsti',
            'objCertificaciones',
            'objContadorCertificaciones',
            'objSedes',
            'objContadorSedes',
            'objGaleria',
            'objContadorGaleria',
            'objVideo',
            'objContadorVideo'
        ));
    }

    /*------------------------------------- inicio json busqueda departamento, provincia, ciudad----------------------*/
    public function getDepartamento(Request $request){

        $departamento = departamento::where("id_pais",$request->id_pais)->get();
        return response()->json($departamento);
    }
    public function getProvincia(Request $request){
        $provincia = provincia::where("id_departamento",$request->id_departamento)->get();
        return response()->json($provincia);
    }
    public function getCiudad(Request $request){
        $municipio = municipio::where("id_provincia",$request->id_provincia)->get();
        return response()->json($municipio);
    }
    /*------------------------------------- fin json busqueda departamento, provincia, ciudad----------------------*/


    /*------------ Funcion solo para verificar que institucion existe y esta se utiiliza en las demas-----------------*/
    protected function verificaPerfil(){
        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        /*consulta si existe el profesional*/
        $idexisteinstitu = DB::table('instituciones')
            ->select('instituciones.id')
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->where('instituciones.idUser', $id_user)
            ->first();
        return $idexisteinstitu;

    }
    /*------------Fin  Funcion solo para verificar que institucion existe y esta se utiiliza en los demas metodos-----------------*/

    /*------------inicio busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/

    public function cargaDatosUser($id_user){
        return DB::select("SELECT us.nombreinstitucion, us.numerodocumento
    FROM users us
    WHERE id=$id_user");
    }

    public function cargaFormulario($id_user){
        return DB::select("SELECT ins.imagen, ins.logo, ins.quienessomos,  ins.DescripcionGeneralServicios, ins.idtipoInstitucion,
    ins.url, ins.fechainicio, ins.telefonouno,  ins.telefono2, ins.direccion, ins.propuestavalor,
    p.id_pais,p.nombre, de.id_departamento, de.nombre,ins.url_maps,
    prv.id_provincia,prv.nombre, mu.id_municipio, mu.nombre
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  pais p ON ins.idpais=p.id_pais
    LEFT JOIN  departamentos de ON ins.id_departamento= de.id_departamento
    LEFT JOIN  provincias prv ON ins.id_provincia= prv.id_provincia
    LEFT JOIN  municipios mu ON ins.id_municipio= mu.id_municipio
    LEFT JOIN  tipoinstituciones ti ON ins.idtipoInstitucion= ti.id
    WHERE ins.idUser=$id_user");
    }


    public function  cargaServicios($id_user){
        return DB::select("SELECT st.id_servicio, st.tituloServicios, st.DescripcioServicios, st.sucursalservicio
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  serviciosinstituciones st ON ins.id= st.id
    WHERE ins.idUser=$id_user");
    }

    public function contadorServicios($id_user){
        /*cuenta los los valores ingresados*/
        $contadorservicio = DB::table('instituciones')
            ->select(DB::raw('COUNT(serviciosinstituciones.id) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('serviciosinstituciones', 'instituciones.id', '=', 'serviciosinstituciones.id')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorservicio;
    }

    public function  cargaEps($id_user){
        return DB::select("SELECT e.id, e.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  eps e ON ins.id= e.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorEps($id_user){
        /*cuenta los los valores ingresados*/
        $contadoreps = DB::table('instituciones')
            ->select(DB::raw('COUNT(eps.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('eps', 'instituciones.id', '=', 'eps.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadoreps;
    }


    public function  cargaIps($id_user){
        return DB::select("SELECT i.id ,i.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  ips i ON ins.id= i.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorIps($id_user){
        /*cuenta los los valores ingresados*/
        $contadorips = DB::table('instituciones')
            ->select(DB::raw('COUNT(ips.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('ips', 'instituciones.id', '=', 'ips.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorips;
    }

    public function  cargaPrepa($id_user){
        return DB::select("SELECT p.id_prepagada ,p.urlimagen
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  prepagadas p ON ins.id= p.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorPrepa($id_user){
        /*cuenta los los valores ingresados*/
        $contadorprepa = DB::table('instituciones')
            ->select(DB::raw('COUNT(prepagadas.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('prepagadas', 'instituciones.id', '=', 'prepagadas.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorprepa;
    }
    public function  cargaProfeInsti($id_user){
        return DB::select("SELECT pin.id_profesional_inst, pin.primer_nombre,pin.segundo_nombre,pin.primer_apellido,
    pin.segundo_apellido,pin.especialidad_uno,pin.especialidad_dos, pin.foto_perfil_institucion
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  profesionales_instituciones pin ON ins.id= pin.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorProfeInsti($id_user){
        /*cuenta los los valores ingresados*/
        $contadorProfeInsti = DB::table('instituciones')
            ->select(DB::raw('COUNT(profesionales_instituciones.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('profesionales_instituciones', 'instituciones.id', '=', 'profesionales_instituciones.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorProfeInsti;
    }

    public function  cargaCertificaciones($id_user){
        return DB::select("SELECT cr.id_certificacion, cr.imgcertificado, cr.fechacertificado, cr.titulocertificado, cr.descrpcioncertificado
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  certificaciones cr ON ins.id= cr.id_institucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorCertificaciones($id_user){
        /*cuenta los los valores ingresados*/
        $contadorCerificaciones = DB::table('instituciones')
            ->select(DB::raw('COUNT(certificaciones.id_institucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('certificaciones', 'instituciones.id', '=', 'certificaciones.id_institucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorCerificaciones;
    }

    public function  cargaSedes($id_user){
        return DB::select("SELECT si.id,si.imgsede,si.nombre,si.direccion,si.horario_sede,si.telefono
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  sedesinstituciones si ON ins.id= si.idInstitucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorSedes($id_user){
        /*cuenta los los valores ingresados*/
        $contadorSedes = DB::table('instituciones')
            ->select(DB::raw('COUNT(sedesinstituciones.idInstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('sedesinstituciones', 'instituciones.id', '=', 'sedesinstituciones.idInstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorSedes;
    }

    public function  cargaGaleria($id_user){
        return DB::select("SELECT g.id_galeria, g.imggaleria, g.nombrefoto, g.descripcion
    FROM  instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    LEFT JOIN  galerias g ON ins.id = g.idinstitucion
    WHERE ins.idUser=$id_user");
    }

    public function contadorGaleria($id_user){
        /*cuenta los los valores ingresados*/
        $contadorGaleria = DB::table('instituciones')
            ->select(DB::raw('COUNT(galerias.idinstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('galerias', 'instituciones.id', '=', 'galerias.idInstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorGaleria;
    }

    public function  cargaVideo($id_user){
        return DB::select("SELECT v.id, v.nombrevideo, v.descripcionvideo,
    REPLACE(v.urlvideo, '/watch?v=', '/embed/') AS urlvideo, v.fechavideo
    FROM instituciones ins
    INNER JOIN users us   ON ins.idUser=us.id
    INNER JOIN  videos v ON ins.id= v.idinstitucion
    WHERE ins.idUser=$id_user");
    }


    public function contadorVideo($id_user){
        /*cuenta los los valores ingresados*/
        $contadorvideos = DB::table('instituciones')
            ->select(DB::raw('COUNT(videos.idinstitucion) as cantidad'))
            ->join('users', 'instituciones.idUser', '=', 'users.id')
            ->leftjoin('videos', 'instituciones.id', '=', 'videos.idinstitucion')
            ->where('users.id', '=',$id_user)
            ->first();
        return $contadorvideos;
    }
    /*------------Fin busquedad datos basicos usuario logueado y data resgistrada de la institucion-----------------*/


    /*-------------------------------------Creacion y/o modificacion formulario parte 1----------------------*/
    protected function create1(Request $request){

        $validation = Validator::make($request->all(), [
            'nombre_institucion' => ['required'],
            'fecha_inicio_institucion' => ['required', 'date_format:Y-m-d'],
            'url_institucion' => ['required', 'url'],
            'tipo_institucion' => ['required', 'exists:tipoinstituciones,id'],
            'logo_institucion' => ['image'],
            'imagen_institucion' => ['image'],
        ], [], [
            'nombre_institucion' => 'Nombre',
            'fecha_inicio_institucion' => 'Fecha de inicio',
            'url_institucion' => 'Pagina web',
            'tipo_institucion' => 'Tipo de institución',
            'logo_institucion' => 'Logo de la institución',
            'imagen_institucion' => 'Imagen de la institución',
        ]);

        if ($validation->fails()) {
            $men = $validation->errors()->all();
            $error = array_keys($validation->errors()->messages());

            return response()->json([
                'error' => ['mensajes' => $men, 'ids' => $error],
                'mensaje' => 'Verifique los siguientes errores'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /*id usuario logueado*/
        $id_user = auth()->user()->id;

        //Agregar campos
        $user = User::where('id', '=', $id_user)->first();
        $basico = instituciones::where('idUser', '=', $id_user)->first();

        if (empty($basico))
        {
            return response([
                'mensaje' => 'No existe la institución'
            ], Response::HTTP_NOT_FOUND);
        }
        
        //guardar el nombre
        $user->nombreinstitucion = $request->nombre_institucions;
        $user->save();

        //guardar la inforacion basica
        $basico->fechainicio = $request->fecha_inicio_institucions;
        $basico->url = $request->url_institucions;
        $basico->idtipoInstitucion = $request->tipo_institucion;

        if(!empty($request->file('logo_institucion')))
        {
            $logo = $request->file('logo_institucion');
            //dd($logo);
            /*captura el nombre del logo*/
            $nombre_logo = $logo->getClientOriginalName();

            /*guarda la imagen en carpeta con el id del usuario*/
            $logo->move("img/instituciones/$id_user", $nombre_logo);

            //capturar la fotp
            $basico->logo = "img/instituciones/$id_user/" . $nombre_logo;
        }

        if(!empty($request->file('imagen_institucion')))
        {
            $imagen = $request->file('imagen_institucion');

            /*captura el nombre del logo*/
            $nombre_imagen = $imagen->getClientOriginalName();

            /*guarda la imagen en carpeta con el id del usuario*/
            $imagen->move("img/instituciones/$id_user", $nombre_imagen);

            //capturar la fotp
            $basico->imagen = "img/instituciones/$id_user/" . $nombre_imagen;
        }

        //guardar basico
        $basico->save();

        return response([
            'mensaje' => 'Se guardo correctamente la información'
        ], Response::HTTP_OK);
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 1----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 2----------------------*/
    protected function create2(Request $request){


        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);

        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 2----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 3----------------------*/
    public function create3(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        unset($request['updated_at']);
        unset($request['created_at']);
        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 3----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 4----------------------*/
    public function create4(Request $request){

        foreach ($request->input('tituloServicios', []) as $i => $tituloServicios) {
            if(!empty($request->input('tituloServicios')[$i])){
                $request->validate([
                    'tituloServicios.' . $i => ['required'],
                    'DescripcioServicios.' . $i => ['required'],
                    'sucursalservicio.' . $i => ['required'],
                ]);
            }
        }

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        foreach ($request->input('tituloServicios', []) as $i => $tituloServicios) {

            if(!empty($request->input('tituloServicios')[$i])){
                serviciosinstituciones::create([
                    'id' => $idInstitucion,
                    'tituloServicios' => $request->input('tituloServicios.'.$i),
                    'DescripcioServicios' => $request->input('DescripcioServicios.'.$i),
                    'sucursalservicio' => $request->input('sucursalservicio.'.$i),
                ]);
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 4----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 4----------------------*/
    public function delete4($id_servicio){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        $serviciosinstituciones = serviciosinstituciones::where('id_servicio', $id_servicio)->where('id', $idInstitucion);
        $serviciosinstituciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 4----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 5----------------------*/
    public function create5(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        unset($request['updated_at']);
        unset($request['created_at']);
        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 5----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 6----------------------*/
    public function create6(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        unset($request['updated_at']);
        unset($request['created_at']);
        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 6----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 7----------------------*/
    public function create7(Request $request){

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        $carpetaDestino = "img/instituciones/$id_user";

        if ($request->hasFile('urlimagenEps')) {
            $imagenes = $request->file('urlimagenEps');
            foreach ($imagenes as $imageneps) {
                $nombreFoto = $imageneps->getClientOriginalName();
                $imageneps->move($carpetaDestino , $nombreFoto);
                $nombreFotoCompletaeps="img/instituciones/$id_user/$nombreFoto";
                eps::create([
                    'id_institucion' => $idInstitucion,
                    'urlimagen'  => $nombreFotoCompletaeps
                ]);
            }
        }

        if ($request->hasFile('urlimagenIps')) {
            $imagenes = $request->file('urlimagenIps');
            foreach ($imagenes as $imagenips) {
                $nombreFoto = $imagenips->getClientOriginalName();
                $imagenips->move($carpetaDestino , $nombreFoto);
                $nombreFotoCompletaips="img/instituciones/$id_user/$nombreFoto";
                ips::create([
                    'id_institucion' => $idInstitucion,
                    'urlimagen'  => $nombreFotoCompletaips
                ]);
            }
        }

        if ($request->hasFile('urlimagenPre')) {
            $imagenes = $request->file('urlimagenPre');
            foreach ($imagenes as $imagenpre) {
                $nombreFoto = $imagenpre->getClientOriginalName();
                $imagenpre->move($carpetaDestino , $nombreFoto);
                $nombreFotoCompletaprepa="img/instituciones/$id_user/$nombreFoto";
                prepagadas::create([
                    'id_institucion' => $idInstitucion,
                    'urlimagen'  => $nombreFotoCompletaprepa
                ]);
            }
        }

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 7----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 7 donde se unifica eps ips y prepagada----------------------*/
    public function delete5($id){
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        $eps = eps::where('id', $id)->where('id_institucion', $idInstitucion);
        $eps->delete();

        return redirect('FormularioInstitucion');
    }

    public function delete6($id){
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        $ips = ips::where('id', $id)->where('id_institucion', $idInstitucion);
        $ips->delete();

        return redirect('FormularioInstitucion');
    }

    public function delete7($id_prepagada){
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        $prepagadas = prepagadas::where('id_prepagada', $id_prepagada)->where('id_institucion', $idInstitucion);
        $prepagadas->delete();

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Eliminacion formulario parte 7 donde se unifica eps ips y prepagada----------------------*/



    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 8----------------------*/
    public function create8(Request $request){

        foreach ($request->input('primer_nombre', []) as $i => $tituloServicios) {
            if(!empty($request->input('primer_nombre')[$i])){
                $request->validate([
                    'foto_perfil_institucion.' . $i => ['required', 'image'],
                    'primer_nombre.' . $i => ['required'],
                    'segundo_nombre.' . $i => ['required'],
                    'primer_apellido.' . $i => ['required'],
                    'segundo_apellido.' . $i => ['required'],
                    'especialidad_uno.' . $i => ['required'],
                    'especialidad_dos.' . $i => ['required'],
                ]);
            }
        }


        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);

        $carpetaDestino = "img/instituciones/$id_user";
        $foto_perfil_institucion = $request->file('foto_perfil_institucion');


        for ($i=0; $i < count(request('foto_perfil_institucion')); ++$i){
            if(!empty($request->input('primer_nombre')[$i])){
                profesionales_instituciones::create([
                    'id_institucion' => $idInstitucion,
                    'primer_nombre' =>  $request->input('primer_nombre')[$i],
                    'segundo_nombre' => $request->input('segundo_nombre')[$i],
                    'primer_apellido' => $request->input('primer_apellido')[$i],
                    'segundo_apellido' =>$request->input('segundo_apellido')[$i],
                    'especialidad_uno' => $request->input('especialidad_uno')[$i],
                    'especialidad_dos' => $request->input('especialidad_dos')[$i],
                    'foto_perfil_institucion' =>"img/instituciones/$id_user/".$foto_perfil_institucion[$i]->getClientOriginalName(),
                ]);
                $foto_perfil_institucion[$i]->move($carpetaDestino , $foto_perfil_institucion[$i]->getClientOriginalName());
            }
        }


        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 8----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 8 ----------------------*/
    public function delete8($id_profesional_inst){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $profesionales_instituciones = profesionales_instituciones::where('id_profesional_inst', $id_profesional_inst)->where('id_institucion', $idInstitucion);
        $profesionales_instituciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 8----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 9----------------------*/
    public function create9(Request $request){

        foreach ($request->input('titulocertificado', []) as $i => $tituloServicios) {
            if(!empty($request->input('titulocertificado')[$i])){
                $request->validate([
                    'imgcertificado.' . $i => ['required', 'image'],
                    'titulocertificado.' . $i => ['required'],
                    'fechacertificado.' . $i => ['required'],
                    'descrpcioncertificado.' . $i => ['required']
                ]);
            }
        }


        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }
        unset($request['_token']);

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        $carpetaDestino = "img/instituciones/$id_user";
        $imgcertificado = $request->file('imgcertificado');
        for ($i=0; $i < count(request('titulocertificado')); ++$i){

            if(!empty($request->input('titulocertificado')[$i])){
                certificaciones::create([
                    'id_institucion' => $idInstitucion,
                    'titulocertificado' => $request->input('titulocertificado')[$i],
                    'imgcertificado' =>"img/instituciones/$id_user/".$imgcertificado[$i]->getClientOriginalName(),
                    'fechacertificado' => $request->input('fechacertificado')[$i],
                    'descrpcioncertificado' => $request->input('descrpcioncertificado')[$i],
                ]);
                $imgcertificado[$i]->move($carpetaDestino , $imgcertificado[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 9----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 9 ----------------------*/
    public function delete9($id_certificacion){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $certificaciones = certificaciones::where('id_certificacion', $id_certificacion)->where('id_institucion', $idInstitucion);
        $certificaciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 9----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 10----------------------*/
    public function create10(Request $request){

        foreach ($request->input('nombre', []) as $i => $tituloServicios) {
            if(!empty($request->input('nombre')[$i])){
                $request->validate([
                    'imgsede.' . $i => ['required', 'image'],
                    'nombre.' . $i => ['required'],
                    'direccion.' . $i => ['required'],
                    'horario_sede.' . $i => ['required'],
                    'telefono.' . $i => ['required']
                ]);
            }
        }

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        unset($request['_token']);
        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        $carpetaDestino = "img/instituciones/$id_user";
        $imgsede = $request->file('imgsede');

        for ($i=0; $i < count(request('nombre')); ++$i){

            if(!empty($request->input('nombre')[$i])){
                sedesinstituciones::create([
                    'idInstitucion' => $idInstitucion,
                    'imgsede' =>"img/instituciones/$id_user/".$imgsede[$i]->getClientOriginalName(),
                    'nombre' => $request->input('nombre')[$i],
                    'direccion' => $request->input('direccion')[$i],
                    'horario_sede' => $request->input('horario_sede')[$i],
                    'telefono' => $request->input('telefono')[$i],
                ]);
                $imgsede[$i]->move($carpetaDestino , $imgsede[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 10----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario 10 ----------------------*/
    public function delete10($id){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $sedesinstituciones = sedesinstituciones::where('id', $id)->where('idInstitucion', $idInstitucion);
        $sedesinstituciones->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 10----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 11----------------------*/
    public function create11(Request $request){


        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        unset($request['_token']);
        unset($request['updated_at']);
        unset($request['created_at']);
        instituciones::where('idUser', $id_user)->update($request->all());

        return redirect('FormularioInstitucion');
    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 11----------------------*/

    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 12----------------------*/
    public function create12(Request $request){

        foreach ($request->input('nombrefoto', []) as $i => $tituloServicios) {
            if(!empty($request->input('nombrefoto')[$i])){
                $request->validate([
                    'imggaleria.' . $i => ['required', 'image'],
                    'nombrefoto.' . $i => ['required'],
                    'descripcion.' . $i => ['required'],
                    'fechagaleria.' . $i => ['required'],
                ]);
            }
        }

        /*Llamamiento de la funcion verificaPerfil para hacer util la verificacion  */
        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }

        /*id usuario logueado*/
        $id_user=auth()->user()->id;

        $carpetaDestino = "img/instituciones/$id_user";
        $imggaleria = $request->file('imggaleria');
        for ($i=0; $i < count(request('nombrefoto')); ++$i){
            if(!empty($request->input('nombrefoto.'.$i))){
                galerias::create([
                    'idinstitucion' => $idInstitucion,
                    'nombrefoto' => $request->input('nombrefoto')[$i],
                    'fechagaleria' => $request->input('fechagaleria')[$i],
                    'imggaleria' =>"img/instituciones/$id_user/".$imggaleria[$i]->getClientOriginalName(),
                    'descripcion' => $request->input('descripcion')[$i],
                ]);
                $imggaleria[$i]->move($carpetaDestino , $imggaleria[$i]->getClientOriginalName());
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 12----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 12----------------------*/
    public function delete12($id_galeria){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $galeria = galerias::where('id_galeria', $id_galeria)->where('idinstitucion', $idInstitucion);
        $galeria->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 12----------------------*/


    /*-------------------------------------Inicio Creacion y/o modificacion formulario parte 13----------------------*/
    public function create13(Request $request){

        foreach ($request->input('nombrevideo', []) as $i => $v) {
            if(!empty($request->input('nombrevideo')[$i])){
                $request->validate([
                    'nombrevideo.' . $i => ['required'],
                    'descripcionvideo.' . $i => ['required'],
                    'urlvideo.' . $i => ['required'],
                    'fechavideo.' . $i => ['required'],
                ]);
            }
        }


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }



        for ($i=0; $i < count(request('nombrevideo')); ++$i){
            if(!empty($request->input('nombrevideo.'.$i))){
                videos::create([
                    'idinstitucion' => $idInstitucion,
                    'nombrevideo' => $request->input('nombrevideo')[$i],
                    'descripcionvideo' => $request->input('descripcionvideo')[$i],
                    'urlvideo' => $request->input('urlvideo')[$i],
                    'fechavideo' => $request->input('fechavideo')[$i],
                ]);
            }
        }

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Creacion y/o modificacion formulario parte 13----------------------*/
    /*-------------------------------------Inicio Eliminacion  formulario parte 13----------------------*/
    public function delete13($id){


        $verificaPerfil = $this->verificaPerfil();

        foreach($verificaPerfil as $verificaPerfil){
            $idInstitucion=$verificaPerfil;
        }


        $videos = videos::where('id', $id)->where('idinstitucion', $idInstitucion);
        $videos->delete();

        return redirect('FormularioInstitucion');

    }
    /*-------------------------------------Fin Eliminacion formulario parte 13----------------------*/
}
