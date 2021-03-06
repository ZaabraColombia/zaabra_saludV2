@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="content_crearHistoria">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Historia clínica</h1>
                        <span class="subtitle_miCita">Diligencie los datos básicos del paciente.</span>
                    </div>
                </div>  
                
                <h1 class="title_miCita">Patología</h1>

                <div class="content_inputs_formula">
                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Alergias</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Enfermedades hereditarias</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Cirugías</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Actividad física</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Fuma</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Si" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Toma</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="No" value="" readonly></input>
                    </div>
                </div>

                <div class="col-12 content_btns_regPaciente">
                    <a type="submit" href="" class="btn_enviar_histClinica" data-toggle="modal" data-target="#exampleModal3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalB" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg container_modal_cancelo" role="document">
            <div class="modal-content content_canceloCita">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitasProf">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_contentCitasProf">
                    <h1 class="title_cancelar_histClinica" id="exampleModalLabel3">Entrada guardada</h1>
                </div>
            </div>
        </div>
    </div>
@endsection