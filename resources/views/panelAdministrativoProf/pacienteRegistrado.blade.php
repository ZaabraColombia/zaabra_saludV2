@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Historia clínica - Juan Hernández</h1>
                        <span class="subtitle_miCita">Registre la información de la consulta del paciente.</span>
                    </div>
                </div>

                <div class="card container_citas">
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="title_miCita">CONSULTAS</h1>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive section_tableCitas">
                                <table class="table table-lg table_citas">
                                    <thead>
                                        <tr>
                                            <th>Sintomas</th>
                                            <th>Prescripción médica</th>
                                            <th>Receta médica</th>
                                            <th>Resultados médicos</th>
                                            <th>Examenes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ninguno</td>
                                            <td>No aplica</td>
                                            <td>Dra. Sandra Bernal</td>
                                            <td>Ninguno</td>
                                            <td>examen_medico_traumatologia.pdf</td>
                                        </tr>
                                        <tr>
                                            <td>Dolor de cabeza</td>
                                            <td>Acetaminofen 500mg cada 8 horas</td>
                                            <td>Dr. Andrés López</td>
                                            <td>Ninguno</td>
                                            <td>examen_medico_traumatologia.pdf</td>
                                        </tr>
                                        <tr>
                                            <td>Dolor de pie</td>
                                            <td>Lorataina 500mg cada 8 horas</td>
                                            <td>Dr. Juan Alzate</td>
                                            <td>Ninguno</td>
                                            <td>examen_medico_traumatologia.pdf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 content_btns_regPaciente">
                                <a type="submit" href="{{route('editarConsulta')}}" class="btn_enviar_pacRegistrado"> Editar consulta
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card container_citas mt-3">
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="title_miCita">PATOLOGÍA</h1>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive section_tableCitas">
                                <table class="table table-lg table_citas">
                                    <thead>
                                        <tr>
                                            <th>Alergias</th>
                                            <th>Enfermedades hereditarias</th>
                                            <th>Cirugías</th>
                                            <th>Actividad física</th>
                                            <th>Fuma</th>
                                            <th>Toma</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Polvo</td>
                                            <td>Diabetes</td>
                                            <td>Ninguna</td>
                                            <td>Ninguno</td>
                                            <td>No</td>
                                            <td>No</td>
                                        </tr>
                                        <tr>
                                            <td>Fresas</td>
                                            <td>Acondroplasia</td>
                                            <td>Apéndice</td>
                                            <td>Correr</td>
                                            <td>Si</td>
                                            <td>Si</td>
                                        </tr>
                                        <tr>
                                            <td>Mní</td>
                                            <td>Alzheimer</td>
                                            <td>Ninguna</td>
                                            <td>Ninguno</td>
                                            <td>No</td>
                                            <td>No</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 content_btns_regPaciente">
                                <a type="submit" href="{{route('editarPatologia')}}" class="btn_enviar_pacRegistrado"> Editar patología
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card container_citas mt-3">
                    <div class="card-content">
                        <div class="card-body">
                            <h1 class="title_miCita">EXPEDIENTE</h1>
                            <!-- Table with outer spacing -->
                            <div class="table-responsive section_tableCitas">
                                <table class="table table-lg table_citas">
                                    <thead>
                                        <tr>
                                            <th>Peso</th>
                                            <th>Altura</th>
                                            <th>Presión arterial</th>
                                            <th>Revisión pulmonar</th>
                                            <th>Revisión corazón</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>50</td>
                                            <td>1.50</td>
                                            <td>120/80</td>
                                            <td>Buena</td>
                                            <td>Ninguno</td>
                                            <td>No tiene buen peso</td>
                                        </tr>
                                        <tr>
                                            <td>75</td>
                                            <td>1.80</td>
                                            <td>140/90</td>
                                            <td>Ninguno</td>
                                            <td>Ninguno</td>
                                            <td>Hipertensión grado 1</td>
                                        </tr>
                                        <tr>
                                            <td>65</td>
                                            <td>1.60</td>
                                            <td>120/90</td>
                                            <td>Ninguno</td>
                                            <td>Ninguno</td>
                                            <td>Ninguna</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12 content_btns_regPaciente">
                                <a type="submit" href="{{route('editarExpediente')}}" class="btn_enviar_pacRegistrado"> Editar Expediente
                                    <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_guardar-formProf" alt=""> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection