<?php

use App\Http\Controllers\entidades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*------------------------------------------------Pertenece a entidades-------------------------------------------------------------------------------*/
Route::middleware(['auth', 'roles', 'verified'])->as('entidad.')->group(function () {

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioInstitucion',[entidades\formularioInstitucionController::class,'index'])->name('FormularioInstitucion');

    /*-----formulario parte 1----*/
    Route::post('/FormularioInstitucionSave',[entidades\formularioInstitucionController::class,'create1'])->name('create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioInstitucionSave2',[entidades\formularioInstitucionController::class,'create2'])->name('create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioInstitucionSave3',[entidades\formularioInstitucionController::class,'create3'])->name('create3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioInstitucionSave4',[entidades\formularioInstitucionController::class,'create4'])->name('create4');
    Route::get('/FormularioInstituciondelete4/{id_servicio}',[entidades\formularioInstitucionController::class,'delete4'])->name('delete4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioInstitucionSave5',[entidades\formularioInstitucionController::class,'create5'])->name('create5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioInstitucionSave6',[entidades\formularioInstitucionController::class,'create6'])->name('create6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioInstitucionSave7',[entidades\formularioInstitucionController::class,'create7'])->name('create7');
    Route::get('/FormularioInstituciondelete7/{id_convenio}',[entidades\formularioInstitucionController::class,'delete7'])->name('delete7');
    /*-----formulario parte 8----*/
    Route::get('/FormularioInstitucionGet8/{id}',[entidades\formularioInstitucionController::class,'get8'])->name('get8');
    Route::post('/FormularioInstitucionSave8',[entidades\formularioInstitucionController::class,'create8'])->name('create8');
    Route::get('/FormularioInstituciondelete8/{id_profesional}',[entidades\formularioInstitucionController::class,'delete8'])->name('delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioInstitucionSave9',[entidades\formularioInstitucionController::class,'create9'])->name('create9');
    Route::get('/FormularioInstituciondelete9/{id_certificacion}',[entidades\formularioInstitucionController::class,'delete9'])->name('delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioInstitucionSave10',[entidades\formularioInstitucionController::class,'create10'])->name('create10');
    Route::get('/FormularioInstituciondelete10/{id}',[entidades\formularioInstitucionController::class,'delete10'])->name('delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioInstitucionSave11',[entidades\formularioInstitucionController::class,'create11'])->name('create11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioInstitucionSave12',[entidades\formularioInstitucionController::class,'create12'])->name('create12');
    Route::get('/FormularioInstituciondelete12/{id}',[entidades\formularioInstitucionController::class,'delete12'])->name('delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioInstitucionSave13',[entidades\formularioInstitucionController::class,'create13'])->name('create13');
    Route::get('/FormularioInstituciondelete13/{id}',[entidades\formularioInstitucionController::class,'delete13'])->name('delete13');

    Route::post('/institucion/form-password',[entidades\formularioInstitucionController::class,'password'])->name('formulario-password');

});

