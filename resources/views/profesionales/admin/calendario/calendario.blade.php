@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <section class="section">
        <div class="row containt__calendar" id="basic-table">
            <div class="my-4 my-xl-5">
                <h1 class="title__xl blue_bold">Calendario</h1>
                <span class="text__md black_light">Administre su calendario de citas</span>
            </div>

            <div class="col-12 col-lg-11 col-xl-12 p-0">
                <div class="config__calendar">
                    <span class="text__md black_light">Ajuste calendario</span>
                    <div class="row m-0 pb-4 mt-3">
                        <button id="actualizar-calendar" class="button_blue_form"><i data-feather="refresh-cw" class="pr-2"></i>Actualizar</button>
                        <button id="bloquear-dia" class="button_blue_form ml-2"><i data-feather="lock" class="pr-2"></i>Bloquear días</button>
                    </div>

                    <div class="row m-0 content_dias_agenda mb-md-3">
                        <h2>Días</h2>
                        <div class="col-md-4 col-xl-12 p-0">
                            <label for="dia_disp"> <input id="dia_disp" type="color" value="#FFFFFF" readonly> Días disponibles</label>
                        </div>

                        <div class="col-md-4 col-xl-12 p-0">
                            <label for="dia_nodis"> <input id="dia_nodis" type="color" value="#D8D8D8" readonly> Días no disponibles</label>
                        </div>

                        <h2>Eventos</h2>

                        <form action="{{ route('profesional.agenda.calendario.colors') }}" method="post"
                              id="form-actualizar-colores-calendario">
                            @csrf
                            <div class="col-md-4 col-xl-12 p-0 content_center_agenda">
                                <label for="cit_pag">
                                    <input id="color_cita_pagada" name="color_cita_pagada" class="colors"
                                           type="color" value="{{ $horario->color_cita_pagada ?? '#1B85D7' }}">
                                    Citas pagadas
                                </label>
                            </div>

                            <div class="col-md-4 col-xl-12 p-0 content_right_agenda">
                                <label for="cit_pre">
                                    <input id="color_cita_presencial" name="color_cita_presencial" class="colors"
                                           type="color" value="{{ $horario->color_cita_presencial ?? '#D6FFFB' }}">
                                    Cita pago presencial
                                </label>
                            </div>

                            <div class="col-md-4 col-xl-12 p-0 content_center_agenda">
                                <label for="cit_agend">
                                    <input id="color_cita_agendada" name="color_cita_agendada" class="colors"
                                           type="color" value="{{ $horario->color_cita_agendada ?? '#019F86' }}">
                                    Citas agendadas
                                </label>
                            </div>

                            <div class="col-md-4 col-xl-12 p-0 content_right_agenda">
                                <label for="cit_canc">
                                    <input id="color_cita_cancelada" name="color_cita_cancelada" class="colors"
                                           type="color" value="{{ $horario->color_cita_cancelada ?? '#9DD1F9' }}">
                                    Citas canceladas
                                </label>
                            </div>

                            <div class="col-md-4 col-xl-12 p-0">
                                <label for="dia_block">
                                    <input id="color_bloqueado" name="color_bloqueado" class="colors"
                                           type="color" value="{{ $horario->color_bloqueado ?? '#F37725' }}">
                                    Bloqueos
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-11 col-xl-8 p-0" id="alerta-general"></div>

            <div class="col-12 col-lg-11 col-xl-8 p-0 mb-3">
                <div id="calendar" data-events="{{ route('profesional.agenda.calendario.ver-citas') }}"
                     data-weekBissness='{!! json_encode($horario->horario) !!}'
                     data-days='{!! json_encode($dias_disponibles) !!}'
                     data-daysFree='{{ route('profesional.agenda.calendario.dias-libre') }}'></div>
            </div>
        </div>

    </section>

    <!-- Modal día calendario -->
    <div class="modal fade" id="modal_dia_calendario" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Agendamiento de citas</h1>

                    <div class="card card_day mb-2">
                        <div class="card-header">
                            <div class="card_header_day"></div>
                            <div class="card_header_day"></div>
                        </div>
                        <div class="card-body">
                            <span id="span-day-clicked"></span>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_blue" id="btn-agendar-cita">Agendar cita</button>
                    <button type="button" class="button_blue" id="btn-ver-dia">Ver citas</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  agendar cita -->
    <div class="modal fade" id="agregar_cita" tabindex="-1" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('profesional.agenda.calendario.crear-cita') }}" id="form-agendar-cita-profesional">
                    <div class="modal-body">
                        <h1>Agendar cita</h1>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-agregar_cita"></div>

                                <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                    <label for="numero_id">Número de identificación</label>
                                    <select type="text" id="numero_id" name="numero_id" required>
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" id="nombre" name="nombre" readonly/>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" id="apellido" name="apellido" readonly/>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="correo">Correo</label>
                                    <input type="email" id="correo" name="correo" readonly/>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                    <label for="tipo_cita">Tipo de servicio</label>
                                    <select id="tipo_cita" name="tipo_cita" required>
                                        <option ></option>
                                        @if($servicios->isNotEmpty())
                                            @foreach($servicios as $servicio)
                                                <option value="{{ $servicio->id }}" data-cantidad="{{ $servicio->valor }}">{{ $servicio->nombre }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="disponibilidad">Horario disponible</label>
                                    <select id="disponibilidad" name="disponibilidad" required></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">     <!--menu dinamico ciudades -->
                                    <label for="pais_id">País</label>
                                    <select class="select2 pais" name="pais_id" id="pais_id" data-modal="#agregar_cita"
                                            data-id="{{ $user->profecional->idpais }}" data-departamento="#departamento_id"
                                            data-provincia="#provincia_id" data-ciudad="#ciudad_id">
                                        @if($paises->isNotEmpty())
                                            @foreach($paises as $pais)
                                                <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="departamento_id">Departamento</label>
                                    <select name="departamento_id" class="select2 departamento" id="departamento_id"
                                            data-modal="#agregar_cita" data-provincia="#provincia_id" data-ciudad="#ciudad_id"
                                            data-id="{{ $user->profecional->id_departamento }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="provincia_id" >Provincia</label>
                                    <select name="provincia_id" class="select2 provincia" id="provincia_id"
                                            data-modal="#agregar_cita" data-ciudad="#ciudad_id"
                                            data-id="{{ $user->profecional->id_provincia }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="ciudad_id">Ciudad</label>
                                    <select name="ciudad_id" class="select2" id="ciudad_id" data-modal="#agregar_cita"
                                            data-id="{{ $user->profecional->id_municipio }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                    <label for="lugar">Lugar de cita</label>
                                    <input type="text" id="lugar" name="lugar" required
                                           value="{{ $user->profecional->direccion }}"
                                           data-default="{{ $user->profecional->direccion }}" />
                                </div>

                                <div class="col-lg-6 p-0 pl-lg-2">
                                    <label for="cantidad">Pago</label>
                                    <input type="text" id="cantidad" name="cantidad" required/>
                                </div>

                                <div class="col-lg-6 p-0 pr-lg-2">
                                    <label for="modalidad_pago">Modalidad de pago</label>
                                    <select id="modalidad_pago" name="modalidad_pago" required>
                                        <option></option>
                                        <option value="virtual">Virtual</option>
                                        <option value="presencial">Presencial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent"
                                id="cancelar-cita-btn-profesional" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Agendar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal ver cita -->
    <div class="modal fade" id="modal_ver_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Detalle de la cita</h1>

                    <div class="modal_info_cita">
                        <div class="p-3">
                            <h2 class="nombre_paciente"></h2>
                            <p class="numero_id"></p>
                            <p class="correo"></p>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-7 p-0 pl-3 mb-2">
                                <h3 class="fecha" ></h3>
                                <span class="hora"></span>
                            </div>
                            <div class="col-md-5 p-0 pl-3 mb-2">
                                <h3>Tipo de cita</h3>
                                <span class="tipo_cita"></span>
                            </div>
                            <div class="col-12 p-0 pl-3 mb-2 d-flex">
                                <h3>Modalidad de pago: &nbsp;</h3>
                                <span class="modalidad"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" id="btn-cita-cancelar">
                        Cancelar
                    </button>
                    <button type="submit" class="button_blue" id="btn-cita-reagendar">
                        Reagendar
                    </button>
                    <button type="submit" class="button_blue" id="btn-cita-editar">
                        Editar
                    </button>
                    <button type="submit" class="button_green" id="btn-cita-completar">
                        Completar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar cita -->
    <div class="modal fade " id="modal_editar_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('profesional.agenda.calendario.actualizar-cita') }}" id="form-editar-cita">
                    <div class="modal-body">
                        <h1>Editar cita</h1>

                        <div class="modal_info_cita mb-3">
                            <div class="p-3">
                                <h2 class="nombre_paciente"></h2>
                                <p class="numero_id"></p>
                                <p class="correo"></p>
                            </div>
                            <div class="row m-0">
                                <div class="col-md-7 p-0 pl-3 mb-2">
                                    <h3 class="fecha" ></h3>
                                    <span class="hora"></span>
                                </div>
                                <div class="col-md-5 p-0 pl-3 mb-2">
                                    <h3>Tipo de cita</h3>
                                    <span class="tipo_cita"></span>
                                </div>
                                <div class="col-12 p-0 pl-3 mb-2 d-flex">
                                    <h3>Modalidad de pago: &nbsp;</h3>
                                    <span class="modalidad"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-editar"></div>
                                <input type="hidden" id="id_cita-editar" name="id_cita"/>
                                <div class="col-12 p-0">
                                    <label for="tipo_cita-editar">Tipo de servicio</label>
                                    <select id="tipo_cita-editar" name="tipo_cita" required>
                                        <option></option>
                                        @if($servicios->isNotEmpty())
                                            @foreach($servicios as $servicio)
                                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="pais_id-editar">País</label>
                                    <select class="select2 pais" name="pais_id" id="pais_id-editar" data-modal="#modal_editar_cita"
                                            data-departamento="#departamento_id-editar" data-provincia="#provincia_id-editar"
                                            data-ciudad="#ciudad_id-editar">
                                        @if($paises->isNotEmpty())
                                            @foreach($paises as $pais)
                                                <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="departamento_id-editar">Departamento</label>
                                    <select name="departamento_id" class="select2 departamento" id="departamento_id-editar"
                                            data-modal="#modal_editar_cita" data-provincia="#provincia_id-editar"
                                            data-ciudad="#ciudad_id-editar"></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="provincia_id-editar" >Provincia</label>
                                    <select name="provincia_id" class="select2 provincia" id="provincia_id-editar"
                                            data-modal="#modal_editar_cita" data-ciudad="#ciudad_id-editar"
                                            data-id="{{ $user->profecional->id_provincia }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="ciudad_id-editar">Ciudad</label>
                                    <select name="ciudad_id" class="select2" id="ciudad_id-editar" data-modal="#modal_editar_cita"
                                            data-id="{{ $user->profecional->id_municipio }}"></select>
                                </div>

                                <div class="col-12 p-0">
                                    <label for="lugar-editar">Lugar de cita</label>
                                    <input type="text" id="lugar-editar" name="lugar" required/>
                                </div>
                                <div class="col-md-6 p-0 pr-md-2">
                                    <label for="modalidad_pago-editar">Modalidad de pago</label>
                                    <select id="modalidad_pago-editar" name="modalidad_pago" required>
                                        <option></option>
                                        <option value="virtual">Virtual</option>
                                        <option value="presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-md-6 p-0 pl-md-2">
                                    <label for="cantidad-editar">Pago</label>
                                    <input type="text" id="cantidad-editar" name="cantidad" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  reagendar cita -->
    <div class="modal fade" id="modal_reagendar_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action="{{ route('profesional.agenda.calendario.reagendar-cita') }}" id="form-cita-reagendar">
                    <div class="modal-body">
                        <h1>Reagendar cita</h1>

                        <div class="modal_info_cita mb-3">
                            <div class="p-3">
                                <h2 class="nombre_paciente"></h2>
                                <p class="numero_id"></p>
                                <p class="correo"></p>
                            </div>
                            <div class="row m-0">
                                <div class="col-md-7 p-0 pl-3 mb-2">
                                    <h3 class="fecha"></h3>
                                    <span class="hora"></span>
                                </div>
                                <div class="col-md-5 p-0 pl-3 mb-2">
                                    <h3>Tipo de cita</h3>
                                    <span class="tipo_cita"></span>
                                </div>
                                <div class="col-12 p-0 pl-3 mb-2 d-flex">
                                    <h3>Modalidad de pago: &nbsp;</h3>
                                    <span class="modalidad"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>
                                <label for="fecha-reasignar"></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="dia-anterior">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                    </div>
                                    <input type="date" class="form-control" id="fecha-reasignar" name="fecha-reasignar"/>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="dia-siguiente">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="disponibilidad-reasignar">Horario disponible</label>
                                    <select id="disponibilidad-reasignar" name="disponibilidad" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="id_cita-reasignar" name="id_cita"/>
                        </div>
                    </div>


                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  Cancelar cita -->
    <div class="modal fade" id="modal_cancelar_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Cancelar cita</h1>

                    <div class="modal_info_cita">
                        <div class="p-3">
                            <h2 class="nombre_paciente"></h2>
                            <p class="numero_id"></p>
                            <p class="correo"></p>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-7 p-0 pl-3 mb-2">
                                <h3 class="fecha"></h3>
                                <span class="hora"></span>
                            </div>
                            <div class="col-md-5 p-0 pl-3 mb-2">
                                <h3>Tipo de cita</h3>
                                <span class="tipo_cita"></span>
                            </div>
                            <div class="col-12 p-0 pl-3 mb-2 d-flex">
                                <h3>Modalidad de pago: &nbsp;</h3>
                                <span class="modalidad"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form action="{{ route('profesional.agenda.calendario.cancelar-cita') }}" method="post" id="form-cita-cancelar">
                        <input type="hidden" class="form-control" id="id_cita-cancelar" name="id_cita"/>
                        <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue" id="">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Completar cita -->
    <div class="modal fade" id="modal_completar_cita" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('profesional.agenda.calendario.completar-cita') }}" id="form-completar-cita">
                    <div class="modal-body">
                        <h1>Completar cita</h1>
                        <div class="modal_info_cita">
                            <div class="p-3">
                                <h2 class="nombre_paciente"></h2>
                                <p class="numero_id"></p>
                                <p class="correo"></p>
                            </div>
                            <div class="row m-0">
                                <div class="col-md-7 p-0 pl-3 mb-2">
                                    <h3 class="fecha"></h3>
                                    <span class="hora"></span>
                                </div>
                                <div class="col-md-5 p-0 pl-3 mb-2">
                                    <h3>Tipo de cita</h3>
                                    <span class="tipo_cita"></span>
                                </div>
                                <div class="col-12 p-0 pl-3 mb-2 d-flex">
                                    <h3>Modalidad de pago: &nbsp;</h3>
                                    <span class="modalidad"></span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-editar"></div>
                                <input type="hidden" id="id_cita-completar" name="id_cita"/>

                                <div class="col-12 p-0">
                                    <label for="tiempo_cita">Duración cita (minutos)</label>
                                    <input type="number" id="tiempo_cita" name="duracion_cita" required/>
                                </div>

                                <div class="col-12 p-0 pl-md-2">
                                    <label for="comentarios">Comentarios</label>
                                    <textarea name="comentarios" id="comentarios" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_green">Completar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Bloqueo del calendario -->
    <div class="modal fade" id="modal_crear_reserva_calendario" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('profesional.agenda.calendario.reservar-calendario') }}" id="form-reserva-calendario-crear">
                    <div class="modal-body">
                        <h1>Bloqueo del calendario</h1>

                        <div class="col-12 p-0" id="alerta-crear-reserva-calendario"></div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-editar"></div>
                                <input type="hidden" id="id_cita-editar" name="id_cita"/>

                                <div class="col-12 col-md-6 pl-0 pr-1">
                                    <label for="fecha_inicio">Fecha inicio</label>
                                    <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" required/>
                                </div>

                                <div class="col-12 col-md-6 pr-0 pl-1">
                                    <label for="fecha_fin">Fecha fin</label>
                                    <input type="datetime-local" id="fecha_fin" name="fecha_fin" required/>
                                </div>

                                <div class="col-12 p-0">
                                    <label for="comentarios">Comentarios</label>
                                    <textarea name="comentarios" id="comentarios" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal ver reserva -->
    <div class="modal fade" id="modal_ver_reserva" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Detalle del bloqueo</h1>

                    <div class="modal_info_cita">
                        <div class="p-3">
                            <h2 class="fecha_inicio"></h2>
                            <h2 class="fecha_fin"></h2>
                            <p class="comentario"></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" id="btn-reserva-cancelar">
                        Cancelar
                    </button>
                    <button type="submit" class="button_blue" id="btn-reserva-editar">
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Bloqueo del calendario -->
    <div class="modal fade" id="modal_editar_reserva_calendario" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('profesional.agenda.calendario.editar-reservar-calendario') }}" id="form-reserva-calendario-editar">
                    <div class="modal-body">
                        <h1>Bloqueo del calendario</h1>

                        <div class="col-12 p-0" id="alerta-crear-reserva-calendario"></div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-editar"></div>
                                <input type="hidden" id="id_reserva-editar" name="id_cita"/>

                                <div class="col-12 p-0">
                                    <label for="fecha_inicio-editar">Fecha inicio</label>
                                    <input type="datetime-local" id="fecha_inicio-editar" name="fecha_inicio" required/>
                                </div>

                                <div class="col-12 p-0">
                                    <label for="fecha_fin-editar">Fecha fin</label>
                                    <input type="datetime-local" id="fecha_fin-editar" name="fecha_fin" required/>
                                </div>

                                <div class="col-12 p-0 pl-md-2">
                                    <label for="comentarios-editar">Comentarios</label>
                                    <textarea name="comentarios" id="comentarios-editar" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal  Cancelar reserva -->
    <div class="modal fade" id="modal_cancelar_reserva_calendario" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h1>Cancelar reserva</h1>
                    <div class="modal_info_cita">
                        <div class="p-3">
                            <h2 class="fecha_inicio"></h2>
                            <h2 class="fecha_fin"></h2>
                            <p class="comentario"></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form action="{{ route('profesional.agenda.calendario.cancelar-reserva-calendario') }}" method="post" id="form-reserva-calendario-cancelar">
                        <input type="hidden" class="form-control" id="id_reserva-cancelar" name="id_cita"/>
                        <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue" id="">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Full calendar JS -->
    <script src="{{ asset('fullCalendar/main.js') }}"></script>
    <script src="{{ asset('fullCalendar/locales/es.js') }}"></script>

    <!-- Select 2 -->
    <script src="{{ asset('js/calendario-profesional.js') }}"></script>
    <script src="{{ asset('js/filtro-ubicacion.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {

            //Bloquera dia
            $('#bloquear-dia').click(function (event) {
                $('#form-reserva-calendario-crear')[0].reset();

                $('#fecha_inicio').val(moment().format('YYYY-MM-DD\THH:mm'));
                $('#fecha_fin').val(moment().add(2, 'h').format('YYYY-MM-DD\THH:mm'));

                $('#modal_crear_reserva_calendario').modal();
            })

            //Permite listar el horario disponible
            function citas_libre(date, disponibilidad) {
                $.ajax({
                    data: { date: date},
                    dataType: 'json',
                    url: '',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {

                        disponibilidad.html('<option></option>');
                        //get list
                        $.each(res.data, function (index, item) {
                            disponibilidad.append('<option value=\'{"start":"' + item.startTime + '","end": "' + item.endTime + '"}\'>' +
                                moment(item.startTime).format('hh:mm A') + '-' + moment(item.endTime).format('hh:mm A') +
                                '</option>');
                        });
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            }

            //Abrir modal para asignar cita
            $('#btn-day-clicked').click(function (e) {
                e.preventDefault();

                var btn = $(this);
                citas_libre(btn.data('date'), $('#disponibilidad'));
                var modal = $('#agregar_cita');
                modal.modal();
                $('#lugar').val($('#lugar').data('default'));

                var pais = $('#pais_id');
                pais.val(pais.data('id')).trigger('change');

                setTimeout(function () {
                    var departamento = $('#departamento_id');
                    departamento.val(departamento.data('id')).trigger('change');
                },500);
                setTimeout(function () {
                    var provincia = $('#provincia_id');
                    provincia.val(provincia.data('id')).trigger('change');
                },1000);
                setTimeout(function () {
                    var ciudad = $('#ciudad_id');
                    ciudad.val(ciudad.data('id')).trigger('change');
                },1500);


                $('#modal_dia_calendario').modal('hide');
            });

            //Crear la cita
            $('#form-agendar-cita-profesional').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                console.log(form);
                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#agregar_cita').modal('hide');
                        //resetear formulario
                        form[0].reset();
                        $('#lugar').val($('#lugar').data('default'));
                        $('#numero_id').val(null).trigger('change');

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-agregar_cita').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Buscar paciente
            $('#numero_id').select2({
                language: 'es',
                theme: 'bootstrap4',
                ajax: {
                    url: '{{ route('buscador-paciente') }}',
                    dataType: 'json',
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results:response
                        };
                    },
                    cache: true,
                },
                minimumInputLength: 3,
                dropdownParent: $('#agregar_cita')
            }).on('select2:select', function (e) {
                var data = e.params.data;

                $('#nombre').val(data.nombre);
                $('#apellido').val(data.apellido);
                $('#correo').val(data.email);

            }).on('select2:opening', function (e){

                $('#numero_id').val(null).trigger('change');
                $('#nombre').val('');
                $('#apellido').val('');
                $('#correo').val('');

            });
            //Llenar precio
            $('#tipo_cita').change(function (e) {
                $('#cantidad').val($('#tipo_cita option:selected').data('cantidad'));
            });

            //Abrir modal para editar la cita
            $('#btn-cita-editar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_cita').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_editar_cita');

                        modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') +
                            '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                        modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                        modal.find('.tipo_cita').html(res.item.tipo_cita);
                        modal.find('.modalidad').html(res.item.modalidad);
                        modal.find('.correo').html(res.item.correo);
                        modal.find('.numero_id').html(res.item.numero_id);

                        modal.find('#tipo_cita-editar').val(res.item.tipo_cita_id);
                        modal.find('#lugar-editar').val(res.item.lugar);
                        modal.find('#modalidad_pago-editar').val(res.item.modalidad);
                        modal.find('#cantidad-editar').val(res.item.cantidad);
                        modal.find('#id_cita-editar').val(res.item.id);

                        console.log(res.item);
                        var pais = $('#pais_id-editar');
                        pais.val(res.item.pais).trigger('change');

                        setTimeout(function () {
                            var departamento = $('#departamento_id-editar');
                            departamento.val(res.item.departamento).trigger('change');
                        },500);
                        setTimeout(function () {
                            var provincia = $('#provincia_id-editar');
                            provincia.val(res.item.provincia).trigger('change');
                        },1000);
                        setTimeout(function () {
                            var ciudad = $('#ciudad_id-editar');
                            ciudad.val(res.item.ciudad).trigger('change');
                        },1500);

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Guardar cita editada
            $('#form-editar-cita').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_editar_cita').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-editar').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Abrir modal para reagendar cita
            $('#btn-cita-reagendar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_cita').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_reagendar_cita');

                        modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') +
                            '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                        modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                        modal.find('.tipo_cita').html(res.item.tipo_cita);
                        modal.find('.modalidad').html(res.item.modalidad);
                        modal.find('.correo').html(res.item.correo);
                        modal.find('.numero_id').html(res.item.numero_id);

                        modal.find('#fecha-reasignar').val(moment().format('YYYY-MM-DD'));
                        modal.find('#id_cita-reasignar').val(res.item.id);

                        $('#dia-anterior').prop('disabled', true);

                        citas_libre(moment().format('YYYY-MM-DD'), $('#disponibilidad-reasignar'));

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Cambio de fecha
            $('#fecha-reasignar').change(function (e) {
                var fecha = $(this);
                var validar = moment(fecha.val()).diff(moment().format('YYYY-MM-DD'), 'days', true);

                var btn_prev = $('#dia-anterior');
                btn_prev.prop('disabled', false);

                if (validar < 0 )
                {
                    fecha.val(moment().format('YYYY-MM-DD'));
                    btn_prev.prop('disabled', true);
                }

                citas_libre(fecha.val(), $('#disponibilidad-reasignar'));
            });

            //Día anterior botón
            $('#dia-anterior').click(function (e) {
                var btn = $(this);

                var fecha = $('#fecha-reasignar');

                btn.prop('disabled', false);

                fecha.val(moment(fecha.val()).add(-1, 'day').format('YYYY-MM-DD'));

                var validar = moment(fecha.val()).diff(moment().format('YYYY-MM-DD'), 'days', true);

                if ( validar <= 0 )
                {
                    btn.prop('disabled', true);
                }

                citas_libre(fecha.val(), $('#disponibilidad-reasignar'));
            });

            //Día siguiente botón
            $('#dia-siguiente').click(function (e) {
                var btn = $(this);

                var fecha = $('#fecha-reasignar');

                $('#dia-anterior').prop('disabled', false);

                fecha.val(moment(fecha.val()).add(1, 'day').format('YYYY-MM-DD'));

                citas_libre(fecha.val(), $('#disponibilidad-reasignar'));
            });

            //Guardar cita reagendada
            $('#form-cita-reagendar').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_reagendar_cita').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-reasignar').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Abrir modal para cancelar la cita
            $('#btn-cita-cancelar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_cita').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_cancelar_cita');

                        modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') +
                            '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                        modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                        modal.find('.tipo_cita').html(res.item.tipo_cita);
                        modal.find('.modalidad').html(res.item.modalidad);
                        modal.find('.correo').html(res.item.correo);
                        modal.find('.numero_id').html(res.item.numero_id);

                        modal.find('#id_cita-cancelar').val(res.item.id);

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Aceptar cita cancelada
            $('#form-cita-cancelar').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_cancelar_cita').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-general').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Abrir modal para completada la cita
            $('#btn-cita-completar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_cita').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_completar_cita');

                        modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') +
                            '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                        modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                        modal.find('.tipo_cita').html(res.item.tipo_cita);
                        modal.find('.modalidad').html(res.item.modalidad);
                        modal.find('.correo').html(res.item.correo);
                        modal.find('.numero_id').html(res.item.numero_id);

                        modal.find('#id_cita-completar').val(res.item.id);

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Guardar cita completada
            $('#form-completar-cita').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_completar_cita').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-editar').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Crear reserva del calendario
            $('#form-reserva-calendario-crear').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                console.log(form);
                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_crear_reserva_calendario').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-crear-reserva-calendario').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Abrir modal para completada la cita
            $('#btn-reserva-editar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_reserva').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_editar_reserva_calendario');

                        modal.find('.fecha_inicio').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.fecha_fin').html(moment(res.item.fecha_fin).format('dddd, D MMMM/YYYY'));
                        modal.find('.comentario').html(res.item.comentario);

                        modal.find('#id_reserva-editar').val(res.item.id);
                        modal.find('#fecha_inicio-editar').val(moment(res.item.fecha_inicio).format('YYYY-MM-DDTHH:mm'));
                        modal.find('#fecha_fin-editar').val(moment(res.item.fecha_fin).format('YYYY-MM-DDTHH:mm'));
                        modal.find('#comentario-editar').val(res.item.comentario);

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Crear reserva del calendario
            $('#form-reserva-calendario-editar').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                console.log(form);
                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_editar_reserva_calendario').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-crear-reserva-calendario').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });

            //Abrir modal para cancelar la reserva de calendario
            $('#btn-reserva-cancelar').click(function (e) {
                var btn = $(this);
                $('#modal_ver_reserva').modal('hide');

                $.ajax({
                    data: { id: btn.data('id') },
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        var modal = $('#modal_cancelar_reserva_calendario');

                        modal.find('.fecha_inicio').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                        modal.find('.fecha_fin').html(moment(res.item.fecha_fin).format('dddd, D MMMM/YYYY'));
                        modal.find('.comentario').html(res.item.comentario);

                        modal.find('#id_reserva-cancelar').val(res.item.id);

                        modal.modal();
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alerta-general').html(alert(response.message, 'danger'));
                    }
                });
            });

            //Aceptar cita reserva de calendario
            $('#form-reserva-calendario-cancelar').submit(function (e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res, status) {

                        $('#alerta-general').html(alert(res.message, 'success'));

                        $('#modal_cancelar_reserva_calendario').modal('hide');
                        //resetear formulario
                        form[0].reset();

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    },
                    error: function (res, status) {

                        var response = res.responseJSON;

                        $('#alerta-general').html(alert(response.message, 'danger'));

                        setTimeout(function () {
                            calendar.refetchEvents();
                        },3000);
                    }
                });
            });
        });
    </script>
@endsection
