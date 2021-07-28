@extends('panelAdministrativo.panelAdministrativo')
@section('Panel')
    <section class="section">
        <div class="row m-0 p-0" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Mis citas</h1>
                        <span class="subtitle_miCita">encuentre aquí todas sus citas</span>
                    </div>

                    <button type="submit" class="btn_agendar_cita"> Agende su cita
                        <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_btn_agendar" alt=""> 
                    </button>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table_citas table-lg">
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
                                            <td>Juan Hernández</td>
                                            <td>
                                                <span class="badge bg-success">Confirmada</span>
                                            </td>
                                            <td>
                                            <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                                <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>25/05/2021</td>
                                            <td>10:00 a.m.</td>
                                            <td>Presencial</td>
                                            <td>Juan Hernández</td>
                                            <td>
                                                <span class="badge bg-danger">Cancelada</span>
                                            </td>
                                            <td>
                                            <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                                <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>25/05/2021</td>
                                            <td>10:00 a.m.</td>
                                            <td>Presencial</td>
                                            <td>Juan Hernández</td>
                                            <td>
                                                <span class="badge bg-success">Confirmada</span>
                                            </td>
                                            <td>
                                            <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                                <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>25/05/2021</td>
                                            <td>10:00 a.m.</td>
                                            <td>Presencial</td>
                                            <td>Juan Hernández</td>
                                            <td>
                                                <span class="badge bg-danger">Cancelada</span>
                                            </td>
                                            <td>
                                            <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                                <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>25/05/2021</td>
                                            <td>10:00 a.m.</td>
                                            <td>Presencial</td>
                                            <td>Juan Hernández</td>
                                            <td>
                                                <span class="badge bg-success">Confirmada</span>
                                            </td>
                                            <td>
                                                <button class="btn_editar_citas" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
                                                <button class="btn_cierre_citas" type="submit" data-toggle="modal" data-target="#exampleModal2"></button>
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
        <div class="modal-dialog modal-lg modal_dialog-popup" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Editar cita</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Especialidad</label>
                        <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Estado</label>
                        <select name="idespecialidad" id="idespecialidad" class="col-lg-12 form-control" required></select>
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Tipo consulta</label>

                        <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                            <option value="" selected> Seleccionar </option>
                            <option value="Presencial"> Presencial </option>
                            <option value="Virtual"> Virtual </option>
                            <option value="Control médico"> Control Médico </option>
                        </select>
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Fecha</label>
                    
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputRight-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Hora</label>
                    
                        <input class="form-control" type="time" value="" id="example-date-input" name="fechaestudio[]">
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Ciudad</label>
                        <select name="id_municipio" id="id_municipio" class="form-control" required></select>
                    </div>

                    <div class="col-md-6 section_inputLeft-text-formProf">
                        <label for="example-date-input" class="col-12 text_label-formProf">Sede</label>
                        <select name="id_municipio" id="id_municipio" class="form-control" required></select>
                    </div>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="">Guardar
                        <!-- <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_pagar-popup" alt="">  -->
                    </button>
                    <button type="submit" class="btnCancelar-popup" id="">Cancelar
                        <!-- <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_pagar-popup" alt="">  -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalA" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_dialog-popup" role="document">
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
                    <button type="submit" class="btn_cancela-cita" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelo">Sí, cancelar cita
                        <!-- <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_pagar-popup" alt="">  -->
                    </button>
                    <button type="submit" class="btn_noCancela-cita" id="">No cancelar
                        <!-- <img src="{{URL::asset('/img/iconos/icono-flecha-blanco.svg')}}" class="flecha_pagar-popup" alt="">  -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalB" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg container_modal_cancelo" role="document">
            <div class="modal-content content_citaCancela">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_cancelarCitas">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_cancelarCitas">
                    <h1 class="title_cancelar_miCita" id="exampleModalLabel3">Cita cancelada.</h1>
                </div>
            </div>
        </div>
    </div>
@endsection