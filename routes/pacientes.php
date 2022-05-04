<?php

use App\Http\Controllers\Paciente;
use Illuminate\Support\Facades\Route;

/*------------------------------------------------Pertenece el paciente-------------------------------------------------------------------------------*/
/*Esta ruta es del paciente*/
Route::middleware(['auth', 'roles', 'verified'])->as('paciente.')->prefix('/paciente')->group(function () {

    Route::get('/panel',[Paciente\Admin\InicioController::class,'index'])->name('panel');

    Route::get('/citas',[Paciente\Admin\CitasController::class,'index'])->name('citas');

    Route::get('/asignar-cita/profesional/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'asignar_cita_profesional'])
        ->name('asignar-cita-profesional');

    Route::post('/asignar-cita/dias-libre-profesional/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'dias_libre_profesional'])
        ->name('dias-libre-profesional');

    Route::post('/asignar-cita/profesional/confirmar-antiguedad/{profesional}',[Paciente\Admin\CalendarioController::class,'antiguedad_profesional'])
        ->name('confirmar-antiguedad-profesional');

    Route::post('/finalizar-cita-profesional/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'finalizar_cita_profesional'])
        ->name('finalizar-cita-profesional');


    Route::group(['prefix' => 'asignar-cita/institucion'], function (){

        Route::get('/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'asignar_cita_institucion'])
            ->name('asignar-cita-institucion-profesional');

        Route::post('/asignar-cita/dias-libre-profesional/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'dias_libre_institucion_profesional'])
            ->name('dias-libre-institucion-profesional');

//        Route::post('/asignar-cita/profesional/confirmar-antiguedad/{profesional}',[Paciente\Admin\CalendarioController::class,'antiguedad_profesional'])
//            ->name('confirmar-antiguedad-profesional');

        Route::post('/finalizar-cita-profesional/{profesional:slug}',[Paciente\Admin\CalendarioController::class,'finalizar_cita_institucion_profesional'])
            ->name('finalizar-cita-institucion-profesional');

        Route::post('confirmar-antiguedad/{institucion}',[Paciente\Admin\CalendarioController::class,'antiguedad_institucion'])
            ->name('confirmar-antiguedad-institucion');
    });

    //Route:: get('/panelAdministrativo/{idPerfilProfesional}',[App\Http\Controllers\admin\adminController::class,'cita'])->name('panelAdministrativo');
    Route::get('/pagos',[Paciente\Admin\PagosController::class,'index'])->name('pagos');
    Route::get('/ordenes-medicas',[Paciente\Admin\FormulasMedicas::class,'index'])->name('ordenes-medicas');
    Route::get('/prescripciones',[Paciente\Admin\prescripcionesController::class,'index'])->name('prescripciones');
    Route::get('/profesionales',[Paciente\Admin\ProfesionalesController::class,'index'])->name('profesionales');

    //Route::get('/historia-clinica',[Paciente\Admin\historiaClinica::class,'index'])->name('HistoriaClinica');
    //Route::get('/servicios',[Paciente\Admin\inicioController::class,'oscar2'])->name('servicios');

    //Revisar
    Route::get('/favoritos',[Paciente\Admin\FavoritosController::class,'index'])->name('favoritos');
    Route::post('/favoritosGeneralSave',[Paciente\Admin\FavoritosController::class,'create'])->name('favoritosGeneralSave');
    Route::post('/favoritosGeneralSave2',[Paciente\Admin\FavoritosController::class,'create2'])->name('favoritosGeneralSave2');
    Route::post('/favoritosGeneralSave3',[Paciente\Admin\FavoritosController::class,'create3'])->name('favoritoSGeneralSave3');
    Route::post('/favoritosGeneralSave4',[Paciente\Admin\FavoritosController::class,'create4'])->name('favoritosGeneralSave4');

    Route::get('/perfil',[Paciente\FormularioPaciente::class,'index'])->name('perfil');

    Route::post('/paciente/formulario-basico',[Paciente\FormularioPaciente::class,'basico'])->name('formulario-basico');
    Route::post('/paciente/formulario-contacto',[Paciente\FormularioPaciente::class,'contacto'])->name('formulario-contacto');
    Route::post('/paciente/formulario-password',[Paciente\FormularioPaciente::class,'password'])->name('formulario-password');

    Route::resource('contactos', Paciente\Admin\ContactosController::class);

});
