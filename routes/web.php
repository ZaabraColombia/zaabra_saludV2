<?php

use App\Http\Controllers\entidades;
use App\Http\Controllers\Paciente;
use App\Http\Controllers\profesionales;
use Illuminate\Support\Facades\Route;


/*----------------------------------------------Pertenece al index o home----------------------------------------------------------------------*/


Auth::routes(['verify' => true]);


/*----------------------------------------------Buscadores----------------------------------------------------------------------------*/
/* Buscador del home */
Route::get('/search/filtro', [App\Http\Controllers\buscador\buscadorController::class, 'filtroBusquedad'])->name('search.filtro');
Route::get('/search', [App\Http\Controllers\buscador\buscadorController::class, 'search'])->name('search');

/*Paquete búsqueda dinámica ciudades */
Route::get('get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento'])->name('gte-departamentos')->middleware('auth');
Route::get('get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia'])->name('get-provincias')->middleware('auth');
Route::get('get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad'])->name('get-ciudad')->middleware('auth');

/*Paquete búsqueda dinámica areas */
Route::get('get-profesion',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getprofesion']);
Route::get('get-especialidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getespecialidad']);

/* Autocompletado universidades */
Route::post('/buscar-universidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_universidad'])->name('buscador-universidad')->middleware('auth');
/* Autocompletado especialidades */
Route::post('/buscar-especialidades',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_especialidades'])->name('buscador-especialidades')->middleware('auth');

/*----------------------------------------------Pertenece a Publico-------------------------------------------------------------------------------*/

/*Esta ruta es del home y dirige al controlador encargado de traer la información a la vista*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

/*Esta ruta es de galería profesiones y dirige al controlador encargado de traer la información a la vista*/
Route:: get('/ramas-de-la-salud',[App\Http\Controllers\profesionales\profesionesController::class,'index'])->name('ramas-de-la-salud');

/*Esta ruta es de galería especialidades y dirige al controlador encargado de traer la información a la vista*/
Route:: get('/ramas-de-la-salud/{nombreProfesion}',[App\Http\Controllers\profesionales\especialidadesController::class,'index'])->name('Especialidades');

/*Esta ruta es de galería profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Especialidades/{nombreEspecialidad}',[App\Http\Controllers\profesionales\medicosEspecialidadController::class,'index'])->name('Especialistas-En');

/*Esta ruta es de landing profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilProfesional/{slug}',[App\Http\Controllers\profesionales\perfilprofesionalController::class,'index'])->name('PerfilProfesional');

/*Esta ruta es de galería tipo entidades*/
Route:: get('/Instituciones-Medicas',[App\Http\Controllers\entidades\entidadesController::class,'index'])->name('Instituciones-Medicas');

/*Esta ruta es de galería instituciones segun la entidad seleccionada*/
Route:: get('/Instituciones/{slug}',[App\Http\Controllers\entidades\institucionesController::class,'index'])->name('Instituciones');

/*Esta ruta es de landing institucion y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilInstitucion/{slug}',[App\Http\Controllers\entidades\perfilInstitucionController::class,'index'])->name('PerfilInstitucion');

/*Esta ruta es de la tarjeta de los profesionales de una institución que se llama desde el botón "ver profesional" de la landing page institucional y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilInstitucion/{slug}/profesionales',[App\Http\Controllers\entidades\perfilInstitucionController::class,'profesionales'])->name('PerfilInstitucion-profesionales');

/*Esta ruta direcciona a la vista de Acerca de Zaabra*/
Route::get('/acerca-de-Zaabra-salud', function () { return view('quienes-somos/acerca');})->name('acerca');

/*Esta ruta direcciona a la vista de Preguntas Frecuentes*/
Route::get('/preguntas-frecuentes', function () { return view('quienes-somos/preguntas');})->name('preguntas');

/* Esta ruta direcciona a la vista de Políticas de uso */
Route::get('/politicas-de-uso-de-Zaabra-salud', function () { return view('quienes-somos/politicas');})->name('politicas');

/* Esta ruta direcciona a la vista Contactenos */
Route:: get('/contacto',[App\Http\Controllers\contactecnosController::class,'index'])->name('contacto');
Route:: post('/contacto',[App\Http\Controllers\contactecnosController::class,'save'])->name('contacto-post');

/* Pertenece a newsletter */
Route:: post('/newsletter',[App\Http\Controllers\newsletter\newsletterController::class,'save'])->name('newsletter');

// Esta ruta pertenece a la vista de membresía In stituciones
Route::get('/membresia-institucion', function () { return view('instituciones/membresiaInstitucion');})->name('entidad.membresiaInstitucion');

// Esta ruta pertenece a la vista de membresía profesional
Route::get('/membresia-profesional', function () { return view('profesionales/membresiaProfesional');})->name('profesional.membresiaProfesional');

Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google-redirect');
Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('google-callback');
Route::get('auth/facebook', [\App\Http\Controllers\Auth\FacebookController::class, 'redirectToFB'])->name('facebook-redirect');
Route::get('auth/facebook/callback', [\App\Http\Controllers\Auth\FacebookController::class, 'handleCallback'])->name('facebook-callback');

Route::post('/charge', [\App\Http\Controllers\Pagos\OpenPayContrller::class, 'store'])->name('pay-openPay')->middleware('auth');
Route::get('/response-page', [\App\Http\Controllers\Pagos\OpenPayContrller::class, 'response_page'])->name('pay-openPay-response');



/*------------------------------------------------- Pertenece a calificacion y comentarios-------------------------------------------------------------------------------*/

Route:: post('/comentarios',[App\Http\Controllers\comentarios\comentariosController::class,'save'])->name('comentarios');

/*----------------------------------------------Pertenece a profesional-------------------------------------------------------------------------------*/

Route::middleware(['auth', 'roles', 'verified'])->as('profesional.')->group(function (){

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioProfesional',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'index'])->name('FormularioProfesional');

    /*-----formulario parte 1----*/
    Route::post('/FormularioProfesionalSave',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create1'])->name('create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioProfesionalSave2',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create2'])->name('create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioProfesionalSave3',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create3'])->name('create3');
    Route::post('/FormularioProfesionaldelete3',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete3'])->name('delete3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioProfesionalSave4',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create4'])->name('create4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioProfesionalSave5',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create5'])->name('create5');
    Route::post('/FormularioProfesionaldelete5',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete5'])->name('delete5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioProfesionalSave6',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create6'])->name('create6');
    Route::post('/FormularioProfesionaldelete6',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete6'])->name('delete6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioProfesionalSave7',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create7'])->name('create7');
    Route::post('/FormularioProfesionaldelete7',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete7'])->name('delete7');
    /*-----formulario parte 8----*/
    Route::post('/FormularioProfesionalSave8',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create8'])->name('create8');
    Route::post('/FormularioProfesionaldelete8',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete8'])->name('delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioProfesionalSave9',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create9'])->name('create9');
    Route::post('/FormularioProfesionaldelete9',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete9'])->name('delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioProfesionalSave10',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create10'])->name('create10');
    Route::post('/FormularioProfesionaldelete10',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete10'])->name('delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioProfesionalSave11',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create11'])->name('create11');
    Route::post('/FormularioProfesionaldelete11',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete11'])->name('delete11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioProfesionalSave12',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create12'])->name('create12');
    Route::post('/FormularioProfesionaldelete12',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete12'])->name('delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioProfesionalSave13',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create13'])->name('create13');
    Route::post('/FormularioProfesionaldelete13',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete13'])->name('delete13');
    /*-----formulario parte 14----*/
    Route::post('/FormularioProfesionalAddDestacable',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'addDestacable'])->name('create14');
    Route::post('/FormularioProfesionalDeleteDestacable',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'deleteDestacable'])->name('delete14');

    //Selects dinamicos area, profesion, especialidad
    Route::get('profesion/{idArea}', [App\Http\Controllers\profesionales\profesionController::class,'mostrarProfesion'])->name('mostrarProfesion');
    Route::get('especialidad/{idProfesion}', [App\Http\Controllers\profesionales\especialidadController::class,'mostrarESpecialidad'])->name('mostrarESpecialidad');
    Route::post('/profesional/formulario-password',[App\Http\Controllers\profesionales\especialidadController::class,'password'])->name('formulario-password');

    /*--------- Admin Profesional -----------*/
    Route::prefix('/profesional')->group(function () {

        Route::get('/panel',[profesionales\Admin\PanelController::class,'index'])->name('panel');

        Route::get('/calendario',[profesionales\Admin\CalendarioController::class,'index'])
            ->name('calendario');

        //Configurar calendario
        Route::get('/configurar-calendario', [profesionales\Admin\CalendarioController::class, 'configuracion'])
            ->name('configurar-calendario');
        Route::post('/configurar-calendario/cita', [profesionales\Admin\CalendarioController::class, 'cita'])
            ->name('configurar-calendario.cita');
        Route::post('/configurar-calendario/agregar_horario', [profesionales\Admin\CalendarioController::class, 'horario_agregar'])
            ->name('configurar-calendario.horario-agregar');
        Route::delete('/configurar-calendario/eliminar_horario', [profesionales\Admin\CalendarioController::class, 'horario_eliminar'])
            ->name('configurar-calendario.horario-eliminar');

        Route::get('/citas',[profesionales\Admin\CitasController::class,'index'])->name('citas');
        Route::get('/pagos',[profesionales\Admin\PagosController::class,'index'])->name('pagos');
        Route::get('/pacientes',[profesionales\Admin\PacientesController::class,'index'])->name('pacientes');

        Route:: get('/cie10',[profesionales\Admin\HistoriaClinicaController::class,'cie10'])
            ->name('cie10');
        Route:: get('/cups',[profesionales\Admin\HistoriaClinicaController::class,'cups'])
            ->name('cups');
        Route:: get('/cums',[profesionales\Admin\HistoriaClinicaController::class,'cums'])
            ->name('cums');

        //Route:: get('/panelAdministrativoProfesional/{idPerfilProfesional}',[App\Http\Controllers\admin\adminProfesionalController::class,'cita'])->name('panelAdministrativoProfesional');

        //Route:: get('/ordenesMedicas',[App\Http\Controllers\admin\adminExamenesController::class,'index'])->name('ordenesMedicas');
        //Route:: get('/prescripciones',[App\Http\Controllers\admin\adminPrescripcionesController::class,'index'])->name('prescripciones');

        //Route:: get('/historiaClinicaProfesional',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'index'])->name('historiaClinicaProfesional');
        //Route:: get('/registroPaciente',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'registrar'])->name('registroPaciente');
        //Route:: get('/pacienteRegistrado',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'registro'])->name('pacienteRegistrado');
        //Route:: get('/editarConsulta',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'consulta'])->name('editarConsulta');
        //Route:: get('/editarPatologia',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'patologia'])->name('editarPatologia');
        //Route:: get('/editarExpediente',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'Expediente'])->name('editarExpediente');

        Route:: get('/prescripcionesProfesional',[App\Http\Controllers\admin\adminPrescripcionesProfesionalController::class,'index'])->name('prescripcionesProfesional');
        Route:: get('/crearFormulaProfesional',[App\Http\Controllers\admin\adminPrescripcionesProfesionalController::class,'formulas'])->name('crearFormulaProfesional');

        Route:: get('/diagnosticosProfesional',[App\Http\Controllers\admin\adminDiagnosticosProfesionalController::class,'index'])->name('diagnosticosProfesinal');
        Route:: get('/procedimientosProfesional',[App\Http\Controllers\admin\adminProcedimientosProfesionalController::class,'index'])->name('procedimientosProfesional');
        Route:: get('/vademecumProfesional',[App\Http\Controllers\admin\adminVademecumProfesionalController::class,'index'])->name('vademecumProfesional');
        //Route:: get('/servicios',[App\Http\Controllers\admin\adminController::class,'oscar2'])->name('servicios');

        Route:: get('/favoritos',[App\Http\Controllers\admin\adminFavoritosProfesionalController::class,'index'])->name('favoritos');
        //Route:: post('/favoritosGeneralSave',[App\Http\Controllers\admin\adminFavoritosController::class,'create'])->name('favoritosGeneralSave');
        //Route:: post('/favoritosGeneralSave2',[App\Http\Controllers\admin\adminFavoritosController::class,'create2'])->name('favoritosGeneralSave2');
        //Route:: post('/favoritosGeneralSave3',[App\Http\Controllers\admin\adminFavoritosController::class,'create3'])->name('favoritoSGeneralSave3');
        //Route:: post('/favoritosGeneralSave4',[App\Http\Controllers\admin\adminFavoritosController::class,'create4'])->name('favoritosGeneralSave4');

        Route::resource('contactos', profesionales\Admin\ContactosController::class);
    });
});

