<?php

use App\Http\Controllers\profesionales;
use Illuminate\Support\Facades\Route;

/*----------------------------------------------Pertenece a profesional-------------------------------------------------------------------------------*/
Route::middleware(['auth', 'roles', 'verified'])->as('profesional.')->group(function (){

    /*Esta ruta es del formulario del profesional */
    Route::get('/FormularioProfesional',[profesionales\formularioProfesionalController::class,'index'])->name('perfil');

    /*-----formulario parte 1----*/
    Route::post('/FormularioProfesionalSave',[profesionales\formularioProfesionalController::class,'create1'])->name('create1');
    /*-----formulario parte 2----*/
    Route::post('/FormularioProfesionalSave2',[profesionales\formularioProfesionalController::class,'create2'])->name('create2');
    /*-----formulario parte 3----*/
    Route::post('/FormularioProfesionalSave3',[profesionales\formularioProfesionalController::class,'create3'])->name('create3');
    Route::post('/FormularioProfesionaldelete3',[profesionales\formularioProfesionalController::class,'delete3'])->name('delete3');
    /*-----formulario parte 4----*/
    Route::post('/FormularioProfesionalSave4',[profesionales\formularioProfesionalController::class,'create4'])->name('create4');
    /*-----formulario parte 5----*/
    Route::post('/FormularioProfesionalSave5',[profesionales\formularioProfesionalController::class,'create5'])->name('create5');
    Route::post('/FormularioProfesionaldelete5',[profesionales\formularioProfesionalController::class,'delete5'])->name('delete5');
    /*-----formulario parte 6----*/
    Route::post('/FormularioProfesionalSave6',[profesionales\formularioProfesionalController::class,'create6'])->name('create6');
    Route::post('/FormularioProfesionaldelete6',[profesionales\formularioProfesionalController::class,'delete6'])->name('delete6');
    /*-----formulario parte 7----*/
    Route::post('/FormularioProfesionalSave7',[profesionales\formularioProfesionalController::class,'create7'])->name('create7');
    Route::post('/FormularioProfesionaldelete7',[profesionales\formularioProfesionalController::class,'delete7'])->name('delete7');
    /*-----formulario parte 8----*/
    Route::post('/FormularioProfesionalSave8',[profesionales\formularioProfesionalController::class,'create8'])->name('create8');
    Route::post('/FormularioProfesionaldelete8',[profesionales\formularioProfesionalController::class,'delete8'])->name('delete8');
    /*-----formulario parte 9----*/
    Route::post('/FormularioProfesionalSave9',[profesionales\formularioProfesionalController::class,'create9'])->name('create9');
    Route::post('/FormularioProfesionaldelete9',[profesionales\formularioProfesionalController::class,'delete9'])->name('delete9');
    /*-----formulario parte 10----*/
    Route::post('/FormularioProfesionalSave10',[profesionales\formularioProfesionalController::class,'create10'])->name('create10');
    Route::post('/FormularioProfesionaldelete10',[profesionales\formularioProfesionalController::class,'delete10'])->name('delete10');
    /*-----formulario parte 11----*/
    Route::post('/FormularioProfesionalSave11',[profesionales\formularioProfesionalController::class,'create11'])->name('create11');
    Route::post('/FormularioProfesionaldelete11',[profesionales\formularioProfesionalController::class,'delete11'])->name('delete11');
    /*-----formulario parte 12----*/
    Route::post('/FormularioProfesionalSave12',[profesionales\formularioProfesionalController::class,'create12'])->name('create12');
    Route::post('/FormularioProfesionaldelete12',[profesionales\formularioProfesionalController::class,'delete12'])->name('delete12');
    /*-----formulario parte 13----*/
    Route::post('/FormularioProfesionalSave13',[profesionales\formularioProfesionalController::class,'create13'])->name('create13');
    Route::post('/FormularioProfesionaldelete13',[profesionales\formularioProfesionalController::class,'delete13'])->name('delete13');
    /*-----formulario parte 14----*/
    Route::post('/FormularioProfesionalAddDestacable',[profesionales\formularioProfesionalController::class,'addDestacable'])->name('create14');
    Route::post('/FormularioProfesionalDeleteDestacable',[profesionales\formularioProfesionalController::class,'deleteDestacable'])->name('delete14');

    //Selects dinamicos area, profesion, especialidad
    Route::get('profesion/{idArea}', [profesionales\profesionController::class,'mostrarProfesion'])->name('mostrarProfesion');
    Route::get('especialidad/{idProfesion}', [profesionales\especialidadController::class,'mostrarESpecialidad'])->name('mostrarESpecialidad');
    Route::post('/profesional/formulario-password',[profesionales\especialidadController::class,'password'])->name('formulario-password');

    /*--------- Admin Profesional -----------*/
    Route::prefix('/profesional')->group(function () {

        Route::get('/panel',[profesionales\Admin\PanelController::class,'index'])->name('panel');

        Route::as('agenda.')->group(function (){

            Route::get('/citas',[profesionales\Admin\CitasController::class,'index'])->name('citas');

            Route::get('/calendario',[profesionales\Admin\CalendarioController::class,'index'])
                ->name('calendario');
            Route::post('/calendario/dias-libre',[profesionales\Admin\CalendarioController::class,'citas_libres'])
                ->name('calendario.dias-libre');
            Route::post('/calendario/crear-cita',[profesionales\Admin\CalendarioController::class,'crear_cita'])
                ->name('calendario.crear-cita');
            Route::get('/calendario/ver-citas',[profesionales\Admin\CalendarioController::class,'ver_citas'])
                ->name('calendario.ver-citas');
            Route::post('/calendario/ver-cita',[profesionales\Admin\CalendarioController::class,'ver_cita'])
                ->name('calendario.ver-cita');
            Route::post('/calendario/actualizar-cita',[profesionales\Admin\CalendarioController::class,'actualizar_cita'])
                ->name('calendario.actualizar-cita');
            Route::post('/calendario/reagendar-cita',[profesionales\Admin\CalendarioController::class,'reagendar_cita'])
                ->name('calendario.reagendar-cita');
            Route::post('/calendario/cancelar-cita',[profesionales\Admin\CalendarioController::class,'cancelar_cita'])
                ->name('calendario.cancelar-cita');
            Route::post('/calendario/completar-cita',[profesionales\Admin\CalendarioController::class,'completar_cita'])
                ->name('calendario.completar-cita');
            Route::post('/calendario/reservar-calendario',[profesionales\Admin\CalendarioController::class,'reservar'])
                ->name('calendario.reservar-calendario');
            Route::post('/calendario/editar-reservar-calendario',[profesionales\Admin\CalendarioController::class,'reservar_editar'])
                ->name('calendario.editar-reservar-calendario');
            Route::post('/calendario/cancelar-reserva-calendario',[profesionales\Admin\CalendarioController::class,'reservar_cancelar'])
                ->name('calendario.cancelar-reserva-calendario');
            Route::post('/calendario/colores',[profesionales\Admin\CalendarioController::class,'colores'])
                ->name('calendario.colors');

            Route::post('/calendario/convenios/{servicio}',[profesionales\Admin\CalendarioController::class,'convenios'])
                ->name('calendario.convenios');

            //Configurar calendario
            Route::get('/configurar-calendario', [profesionales\Admin\CalendarioController::class, 'configuracion'])
                ->name('configurar-calendario');
            Route::post('/configurar-calendario/cita', [profesionales\Admin\CalendarioController::class, 'cita'])
                ->name('configurar-calendario.cita');
            Route::post('/configurar-calendario/agregar_horario', [profesionales\Admin\CalendarioController::class, 'horario_agregar'])
                ->name('configurar-calendario.horario-agregar');
            Route::delete('/configurar-calendario/eliminar_horario', [profesionales\Admin\CalendarioController::class, 'horario_eliminar'])
                ->name('configurar-calendario.horario-eliminar');
        });

        Route::get('/pagos',[profesionales\Admin\PagosController::class,'index'])->name('pagos');

        Route::get('/pacientes',[profesionales\Admin\PacientesController::class,'index'])->name('pacientes');

        Route::as('catalogos.')->group(function () {
            Route:: get('/cie10',[profesionales\Admin\HistoriaClinicaController::class,'cie10'])
                ->name('cie10');
            Route:: get('/cups',[profesionales\Admin\HistoriaClinicaController::class,'cups'])
                ->name('cups');
            Route:: get('/cums',[profesionales\Admin\HistoriaClinicaController::class,'cums'])
                ->name('cums');
        });

        Route:: get('/favoritos',[profesionales\Admin\FavoritosController::class,'index'])->name('favoritos');
        Route:: post('/guardar-especialidades',[profesionales\Admin\FavoritosController::class,'guardar_especialidades'])
            ->name('favoritos.guardar_especialidades');
        Route:: post('/guardar-servicios',[profesionales\Admin\FavoritosController::class,'guardar_servicios'])
            ->name('favoritos.guardar_servicios');
        Route:: post('/guardar-profesional',[profesionales\Admin\FavoritosController::class,'guardar_profesional'])
            ->name('favoritos.guardar_profesional');
        Route:: post('/guardar-instituciones',[profesionales\Admin\FavoritosController::class,'guardar_instituciones'])
            ->name('favoritos.guardar_instituciones');

        Route::resource('contactos', profesionales\Admin\ContactosController::class);

        //Route:: get('/panelAdministrativoProfesional/{idPerfilProfesional}',[admin\adminProfesionalController::class,'cita'])->name('panelAdministrativoProfesional');

        //Route:: get('/ordenesMedicas',[admin\adminExamenesController::class,'index'])->name('ordenesMedicas');
        //Route:: get('/prescripciones',[admin\adminPrescripcionesController::class,'index'])->name('prescripciones');

        //Route:: get('/historiaClinicaProfesional',[admin\adminHistoriaClinicaProfesional::class,'index'])->name('historiaClinicaProfesional');
        //Route:: get('/registroPaciente',[admin\adminHistoriaClinicaProfesional::class,'registrar'])->name('registroPaciente');
        //Route:: get('/pacienteRegistrado',[admin\adminHistoriaClinicaProfesional::class,'registro'])->name('pacienteRegistrado');
        //Route:: get('/editarConsulta',[admin\adminHistoriaClinicaProfesional::class,'consulta'])->name('editarConsulta');
        //Route:: get('/editarPatologia',[admin\adminHistoriaClinicaProfesional::class,'patologia'])->name('editarPatologia');
        //Route:: get('/editarExpediente',[admin\adminHistoriaClinicaProfesional::class,'Expediente'])->name('editarExpediente');

        //Route:: get('/prescripcionesProfesional',[admin\adminPrescripcionesProfesionalController::class,'index'])->name('prescripcionesProfesional');
        //Route:: get('/crearFormulaProfesional',[admin\adminPrescripcionesProfesionalController::class,'formulas'])->name('crearFormulaProfesional');

        //Route:: get('/diagnosticosProfesional',[admin\adminDiagnosticosProfesionalController::class,'index'])->name('diagnosticosProfesinal');
        //Route:: get('/procedimientosProfesional',[admin\adminProcedimientosProfesionalController::class,'index'])->name('procedimientosProfesional');
        //Route:: get('/vademecumProfesional',[admin\adminVademecumProfesionalController::class,'index'])->name('vademecumProfesional');
        //Route:: get('/servicios',[admin\adminController::class,'oscar2'])->name('servicios');

        //Configuración
        Route::group(['prefix' => '/configuracion','as' => 'configuracion.'], function () {
            Route::resource('convenios', profesionales\Admin\ConvenioController::class);
            Route::resource('servicios', profesionales\Admin\ServicioController::class);
            Route::resource('usuarios', profesionales\Admin\UsuarioController::class);
        });
    });
});
