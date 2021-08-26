@extends('panelAdministrativo.panelAdministrativo')
@section('Panel')

    <h1 class="title_calendar">Mi Calendario</h1>
    <p class="text_calendar">Administre su calendario de citas</p>

    <div class="contains_option_days">
        <h2 class="dias no_disponible"><i></i> Días no disponibles</h2>
        <h2 class="dias"><i></i> Días disponibles</h2>
    </div>


    <div class="col-12 col-lg-9 p-0">
        <div id="calendar"></div>


        @if(isset($profesional))
            <div class="row">
                <div id="data-eventos-profesional" data-events=""></div>
                <div class="col-3 contain_imgUsuario-formProf">
                    <img id="imagenPrevisualizacion" class="img_usuario-formProf" src="{{ asset($profesional->fotoperfil) }}">
                </div>
                <div class="col-9 contains_info">
                    <h2>{{$profesional->user->primernombre}} {{$profesional->user->primerapellido}}</h2>
                    <h1>{{$profesional->especialidad->nombreEspecialidad}}</h1>
                    <h5>{{$profesional->nombreuniversidad}}</h5>
                    <h5>N° Tarjeta profesional: {{$profesional->numeroTarjeta}}</h5>
                </div>
            </div>
            <div class="modal fade modalC" id="ver-cita-paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <h5 class="text_labelCita_popUp" id="nombre_profesional-paciente">Laura León</h5>
                            <div class="col-md-10 contain_infoCita_popUp">
                                <h5 class="text_labelCita_popUp" id="fecha-paciente" >Jueves, 12 de mayo</h5>
                                <span class="icono_reloj_popUp text_infoCita_popUp" id="hora-paciente">10:47 - 11:47 a.m</span>
                            </div>
                            <div class="col-md-10 contain_infoCita_popUp">
                                <h5 class="text_labelCita_popUp">Tipo de cita</h5>
                                <span class="icono_tipoCita_popUp text_infoCita_popUp" id="tipo_cita-paceinte">Presencial</span>
                            </div>
                            <div class="col-md-10 contain_infoCita_popUp">
                                <h5 class="text_labelCita_popUp">Sede</h5>
                                <span class="icono_tipoCita_popUp text_infoCita_popUp" id="tipo_cita-paceinte">Presencial</span>
                            </div>
                        </div>

                        <!-- Sección botón Pagar -->
                        <div class="modal-footer section_btn_citas">
                            <!-- <button type="button" class="btnCancelar-popup" id="cancelar-cita-btn-profesional">Cancelar cita </button> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pop-up agendar cita -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form method="POST" action="">
                                <div class="col-md-6 p-0">
                                    <label for="example-date-input" class="col-12 text_label-formProf">Tipo de consulta</label>

                                    <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                        <option value="Presencial"> Presencial </option>
                                        <option value="Virtual"> Virtual </option>
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

                                <div class="col-md-6 p-0">
                                    <label for="example-date-input" class="col-12 text_label-formProf">Ciudad</label>

                                    <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                        <option value="" selected> Seleccionar </option>
                                    </select>
                                </div>

                                <div class="col-md-6 p-0">
                                    <label for="example-date-input" class="col-12 text_label-formProf">Sede</label>

                                    <select id="nombreconsulta[]" class="form-control" name="nombreconsulta[]">
                                        <option value="" selected> Seleccionar </option>
                                        <option value="Presencial"> Hospital el Tunal </option>
                                        <option value="Virtual"> Hospital San Rafael </option>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <!-- Sección botón Pagar -->
                        <div class="modal-footer section_btn_citas">
                            <button type="submit" class="btnAgendar-popup" id="">Hacer pago</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div id="calendar"></div>

        <button class="btn_cierre_citasProf" type="submit" data-toggle="modal" data-target="#exampleModal1"></button>
    </div>
@endsection
