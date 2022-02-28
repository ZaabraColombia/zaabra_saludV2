<?php

use Illuminate\Support\Facades\Route;



/*----------------------------------------------Pertenece al index o home----------------------------------------------------------------------*/


Auth::routes(['verify' => true]);


/*----------------------------------------------Buscadores----------------------------------------------------------------------------*/
/* Buscador del home */
Route::get('/search/filtro', [App\Http\Controllers\buscador\buscadorController::class, 'filtroBusquedad'])->name('search.filtro');
Route::get('/search', [App\Http\Controllers\buscador\buscadorController::class, 'search'])->name('search');

/*Paquete busquedad dinamica ciudades */
Route::get('get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento'])->name('gte-departamentos')->middleware('auth');
Route::get('get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia'])->name('get-provincias')->middleware('auth');
Route::get('get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad'])->name('get-ciudad')->middleware('auth');

/*Paquete busquedad dinamica areas */
Route::get('get-profesion',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getprofesion']);
Route::get('get-especialidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getespecialidad']);

/* Autocompletado universidades */
Route::post('/buscar-universidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_universidad'])->name('buscador-universidad')->middleware('auth');
/* Autocompletado especialidades */
Route::post('/buscar-especialidades',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_especialidades'])->name('buscador-especialidades')->middleware('auth');

/*----------------------------------------------Pertenece a Publico-------------------------------------------------------------------------------*/

/*Esta ruta es del home y dirige al controlador encargado de traer la informacion a la vista*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

/*Esta ruta es de galeria profesiones y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/ramas-de-la-salud',[App\Http\Controllers\profesionales\profesionesController::class,'index'])->name('ramas-de-la-salud');

/*Esta ruta es de galeria especialidades y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/ramas-de-la-salud/{nombreProfesion}',[App\Http\Controllers\profesionales\especialidadesController::class,'index'])->name('Especialidades');

/*Esta ruta es de galeria profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Especialidades/{nombreEspecialidad}',[App\Http\Controllers\profesionales\medicosEspecialidadController::class,'index'])->name('Especialistas-En');

/*Esta ruta es de landing profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilProfesional/{slug}',[App\Http\Controllers\profesionales\perfilprofesionalController::class,'index'])->name('PerfilProfesional');

/*Esta ruta es de galeria tipo entidades*/
Route:: get('/Instituciones-Medicas',[App\Http\Controllers\entidades\entidadesController::class,'index'])->name('Instituciones-Medicas');

/*Esta ruta es de galeria instituciones segun la entidad seleccionada*/
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

Route::middleware(['auth', 'roles', 'verified'])->group(function (){

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioProfesional',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'index'])->name('profesional.FormularioProfesional');

    /*-----formulario parte 1----*/
    Route::post('/FormularioProfesionalSave',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create1'])->name('profesional.create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioProfesionalSave2',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create2'])->name('profesional.create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioProfesionalSave3',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create3'])->name('profesional.create3');
    Route::post('/FormularioProfesionaldelete3',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete3'])->name('profesional.delete3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioProfesionalSave4',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create4'])->name('profesional.create4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioProfesionalSave5',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create5'])->name('profesional.create5');
    Route::post('/FormularioProfesionaldelete5',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete5'])->name('profesional.delete5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioProfesionalSave6',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create6'])->name('profesional.create6');
    Route::post('/FormularioProfesionaldelete6',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete6'])->name('profesional.delete6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioProfesionalSave7',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create7'])->name('profesional.create7');
    Route::post('/FormularioProfesionaldelete7',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete7'])->name('profesional.delete7');
    /*-----formulario parte 8----*/
    Route::post('/FormularioProfesionalSave8',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create8'])->name('profesional.create8');
    Route::post('/FormularioProfesionaldelete8',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete8'])->name('profesional.delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioProfesionalSave9',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create9'])->name('profesional.create9');
    Route::post('/FormularioProfesionaldelete9',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete9'])->name('profesional.delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioProfesionalSave10',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create10'])->name('profesional.create10');
    Route::post('/FormularioProfesionaldelete10',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete10'])->name('profesional.delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioProfesionalSave11',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create11'])->name('profesional.create11');
    Route::post('/FormularioProfesionaldelete11',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete11'])->name('profesional.delete11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioProfesionalSave12',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create12'])->name('profesional.create12');
    Route::post('/FormularioProfesionaldelete12',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete12'])->name('profesional.delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioProfesionalSave13',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create13'])->name('profesional.create13');
    Route::post('/FormularioProfesionaldelete13',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete13'])->name('profesional.delete13');
    /*-----formulario parte 14----*/
    Route::post('/FormularioProfesionalAddDestacable',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'addDestacable'])->name('profesional.create14');
    Route::post('/FormularioProfesionalDeleteDestacable',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'deleteDestacable'])->name('profesional.delete14');

    //Selects dinamicos area, profesion, especialidad
    Route::get('profesion/{idArea}', [App\Http\Controllers\profesionales\profesionController::class,'mostrarProfesion'])->name('profesional.mostrarProfesion');
    Route::get('especialidad/{idProfesion}', [App\Http\Controllers\profesionales\especialidadController::class,'mostrarESpecialidad'])->name('profesional.mostrarESpecialidad');
    Route::post('/profesional/formulario-password',[App\Http\Controllers\profesionales\especialidadController::class,'password'])->name('profesional.formulario-password');

    /*--------- Admin Profesional -----------*/
    Route:: get('/panelPrincipalProfesional',[App\Http\Controllers\admin\adminProfesionalController::class,'index'])->name('profesional.panelPrincipalProfesional');
    Route:: get('/panelAdministrativoProfesional/{idPerfilProfesional}',[App\Http\Controllers\admin\adminProfesionalController::class,'cita'])->name('profesional.panelAdministrativoProfesional');
    Route:: get('/calendarioProfesional',[App\Http\Controllers\admin\adminCalendarioProfesionalController::class,'index'])->name('profesional.calendarioProfesional');
    Route:: get('/configCalendar',[App\Http\Controllers\admin\adminConfigCalendarController::class,'index'])->name('profesional.configCalendar');
    Route:: get('/citasProfesional',[App\Http\Controllers\admin\adminCitasProfesionalController::class,'index'])->name('profesional.citasProfesional');
    Route:: get('/pagosProfesional',[App\Http\Controllers\admin\adminPagosProfesionalController::class,'index'])->name('profesional.pagosProfesional');
    //Route:: get('/ordenesMedicas',[App\Http\Controllers\admin\adminExamenesController::class,'index'])->name('ordenesMedicas');
    //Route:: get('/prescripciones',[App\Http\Controllers\admin\adminPrescripcionesController::class,'index'])->name('prescripciones');

    Route:: get('/historiaClinicaProfesional',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'index'])->name('profesional.historiaClinicaProfesional');
    Route:: get('/registroPaciente',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'registrar'])->name('profesional.registroPaciente');
    Route:: get('/pacienteRegistrado',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'registro'])->name('profesional.pacienteRegistrado');
    Route:: get('/editarConsulta',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'consulta'])->name('profesional.editarConsulta');
    Route:: get('/editarPatologia',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'patologia'])->name('profesional.editarPatologia');
    Route:: get('/editarExpediente',[App\Http\Controllers\admin\adminHistoriaClinicaProfesional::class,'Expediente'])->name('profesional.editarExpediente');

    Route:: get('/prescripcionesProfesional',[App\Http\Controllers\admin\adminPrescripcionesProfesionalController::class,'index'])->name('profesional.prescripcionesProfesional');
    Route:: get('/crearFormulaProfesional',[App\Http\Controllers\admin\adminPrescripcionesProfesionalController::class,'formulas'])->name('profesional.crearFormulaProfesional');

    Route:: get('/diagnosticosProfesional',[App\Http\Controllers\admin\adminDiagnosticosProfesionalController::class,'index'])->name('profesional.diagnosticosProfesinal');
    Route:: get('/procedimientosProfesional',[App\Http\Controllers\admin\adminProcedimientosProfesionalController::class,'index'])->name('profesional.procedimientosProfesional');
    Route:: get('/vademecumProfesional',[App\Http\Controllers\admin\adminVademecumProfesionalController::class,'index'])->name('profesional.vademecumProfesional');
    //Route:: get('/servicios',[App\Http\Controllers\admin\adminController::class,'oscar2'])->name('servicios');

    Route:: get('/favoritosProfesional',[App\Http\Controllers\admin\adminFavoritosProfesionalController::class,'index'])->name('profesional.favoritosProfesional');
    //Route:: post('/favoritosGeneralSave',[App\Http\Controllers\admin\adminFavoritosController::class,'create'])->name('favoritosGeneralSave');
    //Route:: post('/favoritosGeneralSave2',[App\Http\Controllers\admin\adminFavoritosController::class,'create2'])->name('favoritosGeneralSave2');
    //Route:: post('/favoritosGeneralSave3',[App\Http\Controllers\admin\adminFavoritosController::class,'create3'])->name('favoritoSGeneralSave3');
    //Route:: post('/favoritosGeneralSave4',[App\Http\Controllers\admin\adminFavoritosController::class,'create4'])->name('favoritosGeneralSave4');
});

