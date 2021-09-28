@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="content_crearHistoria">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Historia clínica</h1>
                        <span class="subtitle_miCita">Administre las historias clínicas de sus pacientes.</span>
                    </div>
                </div>

                <h1 class="title_miCita">Consultas</h1>

                <div class="content_inputs_formula">
                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Sintomas</label>

                        <input type="text" class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Prescripción médica</label>

                        <input type="text" class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Receta médica</label>

                        <input type="text" class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>

                    <div class="section_input_formula">
                        <label for="example-date-input" class="col-12 text_label-formInst">Resultados médicos</label>

                        <input type="text" class="col-12 input_nomApl-formInst" placeholder="Ninguno" value="" readonly></input>
                    </div>
                </div>

                <h2 class="text1_consulta">Cargue el archivo. Maximo 5 documentosy que el peso de cada uno sea inrferior a 1 MB.</h2>

                <h2 class="text2_consulta">Documento examenes</h2>


                <div class="section_addFile_consulta">
                    <input class="form-control cajaTxt_consulta" type="text" name=""  id="" readonly>
                    <input class="form-control addFile_consulta" type="file" class="selecFile_ordMed" id="">
                    <label class="text_input_consulta">Seleccionar archivo</label>
                    <input class="btnSend_ordMed" type="submit" value="subir">
                </div>

                <div class="col-12 content_btns_histClinica mt-md-0">
                    <div class="col-12 content_btns_regPaciente mt-md-0 mt-lg-5">
                        <a type="submit" href="{{route('profesional.pacienteRegistrado')}}" class="btn_enviar_histClinica" data-toggle="modal" data-target="#exampleModal3"> Guardar
                            <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar_histClinic" alt="">
                        </a>
                    </div>
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
