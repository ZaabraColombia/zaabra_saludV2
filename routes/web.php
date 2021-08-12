<?php

use Illuminate\Support\Facades\Route;



/*----------------------------------------------Pertenece al index o home----------------------------------------------------------------------*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Auth::routes(['verify' => true]);

/*Esta ruta es del home y dirige al controlador encargado de traer la informacion a la vista*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');


/*----------------------------------------------Buscador del home----------------------------------------------------------------------------*/
Route::get('/search/filtro', [App\Http\Controllers\buscador\buscadorController::class, 'filtroBusquedad'])->name('search.filtro');

/*----------------------------------------------Pertenece a profesionales-------------------------------------------------------------------------------*/

/*Esta ruta es de galeria profesiones y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/ramas-de-la-salud',[App\Http\Controllers\profesionales\profesionesController::class,'index'])->name('ramas-de-la-salud');

/*Esta ruta es de galeria especialidades y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Especialidades-Medicas/{nombreProfesion}',[App\Http\Controllers\profesionales\especialidadesController::class,'index'])->name('Especialidades');

/*Esta ruta es de galeria profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/Especialistas/{nombreEspecialidad}',[App\Http\Controllers\profesionales\medicosEspecialidadController::class,'index'])->name('Especialistas-En');

/*Esta ruta es de landing profesionales y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilProfesional/{idPerfilProfesional}',[App\Http\Controllers\profesionales\perfilprofesionalController::class,'index'])->name('PerfilProfesional');

/*Esta ruta es del formulario del profesional */
Route::get('/FormularioProfesional',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'index'])->name('FormularioProfesional')->middleware('auth');
/*Paquete busquedad dinamica ciudades */
Route::get('get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento']);
Route::get('get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia']);
Route::get('get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad']);
/*Paquete busquedad dinamica areas */
Route::get('get-profesion',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getprofesion']);
Route::get('get-especialidad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getespecialidad']);