/*--------- Admin Entidad (Institución) -----------*/
Route::group(['prefix' => '/institucion', 'as' => 'institucion.', 'middleware' => ['auth', 'roles', 'verified']], function (){
    Route::get('/panel',[entidades\Admin\PanelController::class,'index'])->name('panel');

    Route::get('/citas',[entidades\Admin\CitasController::class,'index'])->name('citas');
    Route::post('/citas/lista-citas',[entidades\Admin\CitasController::class,'lista_citas'])
        ->name('citas.lista-citas');

    Route::get('/pagos',[entidades\Admin\PagosController::class,'index'])->name('pagos');

    Route::get('/configurar-calendario', [entidades\Admin\CalendarioController::class, 'configuracion'])
        ->name('configurar-calendario');
    Route::get('/calendario',[entidades\Admin\CalendarioController::class,'index'])
        ->name('calendarioProfesional');

    Route::get('/cie10',[entidades\Admin\HistoriaClinicaController::class,'cie10'])
        ->name('catalogos.cie10');
    Route::get('/cups',[entidades\Admin\HistoriaClinicaController::class,'cups'])
        ->name('catalogos.cups');
    Route::get('/cums',[entidades\Admin\HistoriaClinicaController::class,'cums'])
        ->name('catalogos.cums');

    Route::get('/favoritos',[entidades\Admin\FavoritosController::class,'index'])
        ->name('favoritos');
    Route::post('/guardar-especialidades',[entidades\Admin\FavoritosController::class,'guardar_especialidades'])
        ->name('favoritos.guardar_especialidades');
    Route::post('/guardar-servicios',[entidades\Admin\FavoritosController::class,'guardar_servicios'])
        ->name('favoritos.guardar_servicios');
    Route::post('/guardar-profesional',[entidades\Admin\FavoritosController::class,'guardar_profesional'])
        ->name('favoritos.guardar_profesional');
    Route::post('/guardar-instituciones',[entidades\Admin\FavoritosController::class,'guardar_instituciones'])
        ->name('favoritos.guardar_instituciones');

    Route::get('/pacientes',[entidades\Admin\PacientesController::class,'index'])->name('pacientes');

    Route::resource('contactos', entidades\Admin\ContactosController::class);

    Route::resource('profesionales', entidades\Admin\ProfesionalesController::class)
        ->parameter('profesionales', 'profesional')
        ->except(['destroy']);
    Route::get('profesionales/{profesional}/configurar-calendario', [entidades\Admin\ProfesionalesController::class,'configurar_calendario'])
        ->name('profesionales.configurar_calendario');
    Route::post('profesionales/{profesional}/configurar-calendario', [entidades\Admin\ProfesionalesController::class,'guardar_calendario'])
        ->name('profesionales.guardar_calendario');
    Route::post('profesionales/{profesional}/guardar-horario', [entidades\Admin\ProfesionalesController::class,'guardar_horario'])
        ->name('profesionales.guardar_horario');
    Route::delete('profesionales/{profesional}/eliminar-horario', [entidades\Admin\ProfesionalesController::class,'eliminar_horario'])
        ->name('profesionales.eliminar_horario');
    Route::post('profesionales/{profesional}/bloquear-calendario', [entidades\Admin\ProfesionalesController::class,'bloquear_calendario'])
        ->name('profesionales.bloquear-calendario');

    Route::group(['prefix' => '/configuracion', 'as' => 'configuracion.'], function (){
        Route::resource('/convenios', entidades\Admin\ConveniosController::class);
        Route::resource('/servicios', entidades\Admin\ServiciosController::class);
        Route::resource('/usuarios', entidades\Admin\UsuariosController::class);
    });

    Route::group(['prefix' => '/calendario', 'as' => 'calendario.', 'controller' => entidades\Admin\CalendarioController::class], function () {
        Route::get('/iniciar-control', 'iniciar_control')->name('iniciar-control');
        Route::post('/buscar', 'buscar')->name('buscar');
        Route::get('/citas', 'citas')->name('citas');
        Route::post('/lista-citas', 'lista_citas')->name('lista-citas');

        Route::get('/crear-cita', 'create')->name('crear-cita');
        Route::post('/citas-libres', 'citas_libre')->name('citas-libre');
        Route::post('/guardar-cita', 'store')->name('guardar-cita');
        Route::get('/ver-cita/{cita}', 'show')->name('ver-cita');
        Route::post('/actualizar-cita/{cita}', 'update')->name('actualizar-cita');
        Route::post('/cancelar-cita/{cita}', 'cancelar')->name('cancelar-cita');
    });

    Route::post('/institucion/servicios', [\App\Http\Controllers\buscador\RecursosController::class, 'calendario_disponible'])
        ->name('calendario-disponible');

});

/* ******************** Buscadores ******************** */
/* Buscar convenios de un servicio */
Route::post('/institucion/convenio/servicios', [\App\Http\Controllers\buscador\RecursosController::class, 'servicios_convenio'])
    ->middleware('auth')
    ->name('institucion.convenios-servicio');
/* Buscar profesional */
Route::post('/institucion/profesionales/buscar', [\App\Http\Controllers\buscador\RecursosController::class, 'profesionales_institucion'])
    ->middleware('auth')
    ->name('institucion.buscador-profesional');

/* *********************** Profesional de una institución *********************** */
Route::group([
    'prefix' => '/institucion/profesional',
    'as' => 'institucion.profesional.',
], function (){

    Route::get('/login', [\App\Http\Controllers\Auth\LoginInstitucionController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginInstitucionController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginInstitucionController::class, 'logout'])->name('logout');

    //Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    //Route::post('/register', 'AdminAuth\RegisterController@register');

    //Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    //Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    //Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    //Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

}
);

Route::group([
    'prefix' => '/institucion/profesional',
    'as' => 'institucion.profesional.',
    'middleware' => ['auth:institucion']
], function (){

    Route::controller(entidades\Profesional\CalendarioController::class)
        ->name('calendario.')
        ->group(function () {
            Route::get('calendario', 'index')->name('index');
            Route::post('ver-cita/{cita}', 'ver_cita')->name('ver-cita');
            Route::post('ver-citas', 'ver_citas')->name('ver-citas');
            Route::post('finalizar-cita/{cita}', 'finalizar_cita')->name('finalizar-cita');
        });

    Route::get('citas', [entidades\Profesional\CitasController::class, 'index'])
        ->name('citas');

    Route::controller(entidades\Profesional\HistoriaClinicaController::class)
        ->name('catalogos.')
        ->group(function () {
            Route::get('/cie10', 'cie10')->name('cie10');
            Route::get('/cups', 'cups')->name('cups');
            Route::get('/cums', 'cums')->name('cums');
        });
}
);