/*------------------------------------------------Pertenece a entidades-------------------------------------------------------------------------------*/
Route::middleware(['auth', 'roles', 'verified'])->group(function () {

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioInstitucion',[App\Http\Controllers\entidades\formularioInstitucionController::class,'index'])->name('entidad.FormularioInstitucion');

    /*-----formulario parte 1----*/
    Route::post('/FormularioInstitucionSave',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create1'])->name('entidad.create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioInstitucionSave2',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create2'])->name('entidad.create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioInstitucionSave3',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create3'])->name('entidad.create3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioInstitucionSave4',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create4'])->name('entidad.create4');
    Route::get('/FormularioInstituciondelete4/{id_servicio}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete4'])->name('entidad.delete4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioInstitucionSave5',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create5'])->name('entidad.create5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioInstitucionSave6',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create6'])->name('entidad.create6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioInstitucionSave7',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create7'])->name('entidad.create7');
    Route::get('/FormularioInstituciondelete7/{id_convenio}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete7'])->name('entidad.delete7');
    /*-----formulario parte 8----*/
    Route::get('/FormularioInstitucionGet8/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'get8'])->name('entidad.get8');
    Route::post('/FormularioInstitucionSave8',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create8'])->name('entidad.create8');
    Route::get('/FormularioInstituciondelete8/{id_profesional}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete8'])->name('entidad.delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioInstitucionSave9',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create9'])->name('entidad.create9');
    Route::get('/FormularioInstituciondelete9/{id_certificacion}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete9'])->name('entidad.delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioInstitucionSave10',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create10'])->name('entidad.create10');
    Route::get('/FormularioInstituciondelete10/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete10'])->name('entidad.delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioInstitucionSave11',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create11'])->name('entidad.create11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioInstitucionSave12',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create12'])->name('entidad.create12');
    Route::get('/FormularioInstituciondelete12/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete12'])->name('entidad.delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioInstitucionSave13',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create13'])->name('entidad.create13');
    Route::get('/FormularioInstituciondelete13/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete13'])->name('entidad.delete13');

    Route::post('/institucion/form-password',[App\Http\Controllers\entidades\formularioInstitucionController::class,'password'])->name('entidad.formulario-password');

});



