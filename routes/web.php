<?php

use Illuminate\Support\Facades\Route;



/*----------------------------------------------Pertenece al index o home-------------------------------------------------------------------------------*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Auth::routes(['verify' => true]);

/*Esta ruta es del home y dirige al controlador encargado de traer la informacion a la vista*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



/*----------------------------------------------Pertenece a salud-------------------------------------------------------------------------------*/

/*Esta ruta es de galeria profesiones y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Profesiones',[App\Http\Controllers\profesionales\profesionesController::class,'index'])->name('Profesiones');

/*Esta ruta es de galeria especialidades y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Especialidades/{idProfesion}',[App\Http\Controllers\profesionales\especialidadesController::class,'index'])->name('Especialidades');

/*Esta ruta es de galeria profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Profesionales/{idEspecialidad}',[App\Http\Controllers\profesionales\medicosEspecialidadController::class,'index'])->name('Profesionales');

/*Esta ruta es de landing profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilProfesional/{idPerfilProfesional}',[App\Http\Controllers\profesionales\perfilprofesionalController::class,'index'])->name('PerfilProfesional');

/*Esta ruta es del formulario del profesional */
Route::get('/FormularioProfesional',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'index'])->name('FormularioProfesional');
/*Paquete busquedad dinamica ciudades */
Route::get('get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento']);
Route::get('get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia']);
Route::get('get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad']);
/*Paquete busquedad dinamica areas */
Route::get('get-profesion',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getprofesion']);
Route::get('get-especialidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getespecialidad']);
/*-----guardar formulario----*/ 
Route::post('/FormularioProfesionalSave',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create1'])->name('FormularioProfesional');


//Selects dinamicos area, profesion, especialidad
Route::get('profesion/{idArea}', [App\Http\Controllers\profesionales\profesionController::class,'mostrarProfesion']);
Route::get('especialidad/{idProfesion}', [App\Http\Controllers\profesionales\especialidadController::class,'mostrarESpecialidad']);

// Esta ruta pertenece a la vista de membresía profesional
Route::get('/membresiaProfesional', function () { return view('profesionales/membresiaProfesional');})->name('membresiaProfesional');




/*------------------------------------------------Pertenece a entidades-------------------------------------------------------------------------------*/

/*Esta ruta es de galeria tipo entidades*/
Route:: get('/Entidades',[App\Http\Controllers\entidades\entidadesController::class,'index'])->name('Entidades');

/*Esta ruta es de galeria instituciones segun la entidad seleccionada*/
Route:: get('/Instituciones/{id}',[App\Http\Controllers\entidades\institucionesController::class,'index'])->name('Instituciones');

/*Esta ruta es de landing institucion y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilInstitucion/{id}',[App\Http\Controllers\entidades\perfilInstitucionController::class,'index'])->name('PerfilInstitucion');

// Esta ruta pertenece a la vista de membresía In stituciones
Route::get('/membresiaInstitucion', function () { return view('instituciones/membresiaInstitucion');})->name('membresiaInstitucion');



/*-------------------------------------------------Pertenece a otras vistas-------------------------------------------------------------------------------*/


/*Esta ruta direcciona a la vista de Acerca de Zaabra*/
Route::get('/acerca', function () { return view('quienes-somos/acerca');})->name('acerca');

/*Esta ruta direcciona a la vista de Preguntas Frecuentes*/
Route::get('/preguntas', function () { return view('quienes-somos/preguntas');})->name('preguntas');

/* Esta ruta direcciona a l avista de Políticas de uso */
Route::get('/politicas', function () { return view('quienes-somos/politicas');})->name('politicas');


/*------------------------------------------------- Pertenece a CONTACTO -------------------------------------------------------------------------------*/
/* Esta ruta direcciona a l avista Contactenos */
Route::get('/contacto', function () { return view('contacto');})->name('contacto');


/*------------------------------------------------- Pertenece a CONTACTO -------------------------------------------------------------------------------*/

/* Esta ruta direcciona a l avista del error 101 */
Route::get('/error101', function () { return view('errores/error101');})->name('error101');

/* Esta ruta direcciona a l avista del error 403 */
Route::get('/error403', function () { return view('errores/error403');})->name('error403');

/* Esta ruta direcciona a l avista del error 404 */
Route::get('/error404', function () { return view('errores/error404');})->name('error404');

/* Esta ruta direcciona a l avista del error 505 */
Route::get('/error505', function () { return view('errores/error505');})->name('error505');