/*------------------------------------------------Pertenece a entidades-------------------------------------------------------------------------------*/
Route::middleware(['auth', 'roles', 'verified'])->as('entidad.')->group(function () {

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioInstitucion',[App\Http\Controllers\entidades\formularioInstitucionController::class,'index'])->name('FormularioInstitucion');

    /*-----formulario parte 1----*/
    Route::post('/FormularioInstitucionSave',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create1'])->name('create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioInstitucionSave2',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create2'])->name('create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioInstitucionSave3',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create3'])->name('create3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioInstitucionSave4',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create4'])->name('create4');
    Route::get('/FormularioInstituciondelete4/{id_servicio}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete4'])->name('delete4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioInstitucionSave5',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create5'])->name('create5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioInstitucionSave6',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create6'])->name('create6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioInstitucionSave7',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create7'])->name('create7');
    Route::get('/FormularioInstituciondelete7/{id_convenio}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete7'])->name('delete7');
    /*-----formulario parte 8----*/
    Route::get('/FormularioInstitucionGet8/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'get8'])->name('get8');
    Route::post('/FormularioInstitucionSave8',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create8'])->name('create8');
    Route::get('/FormularioInstituciondelete8/{id_profesional}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete8'])->name('delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioInstitucionSave9',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create9'])->name('create9');
    Route::get('/FormularioInstituciondelete9/{id_certificacion}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete9'])->name('delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioInstitucionSave10',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create10'])->name('create10');
    Route::get('/FormularioInstituciondelete10/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete10'])->name('delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioInstitucionSave11',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create11'])->name('create11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioInstitucionSave12',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create12'])->name('create12');
    Route::get('/FormularioInstituciondelete12/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete12'])->name('delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioInstitucionSave13',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create13'])->name('create13');
    Route::get('/FormularioInstituciondelete13/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete13'])->name('delete13');

    Route::post('/institucion/form-password',[App\Http\Controllers\entidades\formularioInstitucionController::class,'password'])->name('formulario-password');

    /*--------- Admin Entidad -----------*/
    Route::group(['prefix' => '/institucion'], function (){
        Route:: get('/panel',[entidades\Admin\PanelController::class,'index'])->name('panel');
        Route:: get('/citas',[entidades\Admin\CitasController::class,'index'])->name('citas');
        Route:: get('/pagos',[entidades\Admin\PagosController::class,'index'])->name('pagos');

        Route::get('/configurar-calendario', [entidades\Admin\CalendarioController::class, 'configuracion'])
            ->name('configurar-calendario');
        Route::get('/calendario',[entidades\Admin\CalendarioController::class,'index'])
            ->name('calendarioProfesional');

        Route:: get('/cie10',[entidades\Admin\HistoriaClinicaController::class,'cie10'])
            ->name('cie10');
        Route:: get('/cups',[entidades\Admin\HistoriaClinicaController::class,'cups'])
            ->name('cups');
        Route:: get('/cums',[entidades\Admin\HistoriaClinicaController::class,'cums'])
            ->name('cums');

        Route:: get('/favoritos',[entidades\Admin\FavoritosController::class,'index'])
            ->name('favoritos');
        Route:: post('/favoritosSave',[entidades\Admin\FavoritosController::class,'create'])
            ->name('favoritosSave');
        Route:: post('/favoritosSave2',[entidades\Admin\FavoritosController::class,'create2'])
            ->name('favoritosSave2');
        Route:: post('/favoritosSave3',[entidades\Admin\FavoritosController::class,'create3'])
            ->name('favoritosSave3');
        Route:: post('/favoritosSave4',[entidades\Admin\FavoritosController::class,'create4'])
            ->name('favoritosSave4');
    });
});



