@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Mis citas</h1>
                        <span class="subtitle_miCita">Encuentre aquí las citas agendadas por sus pacientes.</span>
                    </div>
                </div>

                <div class="card container_citas">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive section_tableCitas">
                                <table class="table table-lg table_citas">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Tipo de cita</th>
                                            <th>Paciente</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>25/05/2021</td>
                                            <td>10:00 a.m.</td>
                                            <td>Presencial</td>
                                            <td>Laura León</td>
                                            <td>
                                                <span class="badge bg-success">Confirmada</span>
                                            </td>
                                            <td>
                                                <button class="btn_editar_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                            <td>
                                                <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19/05/2021</td>
                                            <td>3:00 p.m.</td>
                                            <td>Virtual</td>
                                            <td>Jorge Romero</td>
                                            <td>
                                                <span class="badge bg-danger">Cancelada</span>
                                            </td>
                                            <td>
                                                <button class="btn_editar_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                            <td>
                                                <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>26/05/2021</td>
                                            <td>11:00 a.m.</td>
                                            <td>Control medico</td>
                                            <td>Martha Rodríguez</td>
                                            <td>
                                                <span class="badge bg-success">Confirmada</span>
                                            </td>
                                            <td>
                                                <button class="btn_editar_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                            </td>
                                            <td>
                                                <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pop-up  editar cita -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Editar cita</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <form method="POST" action="">
                        <!-- <div class="col-md-6 section_inputRight-text-formProf">
                            <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>
                            <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                        </div> -->

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>

                            <input class="col-12 form-control" id="" placeholder="Traumatología" type="text" name="" required>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Estado</label>

                            <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                <option value="" selected> Seleccionar </option>
                                <option value="Presencial"> Confirmada </option>
                                <option value="Virtual"> Cancelada </option>
                            </select>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Fecha</label>
                        
                            <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="example-date-input" class="col-12 text_label-formProf">Hora</label>
                        
                            <input class="form-control" type="time" value="" id="example-date-input" name="fechaestudio[]">
                        </div>
                    </form>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="">Guardar</button>

                    <button type="submit" class="btnCancelar-popup" id="">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalA" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_citaCancela">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel2">¿Está seguro de cancelar cita?</h1>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_cancelar_citas">
                    <!-- Función onclick para mostrar el pop-up de cancelación y ocultar pop-up de opciones la cual esta implementada en admin.js -->
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, cancelar cita</button>

                    <button type="submit" class="btn_noCancela-cita" id="">No cancelar</button>
                </div>
            </div>
        </div>
    </div>

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
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel3">Cita cancelada.</h1>
                </div>
            </div>
        </div>
    </div>
@endsection