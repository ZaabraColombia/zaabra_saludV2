@extends('profesionales.admin.layouts.panel')

@section('styles')
    <!-- FullCalendar -->
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">

    <!-- datepicker bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}">

    <style>
        .fc-non-business, .fc-day-past{
            background: rgba(216, 216, 216, 0.5) !important;
        }
        /*.fc-day-past:has(:nth-child(.fc-non-business)){
            background: rgba(216, 216, 216, 0.5) !important;
        }*/
    </style>
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
                        <h2 class="blue_bold fs_title_module">Días</h2>
                        <div class="col-md-4 col-xl-12 p-0">
                            <p>
                                <span style="color: #FFFFFF;" class="colors mr-2"><i class="fas fa-square fa-2x"></i></span>
                                Días disponibles
                            </p>
                        </div>

                        <div class="col-md-4 col-xl-12 p-0 mb-1">
                            <p>
                                <span style="color: #D8D8D8;" class="colors mr-2"><i class="fas fa-square fa-2x"></i></span>
                                Días no disponibles
                            </p>
                        </div>

                        <h2 class="blue_bold fs_title_module">Eventos</h2>

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
                     data-daysBlock='{!! json_encode($dias_bloqueados) !!}'
                     data-daysLimit='{{ $horario->dias_agenda }}'
                     data-daysFree='{{ route('profesional.agenda.calendario.dias-libre') }}'></div>
            </div>
        </div>

    </section>

    <!-- Modal Día calendario -->
    <div class="modal fade" id="modal_dia_calendario" tabindex="-1" data-backdrop="static" data-keyboard="false">
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

    <!-- Modal  Agendar cita -->
    <div class="modal fade" id="modal_agregar_cita" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{ route('profesional.agenda.calendario.crear-cita') }}"
                          id="form-agendar-cita" class="forms-calendario" data-modal="#modal_agregar_cita"
                          data-alerta="#alerta-agregar_cita">
                        <h1>Agendar cita</h1>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0 alertas" id="alerta-agregar_cita"></div>

                                <div class="col-12 my-2">
                                    <h2 style="border-bottom: 2px solid #7fadcb; color: #0083D6"> Paciente</h2>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="numero_id">Número de identificación</label>
                                    <select type="text" id="numero_id" name="numero_id" data-url="{{ route('buscador-paciente') }}" required></select>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" id="nombre" name="nombre" readonly/>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" id="apellido" name="apellido" readonly/>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="correo">Correo</label>
                                    <input type="email" id="correo" name="correo" readonly/>
                                </div>

                                <div class="col-12 my-2">
                                    <h2 style="border-bottom: 2px solid #7fadcb; color: #0083D6"> Servicio</h2>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="servicio">Servicios</label>
                                    <select id="servicio" name="servicio" class="servicio" required
                                            data-convenios="#convenio" data-disponibilidad="#disponibilidad">
                                        <option></option>
                                        @if($servicios->isNotEmpty())
                                            @foreach($servicios as $servicio)
                                                <option value="{{ $servicio->id }}" data-cantidad="{{ $servicio->valor }}"
                                                        data-url="{{ route('profesional.agenda.calendario.convenios', ['servicio' => $servicio->id]) }}">
                                                    {{ $servicio->nombre }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="convenios">Convenio</label>
                                    <div class="input-group select_input_group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" class="checkbox-activar-convenios"
                                                       id="activar-convenios" name="activar-convenios" value="1">
                                            </div>
                                        </div>
                                        <select class="custom-select convenio" id="convenio" name="convenio"></select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="fecha">Fecha</label>
                                    <input type="text" id="fecha" name="fecha" data-disponibilidad="#disponibilidad"
                                           class="fecha-disponible fecha form-control" readonly/>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="disponibilidad">Horario disponible</label>
                                    <select id="disponibilidad" name="disponibilidad" required
                                            data-fecha="#fecha" data-servicio="#servicio"></select>
                                </div>

                                <div class="col-12 my-2">
                                    <h2 style="border-bottom: 2px solid #7fadcb; color: #0083D6"> Lugar</h2>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">     <!--menu dinamico ciudades -->
                                    <label for="pais_id">País</label>
                                    <select class="select2 pais" name="pais_id" id="pais_id" data-modal="#modal_agregar_cita"
                                            data-id="{{ $user->profesional->idpais }}" data-departamento="#departamento_id"
                                            data-provincia="#provincia_id" data-ciudad="#ciudad_id">
                                        @if($paises->isNotEmpty())
                                            @foreach($paises as $pais)
                                                <option value="{{ $pais->id_pais }}">{{ $pais->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="departamento_id">Departamento</label>
                                    <select name="departamento_id" class="select2 departamento" id="departamento_id"
                                            data-modal="#modal_agregar_cita" data-provincia="#provincia_id" data-ciudad="#ciudad_id"
                                            data-id="{{ $user->profesional->id_departamento }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="provincia_id" >Provincia</label>
                                    <select name="provincia_id" class="select2 provincia" id="provincia_id"
                                            data-modal="#modal_agregar_cita" data-ciudad="#ciudad_id"
                                            data-id="{{ $user->profesional->id_provincia }}"></select>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">
                                    <label for="ciudad_id">Ciudad</label>
                                    <select name="ciudad_id" class="select2" id="ciudad_id" data-modal="#modal_agregar_cita"
                                            data-id="{{ $user->profesional->id_municipio }}"></select>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="lugar">Lugar de cita</label>
                                    <input type="text" id="lugar" name="lugar" required
                                           value="{{ $user->profesional->direccion }}"
                                           data-default="{{ $user->profesional->direccion }}" />
                                </div>

                                <div class="col-12 my-2">
                                    <h2 style="border-bottom: 2px solid #7fadcb; color: #0083D6"> Pago</h2>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="cantidad">Pago</label>
                                    <input type="text" id="cantidad" name="cantidad" required class="valor"/>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="modalidad_pago">Modalidad de pago</label>
                                    <select id="modalidad_pago" name="modalidad_pago" required>
                                        <option value="virtual">Virtual</option>
                                        <option value="presencial">Presencial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent"
                            id="cancelar-cita-btn-profesional" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button class="button_blue" onclick="$('#form-agendar-cita').trigger('submit')">Agendar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Detalle cita -->
    <div class="modal fade" id="modal_ver_cita" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
                        <div class="py-3">
                            <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                            <p class="numero_id">C.C. 80645987</p>
                            <p class="correo">marco@hotmail.com</p>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 p-0 mb-2">
                                <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                <span class="hora">08:00 A.M - 08:45 A.M</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Tipo de servicio: &nbsp;</h3>
                                <span class="tipo_servicio">Procedimiento no quirurgico</span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Servicio: &nbsp;</h3>
                                <span class="servicio_text">Procedimiento no quirurgico Procedimiento no</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-flex p-0 mb-2">
                                <h3>Tipo de atención: &nbsp;</h3>
                                <span class="atencion">Presencial</span>
                            </div>
                            <div class="col-md-9 p-0 mb-2">
                                <h3>Lugar: &nbsp;</h3>
                                <span class="lugar">EPS Salud Total virrey Solis Olaya</span>
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
                    {{--
                    <button type="submit" class="button_blue" id="btn-cita-editar">
                        Editar
                    </button>
                    --}}
                    <button type="submit" class="button_blue" id="btn-cita-completar">
                        Completar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal editar cita --}}
    {{--
<div class="modal fade " id="modal_editar_cita" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content modal_container">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1>Editar cita</h1>

                <div class="modal_info_cita">
                    <div class="py-3">
                        <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                        <p class="numero_id">C.C. 80645987</p>
                        <p class="correo">marco@hotmail.com</p>
                    </div>

                    <div class="row m-0">
                        <div class="col-12 p-0 mb-2">
                            <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                            <span class="hora">08:00 A.M - 08:45 A.M</span>
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col-12 d-md-flex p-0 mb-2">
                            <h3>Tipo de servicio: &nbsp;</h3>
                            <span class="tipo_servicio">Procedimiento no quirurgico</span>
                        </div>
                        <div class="col-12 d-md-flex p-0 mb-2">
                            <h3>Servicio: &nbsp;</h3>
                            <span class="servicio_text">Procedimiento no quirurgico Procedimiento no</span>
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col-12 d-flex p-0 mb-2">
                            <h3>Tipo de atención: &nbsp;</h3>
                            <span class="atencion">Presencial</span>
                        </div>
                        <div class="col-md-9 p-0 mb-2">
                            <h3>Lugar: &nbsp;</h3>
                            <span class="lugar">EPS Salud Total virrey Solis Olaya</span>
                        </div>
                    </div>
                </div>

                <form method="POST" id="form-editar-cita" class="forms-calendario" data-modal="#modal_agregar_cita"
                      data-alerta="#alerta-agregar_cita">
                    <div class="form_modal">
                        <div class="row m-0">
                            <div class="col-12 p-0" id="alerta-editar"></div>

                            <div class="col-12 mb-3">
                                <h2 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;">
                                    Servicio</h2>
                            </div>

                            <div class="col-12 p-0">
                                <label for="servicio-editar">Servicio</label>
                                <select id="servicio-editar" name="servicio" class="servicio" required
                                        data-convenios="#convenio-editar">
                                    <option></option>
                                    @if($servicios->isNotEmpty())
                                    @foreach($servicios as $servicio)
                                    <option value="{{ $servicio->id }}" data-cantidad="{{ $servicio->valor }}"
                                            data-url="{{ route('profesional.agenda.calendario.convenios', ['servicio' => $servicio->id]) }}">
                                        {{ $servicio->nombre }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="convenios">Convenio</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="checkbox-activar-convenios"
                                                   id="activar-convenios-editar" name="activar-convenios" value="1">
                                        </div>
                                    </div>
                                    <select class="custom-select convenio" id="convenio-editar"
                                            name="convenio"></select>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <h2 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;"> Lugar</h2>
                            </div>

                            <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                <label for="pais_id-editar">País</label>
                                <select class="select2 pais" name="pais_id" id="pais_id-editar"
                                        data-modal="#modal_editar_cita"
                                        data-departamento="#departamento_id-editar"
                                        data-provincia="#provincia_id-editar"
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

                            <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                <label for="provincia_id-editar">Provincia</label>
                                <select name="provincia_id" class="select2 provincia" id="provincia_id-editar"
                                        data-modal="#modal_editar_cita" data-ciudad="#ciudad_id-editar"
                                        data-id="{{ $user->profesional->id_provincia }}"></select>
                            </div>

                            <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                <label for="ciudad_id-editar">Ciudad</label>
                                <select name="ciudad_id" class="select2" id="ciudad_id-editar"
                                        data-modal="#modal_editar_cita"
                                        data-id="{{ $user->profesional->id_municipio }}"></select>
                            </div>

                            <div class="col-12 p-0">
                                <label for="lugar-editar">Lugar de cita</label>
                                <input type="text" id="lugar-editar" name="lugar" required/>
                            </div>

                            <div class="col-12 mb-3">
                                <h2 class="fs_subtitle blue_light" style="border-bottom: 2px solid #7fadcb;"> Pago</h2>
                            </div>

                            <div class="col-md-6 p-0 pr-md-2">
                                <label for="modalidad_pago-editar">Modalidad de pago</label>
                                <select id="modalidad_pago-editar" name="modalidad_pago" required>
                                    <option></option>
                                    <option value="virtual">Virtual</option>
                                    <option value="presencial">Presencial</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                <label for="cantidad-editar">Pago</label>
                                <input type="text" id="cantidad-editar" name="cantidad" required class="valor"/>
                            </div>
                            <div class="col-12 col-lg-6 p-0 pr-lg-2">
                                <label for="cantidad_convenio-editar">Pago convenio</label>
                                <input type="text" id="cantidad_convenio-editar" name="cantidad_convenio"
                                       required class="valor"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer content_btn_center">
                <button type="button" class="button_transparent" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" class="button_blue" onclick="$('#form-editar-cita').trigger('submit')">Guardar
                </button>
            </div>
        </div>
    </div>
</div>--}}

    <!-- Modal  reagendar cita -->
    <div class="modal fade" id="modal_reagendar_cita" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="form-cita-reagendar" class="forms-calendario" data-modal="#modal_reagendar_cita"
                      data-alerta="#alerta-reasignar">
                    <div class="modal-body">
                        <h1>Reagendar cita</h1>

                        <div class="modal_info_cita mb-3">
                            <div class="py-3">
                                <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                                <p class="numero_id">C.C. 80645987</p>
                                <p class="correo">marco@hotmail.com</p>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 p-0 mb-2">
                                    <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                    <span class="hora">08:00 A.M - 08:45 A.M</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Tipo de servicio: &nbsp;</h3>
                                    <span class="tipo_servicio">Procedimiento no quirurgico</span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Servicio: &nbsp;</h3>
                                    <span class="servicio_text">Procedimiento no quirurgico Procedimiento no</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-flex p-0 mb-2">
                                    <h3>Tipo de atención: &nbsp;</h3>
                                    <span class="atencion">Presencial</span>
                                </div>
                                <div class="col-md-9 p-0 mb-2">
                                    <h3>Lugar: &nbsp;</h3>
                                    <span class="lugar">EPS Salud Total virrey Solis Olaya</span>
                                </div>
                            </div>
                        </div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-reasignar"></div>
                                <input type="hidden" name="servicio" id="servicio-reasignar">
                                <div class="col-12 p-0">
                                    <label for="fecha-reasignar"></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control fecha-disponible fecha" id="fecha-reasignar"
                                               name="fecha-reasignar" readonly data-disponibilidad="#disponibilidad-reasignar"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="disponibilidad-reasignar">Horario disponible</label>
                                    <select id="disponibilidad-reasignar" name="disponibilidad" required data-fecha="#fecha-reasignar"
                                            data-servicio="#servicio-reasignar">
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
                        <div class="py-3">
                            <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                            <p class="numero_id">C.C. 80645987</p>
                            <p class="correo">marco@hotmail.com</p>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 p-0 mb-2">
                                <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                <span class="hora">08:00 A.M - 08:45 A.M</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Tipo de servicio: &nbsp;</h3>
                                <span class="tipo_servicio">Procedimiento no quirurgico</span>
                            </div>
                            <div class="col-12 d-md-flex p-0 mb-2">
                                <h3>Servicio: &nbsp;</h3>
                                <span class="servicio_text">Procedimiento no quirurgico Procedimiento no</span>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-12 d-flex p-0 mb-2">
                                <h3>Tipo de atención: &nbsp;</h3>
                                <span class="atencion">Presencial</span>
                            </div>
                            <div class="col-md-9 p-0 mb-2">
                                <h3>Lugar: &nbsp;</h3>
                                <span class="lugar">EPS Salud Total virrey Solis Olaya</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form method="post" id="form-cita-cancelar" class="forms-calendario" data-modal="#modal_cancelar_cita"
                          data-alerta="#alerta-reasignar">
                        <button type="button" class="button_transparent" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button_blue" id="">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Completar cita -->
    <div class="modal fade" id="modal_completar_cita" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-completar-cita" class="forms-calendario" data-modal="#modal_completar_cita"
                      data-alerta="#aleta-completar-cita">
                    <div class="modal-body">
                        <h1>Completar cita</h1>
                        <div class="modal_info_cita">
                            <div class="py-3">
                                <h2 class="nombre_paciente">Marco Antonio Garzon Sepulveda</h2>
                                <p class="numero_id">C.C. 80645987</p>
                                <p class="correo">marco@hotmail.com</p>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 p-0 mb-2">
                                    <h3 class="fecha">miércoles, 27 septiembre 2022</h3>
                                    <span class="hora">08:00 A.M - 08:45 A.M</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Tipo de servicio: &nbsp;</h3>
                                    <span class="tipo_servicio">Procedimiento no quirurgico</span>
                                </div>
                                <div class="col-12 d-md-flex p-0 mb-2">
                                    <h3>Servicio: &nbsp;</h3>
                                    <span class="servicio_text">Procedimiento no quirurgico Procedimiento no</span>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 d-flex p-0 mb-2">
                                    <h3>Tipo de atención: &nbsp;</h3>
                                    <span class="atencion">Presencial</span>
                                </div>
                                <div class="col-md-9 p-0 mb-2">
                                    <h3>Lugar: &nbsp;</h3>
                                    <span class="lugar">EPS Salud Total virrey Solis Olaya</span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="form_modal">
                            <div class="row">
                                <div class="col-12" id="aleta-completar-cita"></div>
                            </div>
                            <div class="row m-0">
                                <label class="font_roboto fs_text_small black_light mb-0" for="">Duración de la cita:</label>
                                <div class="main">
                                    <div class="circle">
                                        <div id="stopwatch" class="stopwatch black_strong fs_title">00:00</div>
                                        <button id="play-pause" class="paused finalizar" type="button" onclick="playPause()">
                                            <span id="texto">Iniciar</span>
                                        </button>
                                    </div>
                                    <div id="seconds-sphere" class="seconds-sphere"></div>
                                    <input type="hidden" name="segundos" id="segundos">
                                </div>

                                <div class="col-12 p-0 input__box">
                                    <label class="font_roboto fs_text_small black_light mb-2" for="comentario">Observaciones</label>
                                    <textarea name="comentario" id="comentario" cols="35" rows="5" class="comentario"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer content_btn_center">
                        <button type="button" class="button_transparent" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="button_blue">Completar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Bloqueo del calendario -->
    <div class="modal fade" id="modal_crear_reserva_calendario" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('profesional.agenda.calendario.reservar-calendario') }}"
                      id="form-reserva-calendario-crear"  class="forms-calendario" data-modal="#modal_crear_reserva_calendario"
                      data-alerta="#alerta-crear-reserva-calendario">
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

    <!-- Modal detalle del bloqueo -->
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
                            <h2>Fecha Inicio: <span class="fecha_inicio"></span></h2>
                            <h2>Fecha Fin: <span class="fecha_fin"></span></h2>
                            <div class="col-12 p-0 mt-3 form_modal">
                                <label for="comentario">Comentarios</label>
                                <textarea class="comentario" name="comentario" id="" readonly rows="5"></textarea>
                            </div>
                            <!-- <p class="comentario"></p> -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" id="btn-reserva-cancelar">
                        Desbloquear
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
                <form method="post" id="form-reserva-calendario-editar" class="forms-calendario" data-modal="#modal_editar_reserva_calendario"
                      data-alerta="#alerta-editar-reserva-calendario">
                    <div class="modal-body">
                        <h1>Bloqueo del calendario</h1>

                        <div class="col-12 p-0" id="alerta-editar-reserva-calendario"></div>

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

                                <div class="col-12 p-0">
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
                    <h1>Desbloquear</h1>
                    <div class="modal_info_cita">
                        <div class="p-3">
                            <h2>Fecha Inicio: <span class="fecha_inicio"></span></h2>
                            <h2>Fecha Fin: <span class="fecha_fin"></span></h2>
                            <div class="col-12 p-0 mt-3 form_modal">
                                <label for="comentario">Comentarios</label>
                                <textarea class="comentario" name="comentario" id="" readonly rows="5"></textarea>
                            </div>
                            <!-- <p class="comentario"></p> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="alerta-cancelar-bloqueo"></div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <form method="post" id="form-reserva-calendario-cancelar"  class="forms-calendario"
                          data-modal="#modal_cancelar_reserva_calendario" data-alerta="#alerta-cancelar-bloqueo">
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
    <script src="{{ asset('js/ubicacion.js') }}"></script>

    <!-- datepicker bootstrap -->
    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
@endsection