/*------------------------------------------------Pertenece el paciente-------------------------------------------------------------------------------*/
/*Esta ruta es del paciente*/
Route::middleware(['auth', 'roles', 'verified'])->group(function () {
    Route:: get('/panelPrincipal',[App\Http\Controllers\admin\adminController::class,'index'])->name('paciente.panelPrincipal');
    Route:: get('/panelAdministrativo/{idPerfilProfesional}',[App\Http\Controllers\admin\adminController::class,'cita'])->name('paciente.panelAdministrativo');
    Route:: get('/citas',[App\Http\Controllers\admin\adminCitasController::class,'index'])->name('paciente.citas');
    Route:: get('/calendario',[App\Http\Controllers\admin\adminCalendarioController::class,'index'])->name('paciente.calendario');
    Route:: get('/calendario/{id}',[App\Http\Controllers\admin\adminCalendarioController::class,'index'])->name('paciente.calendario-id-profesional');
    Route:: get('/pagos',[App\Http\Controllers\admin\adminPagosController::class,'index'])->name('paciente.pagos');
    Route:: get('/ordenesMedicas',[App\Http\Controllers\admin\adminExamenesController::class,'index'])->name('paciente.ordenesMedicas');
    Route:: get('/prescripciones',[App\Http\Controllers\admin\adminPrescripcionesController::class,'index'])->name('paciente.prescripciones');

    Route:: get('/HistoriaClinica',[App\Http\Controllers\admin\adminHistoriaClinica::class,'index'])->name('paciente.HistoriaClinica');
    Route:: get('/servicios',[App\Http\Controllers\admin\adminController::class,'oscar2'])->name('paciente.servicios');
    Route:: get('/favoritosGeneral',[App\Http\Controllers\admin\adminFavoritosController::class,'index'])->name('paciente.favoritosGeneral');
    Route:: post('/favoritosGeneralSave',[App\Http\Controllers\admin\adminFavoritosController::class,'create'])->name('paciente.favoritosGeneralSave');
    Route:: post('/favoritosGeneralSave2',[App\Http\Controllers\admin\adminFavoritosController::class,'create2'])->name('paciente.favoritosGeneralSave2');
    Route:: post('/favoritosGeneralSave3',[App\Http\Controllers\admin\adminFavoritosController::class,'create3'])->name('paciente.favoritoSGeneralSave3');
    Route:: post('/favoritosGeneralSave4',[App\Http\Controllers\admin\adminFavoritosController::class,'create4'])->name('paciente.favoritosGeneralSave4');

    Route:: get('/perfil',[App\Http\Controllers\Paciente\FormularioPaciente::class,'index'])->name('paciente.perfil');
//    Route:: get('/perfil',function (){
//        dd('ok');
//    })->name('paciente.perfil');
    Route::post('/paciente/formulario-basico',[App\Http\Controllers\Paciente\FormularioPaciente::class,'basico'])->name('paciente.formulario-basico');
    Route::post('/paciente/formulario-contacto',[App\Http\Controllers\Paciente\FormularioPaciente::class,'contacto'])->name('paciente.formulario-contacto');
    Route::post('/paciente/formulario-password',[App\Http\Controllers\Paciente\FormularioPaciente::class,'password'])->name('paciente.formulario-password');

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
