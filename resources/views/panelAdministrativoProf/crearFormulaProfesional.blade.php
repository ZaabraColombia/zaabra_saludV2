@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
        <section class="section">
            <div class="row containt_agendaProf" id="basic-table">
                <div class="col-12 p-0">
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

                    <input class="btn_agregar_fav mt-5" type="button" id="btnagregar_espec" value="Agregar medicamento">
                    <!-- icono_agragar_fav -->

                    <div class="col-12 content_btnEnviar-formProf">
                    <button type="submit" class="btn2_enviar-formProf mb-md-4 my-lg-3"> Guardar
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                    </button>
                </div>
                </div>
            </div>
        </section>
@endsection