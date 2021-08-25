@extends('panelAdministrativoProf.panelAdministrativoProfesional')

@section('PanelProf')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Mi Calendario</h1>
                        <span class="subtitle_miCita">Administre su calendario de citas</span>
                    </div>
                </div>

                <div class="contains_option_days">
                    <h2 class="dias no_disponible"><i></i> Días no disponibles</h2>
                    <h2 class="dias"><i></i> Días disponibles</h2>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 p-0">
                <div id="calendar-profesional"></div>
            </div>
        </div>

        <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#agregar-cita-profesional"></button>
    </section>

    <!-- Pop-up  ver cita -->
    <div class="modal fade modalC" id="ver-cita-profecional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Cita <label id="especialidad-profesional"></label></h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal_headerCitas">
                    <h5 class="text_labelCita_popUp" id="nombre_paciente-profesional">Laura León</h5>
                    <div class="col-md-10 contain_infoCita_popUp">
                        <h5 class="text_labelCita_popUp" id="fecha-profesional" >Jueves, 12 de mayo</h5>
                        <span class="icono_reloj_popUp text_infoCita_popUp" id="hora-profesional">10:47 - 11:47 a.m</span>
                    </div>
                    <div class="col-md-10 contain_infoCita_popUp">
                        <h5 class="text_labelCita_popUp">Tipo de cita</h5>
                        <span class="icono_tipoCita_popUp text_infoCita_popUp" id="tipo_cita-profesional">Presencial</span>
                    </div>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="" data-toggle="modal" data-target="#exampleModal2" onclick="elementClose(this)" data-position="edito">Editar cita</button>

                    <button type="submit" class="btnCancelar-popup" id="" data-toggle="modal" data-target="#exampleModal3" onclick="elementClose(this)" data-position="cancelar">Cancelar cita </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up agendar cita -->
    <div class="modal fade modalD" id="agregar-cita-profesional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
            <div class="modal-content content_modalCitas">
                <!-- Sección boton derecho de cierre "X" -->
                <div class="modal-header modal_headerCitas">
                    <h1 class="title_popup_miCita" id="exampleModalLabel">Agendar cita</h1>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body modal_headerCitas">
                    <form method="POST" action="" id="form-agendar-cita-profecional">
                        <div class="col-md-6 p-0">
                            <label for="especialidad_input-profesional" class="col-12 text_label-formProf">Especialidad</label>
                            <input class="form-control" type="text" value="{{ auth()->user()->profecional->profecion->nombreProfesion }}" id="especialidad_input-profesional" name="especialidad_input-profesional" readonly>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="tipo_cita_select-profesional" class="col-12 text_label-formProf">Tipo de cita</label>
                            <select id="tipo_cita_select-profesional" class="form-control" name="tipo_cita_select-profesional">
                                <option value="Presencial"> Presencial </option>
                                <option value="Virtual"> Virtual </option>
                            </select>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="paciente_input-profesional" class="col-12 text_label-formProf">Nombre Paciente</label>
                            <input class="form-control" type="text" id="paciente_input-profesional" name="paciente_input-profesional">
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="fecha_input-profesional" class="col-12 text_label-formProf">Fecha</label>
                            <input class="form-control" type="text" id="fecha_input-profesional" name="fecha_input-profesional" disabled>
                        </div>

                        <div class="col-md-6 p-0">
                            <label for="hora_input-profesional" class="col-12 text_label-formProf">Hora</label>
                            <input class="form-control" type="time" id="hora_input-profesional" name="hora_input-profesional">
                        </div>

                    </form>
                </div>

                <!-- Sección botón Pagar -->
                <div class="modal-footer section_btn_citas">
                    <button type="submit" class="btnAgendar-popup" id="agendar-cita-profesional">Agendar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up cancelar cita -->
    <div class="modal fade modalE" id="cancelada-cita-profecional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
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
