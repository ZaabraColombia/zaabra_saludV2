@extends('profesionales.admin.layouts.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="content_crearHistoria">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Prescripciones/fórmulas médicas</h1>
                        <span class="subtitle_miCita">Agregue los medicamentos de la prescripción/fórmula de sus pacientes</span>
                    </div>
                </div>

                <div class="content_inputs_formula">
                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Nombre del paciente</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Laura León" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Documento del paciente</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="1073168521" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Especialista</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Dr. Juan Manuel Hernandez" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Especialidad</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Traumatología" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Nombre del medicamento</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Acetaminofen" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Dosis/Concentración</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="200mg" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Posología</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Tomar una pastilla cada 8 horas, durante 7 días" value="" readonly></input>
                    </div>
                </div>

                <div class="col-12 content_btns_histClinica">
                    <input class="btn_agregar_fav icono_agragar_histClinica" type="button" id="btnagregar_espec" value="Agregar medicamento">

                    <button type="submit" class="btn_enviar_histClinica" data-toggle="modal" data-target="#exampleModal3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt="">
                    </button>
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
                    <h1 class="title_cancelar_histClinica" id="exampleModalLabel3">Prescripción/fórmula guardada <br> <b>Código: 00123</b> </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
