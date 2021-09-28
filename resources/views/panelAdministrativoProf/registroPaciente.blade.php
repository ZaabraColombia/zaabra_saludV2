@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="content_crearHistoria">
                <div class="section_cabecera_histClinica">
                    <div>
                        <h1 class="title_miCita">Historia clínica</h1>
                        <span class="subtitle_miCita">Diligencie los datos básicos del paciente.</span>
                    </div>
                </div>

                <div class="content_inputs_formula">
                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Nombre del paciente</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="Juan Hernandez" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Documento del paciente</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="1013568142" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Correo electrónico</label>

                        <input class="col-12 input_nomApl-formInst" placeholder="servicioalcliente@zaabrasalud.com" value="" readonly></input>
                    </div>
                </div>

                <div class="col-12 mb-5 content_btns_regPaciente">
                    <a type="submit" href="{{route('profesional.pacienteRegistrado')}}" class="btn_enviar_histClinica" > Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar_histClinic" alt="">
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
                    <h1 class="title_cancelar_histClinica" id="exampleModalLabel3">Prescripción/fórmula guardada <br> <b>Código: 00123</b> </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
