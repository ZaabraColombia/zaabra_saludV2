<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*----------------------------------------------Pertenece al index o home----------------------------------------------------------------------*/


Auth::routes(['verify' => true]);

/*----------------------------------------------Buscadores----------------------------------------------------------------------------*/
/* Buscador del home */
Route::get('/search/filtro', [App\Http\Controllers\buscador\buscadorController::class, 'filtroBusquedad'])->name('search.filtro');
Route::get('/search', [App\Http\Controllers\buscador\buscadorController::class, 'search'])->name('search');

/*Paquete búsqueda dinámica ciudades */
Route::get('/get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento'])
    ->name('gte-departamentos')->middleware('auth');
Route::get('/get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia'])
    ->name('get-provincias')->middleware('auth');
Route::get('/get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad'])
    ->name('get-ciudad')->middleware('auth');
Route::get('/paciente/get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento'])
    ->name('paciente-gte-departamentos')->middleware('auth');
Route::get('/paciente/get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia'])
    ->name('paciente-get-provincias')->middleware('auth');
Route::get('/paciente/get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad'])
    ->name('paciente-get-ciudad')->middleware('auth');

/*Paquete búsqueda dinámica areas */
Route::get('get-profesion',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getprofesion']);
Route::get('get-especialidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getespecialidad']);

/* Autocompletado universidades */
Route::post('/buscar-universidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_universidad'])->name('buscador-universidad')->middleware('auth');
/* Autocompletado especialidades */
Route::post('/buscar-especialidades',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'buscar_especialidades'])->name('buscador-especialidades')->middleware('auth');
Route::post('/buscar-pacientes',[App\Http\Controllers\buscador\buscadorController::class,'buscar_paciente'])
    ->name('buscador-paciente')
    ->middleware('auth');

/** Ubicación **/
Route::controller(\App\Http\Controllers\Api\UbicacionController::class)
    ->as('ubicacion.')
    ->prefix('/ubicacion/')
    ->middleware('auth')
    ->group(function () {
        Route::post('paises', 'paises')->name('paises');
        Route::post('regiones', 'regiones')->name('regiones');
        Route::post('ciudades', 'ciudades')->name('ciudades');
    });
/** Fin Ubicación **/

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

Route::get('/profesional/detalle-pago-cita/{pago_cita}', [\App\Http\Controllers\Pagos\CitasOpenPayController::class, 'detalle_profesional'])
    ->name('profesional.detalle-pago-cita');
Route::get('/pago-cita/{pago_cita}/{metodo_pago}', [\App\Http\Controllers\Pagos\CitasOpenPayController::class, 'store'])
    ->name('profesional.pago-cita');
Route::get('/respuesta-pago-cita', [\App\Http\Controllers\Pagos\CitasOpenPayController::class, 'response'])
    ->name('profesional.respuesta-pago-cita');

Route::get('/institucion/detalle-pago-cita/{pago_cita}', [\App\Http\Controllers\Pagos\CitasOpenPayController::class, 'detalle_institcion'])
    ->name('institucion.detalle-pago-cita');




/*------------------------------------------------- Pertenece a calificacion y comentarios-------------------------------------------------------------------------------*/
Route:: post('/comentarios',[App\Http\Controllers\comentarios\comentariosController::class,'save'])->name('comentarios');


/*------------------------------------------------- Pertenece a ERRORES -------------------------------------------------------------------------------*/

/* Esta ruta direcciona a la vista del error 101 */
Route::get('/error101', function () { return view('errores/error101');})->name('error101');

/* Esta ruta direcciona a la vista del error 403 */
Route::get('/error403', function () { return view('errores/error403');})->name('error403');

/* Esta ruta direcciona a la vista del error 404 */
Route::get('/error404', function () { return view('errores/error404');})->name('error404');

/* Esta ruta direcciona a la vista del error 505 */
Route::get('/error505', function () { return view('errores/error505');})->name('error505');


// Ruta para la vista asignar cita profesional institución
Route::get('/test-asignar-cita-profesional-institucion', function (){
    //$profesional= \App\Models\perfilesprofesionales::first();
    $profesional = \App\Models\profesionales_instituciones::query()
        ->with(['institucion'])
        ->first();
    $weekDisabled = array(1,2);
    return view('paciente.admin.calendario.asignar-cita-profesional-institucion', compact('profesional', 'weekDisabled'));
});
// ===================___________ AGENDA PROFESIONALES ___________=================== //
// Ruta de la vista convenios
Route::get('/test-profesional-convenio', function(){
    return view('profesionales.admin.configuracion.convenios.index');
});

// Ruta de la vista crear convenio
Route::get('/test-profesionales-crear-convenio', function(){
    return view('profesionales.admin.configuracion.convenios.crear');
});

// Ruta de la vista servicio
Route::get('/test-profesionales-servicio', function(){
    return view('profesionales.admin.configuracion.servicios.index');
});

// Ruta de la vista crear servicio
Route::get('/test-profesionales-crear-servicio', function(){
    return view('profesionales.admin.configuracion.servicios.crear');
});
//Ruta para filtro y selección de agenda
Route::get('/test-instituciones-filtro-agenda', function(){
    return view('instituciones.admin.agenda.filtro');
});
// ===================_________ FIN AGENDA PROFESIONALES _________=================== //

// Ruta para la vista de control citas en la agenda instituciones
Route::get('/test-instituciones-control-cita', function(){
    return view('instituciones.admin.agenda.control-citas');
});

// Ruta para la vista calendario profesionales de instituciones
Route::get('/test-instituciones-profesionales-calendario-index', function(){
    return view('instituciones.profesionales.calendario.calendario');
});

// Ruta para la vista citas profesionales instituciones
Route::get('/test-instituciones-profesionales-citas-index', function(){
    return view('instituciones.profesionales.citas.index');
});

// 06-05-2022 Ruta para la vista Historial de Bloqueos
Route::get('/test-historial-bloqueos', function(){
    return view('instituciones.admin.agenda.historial-bloqueos');
});

Route::get('/test', function (){
//   $p = \App\Models\profesionales_instituciones::all();
//   $p->map(function ($item){
//       $item->update();
//   });
    //\App\Models\Cita::factory()->count(100)->create();
});
// Ruta detalles-pago
Route:: get('/detalles-pago',[App\Http\Controllers\pagosController::class,'index'])->name('detalles-pago');
Route:: get('/comprobantes-pago',[App\Http\Controllers\pagosController::class,'index2'])->name('comprobantes-pago');

//+++++++++ Ruta de prueba +++++++++//
Route::get('/test-home-prueba', function(){
    return view('testHome');
});
