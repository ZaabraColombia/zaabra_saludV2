@extends('panelAdministrativoPac.panelAdministrativo')

@section('styles')
    <!--Framewor Agenda-->
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
@endsection

@section('Panel')

    <div class="row">
        <div class="col-12">
            @if(isset($profesional))
                <div class="section_data_profesionales">
                    <div id="data-eventos-profesional" data-events='[{"id":0,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-21","tipo_cita":"Virtual","allDay":true},{"id":1,"title":"Medicina","profesional":"Jorge Machado","start":"2021-08-22","tipo_cita":"Virtual","allDay":true},{"id":2,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-23","tipo_cita":"Prensencial","allDay":true},{"id":3,"title":"Odontologia","profesional":"Jhoana Gutierres","start":"2021-08-24","tipo_cita":"Prensencial","allDay":true}]'></div>
                    <div class="modal fade modalC" id="ver-cita-paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal_citas_popUp" role="document">
                            <div class="modal-content content_modalCitas">
                                <!-- Sección boton derecho de cierre "X" -->
                                <div class="modal-header modal_headerCitas">
                                    <h1 class="title_popup_miCita" id="exampleModalLabel">Cita <label id="especialidad-paciente"></label></h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body modal_headerCitas">
                                    <h5 class="text_labelCita_popUp" id="profesional-paciente"></h5>
                                    <div class="col-md-10 contain_infoCita_popUp">
                                        <h5 class="text_labelCita_popUp" id="fecha-paciente" >Jueves, 12 de mayo</h5>
                                        <span class="icono_reloj_popUp text_infoCita_popUp" id="hora-paciente">10:47 - 11:47 a.m</span>
                                    </div>
                                    <div class="col-md-10 contain_infoCita_popUp">
                                        <h5 class="text_labelCita_popUp">Tipo de cita</h5>
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
                    <div class="modal fade" id="agendar-cita-modal-paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form method="POST" action="" id="agregar-cita-form-paciente">
                                        <div class="col-md-6 p-0">
                                            <label for="tipo_cita-select-paciente" class="col-12 text_label-formProf">Tipo de consulta</label>
                                            <select id="tipo_cita-select-paciente" class="form-control" name="tipo_cita-select-paciente">
                                                <option value="Presencial"> Presencial </option>
                                                <option value="Virtual"> Virtual </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 p-0">
                                            <label for="fecha_input-paciente" class="col-12 text_label-formProf">Fecha</label>
                                            <input class="form-control" type="text" id="fecha_input-paciente" name="fecha_input-paciente" disabled>
                                        </div>

                                        <div class="col-md-6 p-0">
                                            <label for="hora_input-paciente" class="col-12 text_label-formProf">Hora</label>
                                            <input class="form-control" type="time" id="hora_input-paciente" name="hora_input-paciente">
                                        </div>

                                    </form>
                                </div>

                                <!-- Sección botón Pagar -->
                                <div class="modal-footer section_btn_citas">
                                    <button type="submit" class="btnAgendar-popup" id="pagar-cita-paciente">Hacer pago</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="data_profesionales">
                        <img src="{{ asset($profesional->fotoperfil) }}">
                        <div class="contains_info">
                            <h2 id="nombre_profesional-paciente">{{$profesional->primernombre}} {{$profesional->segundonombre}} {{$profesional->primerapellido}} {{$profesional->segundoapellido}}</h2>
                            <h1 id="especialidad_profesional-paciente">{{$profesional->nombreEspecialidad}}</h1>
                            <h5>{{$profesional->nombreuniversidad}}</h5>
                            <h5>N° Tarjeta profesional: {{$profesional->numeroTarjeta}}</h5>
                            <!-- Rating Stars Box -->
                            <div class='rating-stars star_box'>
                                @if(!empty($comentarios))
                                    @foreach($comentarios as $promedioEstrellas)
                                    @endforeach
                                    @for ($i=1; $i <= $promedioEstrellas->calificacionRedondeada; $i++)
                                        <li class='star' title='Poor'>
                                            <i class='fa fa-star fa-fw' style="color: #E6C804;"></i>
                                        </li>
                                    @endfor
                                    @for ($i=$promedioEstrellas->calificacionRedondeada; $i <= 4; $i++)
                                        <li class='star' title='Poor'>
                                            <i class="far fa-star" style="color: #E6C804;"></i>
                                        </li>
                                    @endfor
                                @endif
                            </div>

                            <!-- <div class="contains_direccion"></div> -->
                            <h5 class="title-adress"><i></i>{{ $profesional->direccion }}</h5>
                            <h5>{{ $profesional->nombre }}</h5>
                        </div>
                    </div>
                </div>

                <!-- seccion datos consulta perfil profesional-->
                <div class="section_data_consulta">
                    <h2>Tipo de consulta</h2>
                    <div class="data_consulta">
                        <ul>
                            @foreach ($consultas as $consulta)
                                <li>
                                    <p class="menu_{{$loop->iteration}}"><i></i>{{$consulta->nombreconsulta}}</p>
                                    <span><i></i>${{number_format($consulta->valorconsulta, 0, ",", ".") }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="col-12 col-lg-9 p-0 mt-5">
        <div class="modal fade" id="ayuda" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ayuda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contains_option_days">
                            <h2 class="dias no_disponible"><i></i> Días no disponibles</h2>
                            <h2 class="dias"><i></i> Días disponibles</h2>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="calendar"></div>
    </div>
@endsection

@section('scripts')
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <!-- Full calendar JS -->
    <script src="{{ asset('fullCalendar/main.js') }}"></script>
    <script src="{{ asset('fullCalendar/locales/es.js') }}"></script>

    <script src="{{ asset('js/fullcalendar.js') }}"></script>
@endsection