/*-----guardar formulario parte 1----*/ 
Route::post('/FormularioProfesionalSave',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create1'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 2----*/ 
Route::post('/FormularioProfesionalSave2',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create2'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 3----*/ 
Route::post('/FormularioProfesionalSave3',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create3'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 3----*/ 
Route::get('/FormularioProfesionaldelete3/{id}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete3'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 4----*/ 
Route::post('/FormularioProfesionalSave4',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create4'])->name('FormularioProfesional')->middleware('auth');


/*-----guardar formulario parte 5----*/ 
Route::post('/FormularioProfesionalSave5',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create5'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 5----*/ 
Route::get('/FormularioProfesionaldelete5/{id_universidadperfil}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete5'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 6----*/ 
Route::post('/FormularioProfesionalSave6',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create6'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 6----*/ 
Route::get('/FormularioProfesionaldelete6/{idexperiencias}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete6'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 7----*/ 
Route::post('/FormularioProfesionalSave7',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create7'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 7----*/ 
Route::get('/FormularioProfesionaldelete7/{idAsociaciones}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete7'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 8----*/ 
Route::post('/FormularioProfesionalSave8',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create8'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 8----*/ 
Route::get('/FormularioProfesionaldelete8/{id_idioma}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete8'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 9----*/ 
Route::post('/FormularioProfesionalSave9',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create9'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 9----*/ 
Route::get('/FormularioProfesionaldelete9/{id_tratamiento}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete9'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 10----*/ 
Route::post('/FormularioProfesionalSave10',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create10'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 10----*/ 
Route::get('/FormularioProfesionaldelete10/{id_tratamiento}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete10'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 11----*/ 
Route::post('/FormularioProfesionalSave11',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create11'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 11----*/ 
Route::get('/FormularioProfesionaldelete11/{id}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete11'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 12----*/ 
Route::post('/FormularioProfesionalSave12',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create12'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 12----*/ 
Route::get('/FormularioProfesionaldelete12/{id}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete12'])->name('FormularioProfesional')->middleware('auth');

/*-----guardar formulario parte 13----*/ 
Route::post('/FormularioProfesionalSave13',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'create13'])->name('FormularioProfesional')->middleware('auth');
/*-----borrar formulario parte 13----*/ 
Route::get('/FormularioProfesionaldelete13/{id}',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'delete13'])->name('FormularioProfesional')->middleware('auth');


//Selects dinamicos area, profesion, especialidad
Route::get('profesion/{idArea}', [App\Http\Controllers\profesionales\profesionController::class,'mostrarProfesion']);
Route::get('especialidad/{idProfesion}', [App\Http\Controllers\profesionales\especialidadController::class,'mostrarESpecialidad']);

// Esta ruta pertenece a la vista de membresía profesional
Route::get('/membresiaProfesional', function () { return view('profesionales/membresiaProfesional');})->name('membresiaProfesional');




/*------------------------------------------------Pertenece a entidades-------------------------------------------------------------------------------*/

/*Esta ruta es de galeria tipo entidades*/
Route:: get('/Instituciones-Medicas',[App\Http\Controllers\entidades\entidadesController::class,'index'])->name('Instituciones-Medicas');

/*Esta ruta es de galeria instituciones segun la entidad seleccionada*/
Route:: get('/Instituciones/{id}',[App\Http\Controllers\entidades\institucionesController::class,'index'])->name('Instituciones');

/*Esta ruta es de landing institucion y dirige al controlador encargado de traer la informacion a la vista*/
Route:: get('/PerfilInstitucion/{id}',[App\Http\Controllers\entidades\perfilInstitucionController::class,'index'])->name('PerfilInstitucion');

// Esta ruta pertenece a la vista de membresía In stituciones
Route::get('/membresiaInstitucion', function () { return view('instituciones/membresiaInstitucion');})->name('membresiaInstitucion');

/*Esta ruta es del formulario del profesional */
Route::get('/FormularioInstitucion',[App\Http\Controllers\entidades\formularioInstitucionController::class,'index'])->name('FormularioInstitucion')->middleware('auth');
/*Paquete busquedad dinamica ciudades */
Route::get('get-Departamento',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getDepartamento']);
Route::get('get-Provincia',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getProvincia']);
Route::get('get-Ciudad',[App\Http\Controllers\profesionales\formularioProfesionalController::class,'getCiudad']);

/*-----guardar formulario parte 1----*/ 
Route::post('/FormularioInstitucionSave',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create1'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 2----*/ 
Route::post('/FormularioInstitucionSave2',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create2'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 3----*/ 
Route::post('/FormularioInstitucionSave3',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create3'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 4----*/ 
Route::post('/FormularioInstitucionSave4',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create4'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 4----*/ 
Route::get('/FormularioInstituciondelete4/{id_servicio}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete4'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 5----*/ 
Route::post('/FormularioInstitucionSave5',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create5'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 6----*/ 
Route::post('/FormularioInstitucionSave6',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create6'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 7----*/ 
Route::post('/FormularioInstitucionSave7',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create7'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 7 eps----*/ 
Route::get('/FormularioInstituciondelete5/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete5'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 7 ips----*/ 
Route::get('/FormularioInstituciondelete6/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete6'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 7 prepagada----*/ 
Route::get('/FormularioInstituciondelete7/{id_prepagada}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete7'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 8----*/ 
Route::post('/FormularioInstitucionSave8',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create8'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 8 Institucioness----*/ 
Route::get('/FormularioInstituciondelete8/{id_profesional_inst}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete8'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 9----*/ 
Route::post('/FormularioInstitucionSave9',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create9'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 9 Institucioness----*/ 
Route::get('/FormularioInstituciondelete9/{id_certificacion}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete9'])->name('FormularioInstitucion')->middleware('auth');


/*-----guardar formulario parte 10----*/ 
Route::post('/FormularioInstitucionSave10',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create10'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 10 Institucioness----*/ 
Route::get('/FormularioInstituciondelete10/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete10'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 11----*/ 
Route::post('/FormularioInstitucionSave11',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create11'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 12----*/ 
Route::post('/FormularioInstitucionSave12',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create12'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 12----*/ 
Route::get('/FormularioInstituciondelete12/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete12'])->name('FormularioInstitucion')->middleware('auth');

/*-----guardar formulario parte 13----*/ 
Route::post('/FormularioInstitucionSave13',[App\Http\Controllers\entidades\formularioInstitucionController::class,'create13'])->name('FormularioInstitucion')->middleware('auth');
/*-----borrar formulario parte 13----*/ 
Route::get('/FormularioInstituciondelete13/{id}',[App\Http\Controllers\entidades\formularioInstitucionController::class,'delete13'])->name('FormularioInstitucion')->middleware('auth');


/*------------------------------------------------Pertenece al admin-------------------------------------------------------------------------------*/
/*Esta ruta es del admin*/
Route:: get('/panelPrincipal',[App\Http\Controllers\admin\adminController::class,'index'])->name('panelPrincipal');
Route:: get('/panelAdministrativo/{idPerfilProfesional}',[App\Http\Controllers\admin\adminController::class,'cita'])->name('panelAdministrativo');
Route:: get('/citas',[App\Http\Controllers\admin\adminCitasController::class,'index'])->name('citas');
Route:: get('/calendario',[App\Http\Controllers\admin\adminCalendarioController::class,'index'])->name('calendario');
Route:: get('/pagos',[App\Http\Controllers\admin\adminPagosController::class,'index'])->name('pagos');
Route:: get('/HistoriaClinica',[App\Http\Controllers\admin\adminHistoriaClinica::class,'index'])->name('HistoriaClinica');
Route:: get('/servicios',[App\Http\Controllers\admin\adminController::class,'oscar2'])->name('servicios');
Route:: get('/favoritosGeneral',[App\Http\Controllers\admin\adminFavoritosController::class,'index'])->name('favoritosGeneral');
Route:: post('/favoritosGeneralSave',[App\Http\Controllers\admin\adminFavoritosController::class,'create'])->name('favoritosGeneralSave');
Route:: post('/favoritosGeneralSave2',[App\Http\Controllers\admin\adminFavoritosController::class,'create2'])->name('favoritosGeneralSave2');

/*-------------------------------------------------Pertenece a otras vistas-------------------------------------------------------------------------------*/
/*Esta ruta direcciona a la vista de Acerca de Zaabra*/
Route::get('/acerca', function () { return view('quienes-somos/acerca');})->name('acerca');

/*Esta ruta direcciona a la vista de Preguntas Frecuentes*/
Route::get('/preguntas', function () { return view('quienes-somos/preguntas');})->name('preguntas');

/* Esta ruta direcciona a la vista de Políticas de uso */
Route::get('/politicas', function () { return view('quienes-somos/politicas');})->name('politicas');


/*------------------------------------------------- Pertenece a calificacion y comentarios-------------------------------------------------------------------------------*/

Route:: post('/comentarios',[App\Http\Controllers\comentarios\comentariosController::class,'save'])->name('comentarios');

/*------------------------------------------------- Pertenece a CONTACTO -------------------------------------------------------------------------------*/
/* Esta ruta direcciona a la vista Contactenos */
Route:: get('/contacto',[App\Http\Controllers\contactecnosController::class,'index'])->name('contacto');
Route:: post('/contacto',[App\Http\Controllers\contactecnosController::class,'save'])->name('contacto');

/*------------------------------------------------- Pertenece a newsletter -------------------------------------------------------------------------------*/

Route:: post('/newsletter',[App\Http\Controllers\newsletter\newsletterController::class,'save'])->name('newsletter');

/*------------------------------------------------- Pertenece a ERRORES -------------------------------------------------------------------------------*/

/* Esta ruta direcciona a la vista del error 101 */
Route::get('/error101', function () { return view('errores/error101');})->name('error101');

/* Esta ruta direcciona a la vista del error 403 */
Route::get('/error403', function () { return view('errores/error403');})->name('error403');

/* Esta ruta direcciona a la vista del error 404 */
Route::get('/error404', function () { return view('errores/error404');})->name('error404');

/* Esta ruta direcciona a la vista del error 505 */
Route::get('/error505', function () { return view('errores/error505');})->name('error505');