/*------------------------------------------------Pertenece el paciente-------------------------------------------------------------------------------*/
/*Esta ruta es del paciente*/
Route::middleware(['auth', 'roles', 'verified'])->as('paciente.')->prefix('/paciente')->group(function () {

    Route:: get('/panelPrincipal',[Paciente\Admin\InicioController::class,'index'])->name('panelPrincipal');
    Route:: get('/citas',[Paciente\Admin\CitasController::class,'index'])->name('citas');
    Route:: get('/calendario',[Paciente\Admin\CalendarioController::class,'index'])->name('calendario');
    Route:: get('/calendario/{id}',[Paciente\Admin\CalendarioController::class,'index'])->name('calendario-id-profesional');

    //Route:: get('/panelAdministrativo/{idPerfilProfesional}',[App\Http\Controllers\admin\adminController::class,'cita'])->name('panelAdministrativo');
    Route:: get('/pagos',[Paciente\Admin\PagosController::class,'index'])->name('pagos');
    Route:: get('/ordenes-medicas',[Paciente\Admin\ExamenesController::class,'index'])->name('ordenesMedicas');
    Route:: get('/prescripciones',[Paciente\Admin\prescripcionesController::class,'index'])->name('prescripciones');

    Route:: get('/historia-clinica',[Paciente\Admin\historiaClinica::class,'index'])->name('HistoriaClinica');
    Route:: get('/servicios',[Paciente\Admin\inicioController::class,'oscar2'])->name('servicios');

    //Revisar
    Route:: get('/favoritos-general',[Paciente\Admin\favoritosController::class,'index'])->name('favoritosGeneral');
    Route:: post('/favoritosGeneralSave',[Paciente\Admin\favoritosController::class,'create'])->name('favoritosGeneralSave');
    Route:: post('/favoritosGeneralSave2',[Paciente\Admin\favoritosController::class,'create2'])->name('favoritosGeneralSave2');
    Route:: post('/favoritosGeneralSave3',[Paciente\Admin\favoritosController::class,'create3'])->name('favoritoSGeneralSave3');
    Route:: post('/favoritosGeneralSave4',[Paciente\Admin\favoritosController::class,'create4'])->name('favoritosGeneralSave4');

    Route:: get('/perfil',[Paciente\FormularioPaciente::class,'index'])->name('perfil');

    Route::post('/paciente/formulario-basico',[Paciente\FormularioPaciente::class,'basico'])->name('formulario-basico');
    Route::post('/paciente/formulario-contacto',[Paciente\FormularioPaciente::class,'contacto'])->name('formulario-contacto');
    Route::post('/paciente/formulario-password',[Paciente\FormularioPaciente::class,'password'])->name('formulario-password');

});

/*------------------------------------------------- Pertenece a ERRORES -------------------------------------------------------------------------------*/

/* Esta ruta direcciona a la vista del error 101 */
Route::get('/error101', function () { return view('errores/error101');})->name('error101');

/* Esta ruta direcciona a la vista del error 403 */
Route::get('/error403', function () { return view('errores/error403');})->name('error403');

/* Esta ruta direcciona a la vista del error 404 */
Route::get('/error404', function () { return view('errores/error404');})->name('error404');

/* Esta ruta direcciona a la vista del error 505 */
Route::get('/error505', function () { return view('errores/error505');})->name('error505');


Route::get('/test', function (){
    //$p = \App\Models\profesiones::all();

    //foreach ($p as $item) $item->save();

});
