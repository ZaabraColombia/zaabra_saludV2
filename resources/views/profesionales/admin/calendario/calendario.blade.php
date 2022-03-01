@extends('profesionales.admin.layouts.panel')

@section('styles')
    <!--Framewor Agenda-->
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
@endsection

@section('contenido')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 p-0">
                <div class="section_cabecera_citas">
                    <div>
                        <h1 class="title_miCita">Mi Calendario</h1>
                        <span class="subtitle_miCita">Administre su calendario de citas</span>
                    </div>
                </div>

                <div class="row m-0 pb-4">
                    <a href="{{route('profesional.configurar-calendario')}}" class="button_blue_form mr-3">
                        <i class="fas fa-cogs pr-2"></i>Configuración de cita
                    </a>

                    <button id="upload-calendar" class="button_blue_form"><i class="fas fa-sync-alt pr-2"></i>actualizar</button>
                </div>

                <div class="contains_option_days">
                    <h2 class="dias no_disponible"><i></i> Días no disponibles</h2>
                    <h2 class="dias"><i></i> Días disponibles</h2>
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_dia_calendario">
                    Día del calendario
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_opcion_cita">
                    Opciones de la cita
                </button>
            </div>
            <div class="col-12 col-lg-9 p-0">
                <div id="calendar"></div>
            </div>
        </div>

    </section>


    <!-- Modal  programa día calendario -->
    <div class="modal fade" id="modal_dia_calendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" target="_blank">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal-title date_calendar" id="exampleModalLabel">
                        <span>Martes 01</span>
                        <span>Marzo 2022</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_blue" id="btn-day-clicked" data-date=""
                            data-toggle="modal" data-target="#agregar_cita" formtarget="_blank">Agendar cita
                    </button>
                    <button type="button" class="modal_btn_blue" id="btn-day-see" data-date=""
                            data-toggle="modal" data-target="#modal_ver_cita" formtarget="_blank">Ver cita
                    </button>
{{--                    <button type="submit" class="modal_btn_blue" id=""--}}
{{--                            data-toggle="modal" data-target="#modalPagoEspera" formtarget="_blank">Horario disponible--}}
{{--                    </button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  ver cita -->
    <div class="modal fade" id="modal_ver_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Cita <label id="especialidad-profesional"></label></h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h2 class="mb-3" id="nombre_paciente-profesional">Laura León</h2>
                    <div class="mb-2">
                        <h3 id="fecha-profesional" >Jueves, 12 de mayo</h3>
                        <span id="hora-profesional">10:47 - 11:47 a.m</span>
                    </div>
                    <div class="mb-2">
                        <h3>Tipo de cita</h3>
                        <span id="tipo_cita-profesional">Presencial</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_blue" id="editar-cita-btn-profesional" data-id>
                        Editar cita
                    </button>
                    <button type="button" class="modal_btn_transparent" id="cancelar-cita-btn-profesional">
                        Cancelar cita
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  agendar cita -->
    <div class="modal fade" id="agregar_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Agendar cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="" id="form-agendar-cita-profesional">
                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0">
                                    <label for="number_id">Número de identificación</label>
                                    <input type="text" id="number_id" name="number_id">
                                </div>
                                <div class="col-12 p-0">
                                    <label for="name">Nombres</label>
                                    <input type="text" id="name" name="name">
                                </div>
                                <div class="col-12 p-0">
                                    <label for="last_name">Apellidos</label>
                                    <input type="text" id="last_name" name="last_name">
                                </div>
                                <div class="col-12 p-0">
                                    <label for="email">Correo</label>
                                    <input type="email" id="email" name="email">
                                </div>
                                <div class="col-12 p-0">
                                    <label for="appoiment_type">Tipo de cita</label>
                                    <select id="appoiment_type" name="appoiment_type">
                                        <option ></option>
                                        <option value="Virtual">Virtual</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="available_time">Horario disponible</label>
                                    <select id="available_time" name="available_time">
                                        <option ></option>
                                        <option value="Mañana">08:00 - 12:00</option>
                                        <option value="Tarde">12:00 - 18:00</option>
                                        <option value="Noche">18:00 - 20:00</option>
                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="appoiment_place">Lugar de cita</label>
                                    <input type="text" id="appoiment_place" name="appoiment_place">
                                </div>
                                <div class="col-md-6 p-0 pr-2">
                                    <label for="pay">Pago</label>
                                    <input type="text" id="pay" name="pay">
                                </div>
                                <div class="col-md-6 p-0 pl-2">
                                    <label for="pay_type">Modalidad de pago</label>
                                    <select id="pay_type" name="pay_type">
                                        <option ></option>
                                        <option value="Virtual">Virtual</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_transparent px-4" id="cancelar-cita-btn-profesional">Cancelar</button>
                    <button type="submit" class="modal_btn_blue px-4" id="">Agendar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  opciones de la cita -->
    <div class="modal fade" id="modal_opcion_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" target="_blank">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal-title date_calendar">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_transparent" id=""
                            data-toggle="modal" data-target="#cancelar_cita" formtarget="_blank">
                        Cancelar cita
                    </button>
                    <button type="submit" class="modal_btn_blue" id=""
                            data-toggle="modal" data-target="#reagendar_cita" formtarget="_blank">
                        Reagendar cita
                    </button>
                    <button type="submit" class="modal_btn_blue" id=""
                            data-toggle="modal" data-target="#editar_cita" formtarget="_blank">
                        Editar cita
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  editar cita -->
    <div class="modal fade" id="editar_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Editar cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal_info_cita mb-3">
                        <div class="p-3">
                            <h2 id="nombre_paciente-profesional">Laura León</h2>
                            <p>Cc 1033457845</p>
                            <p>laural@hotmail.com</p>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-7 p-0 pl-3 mb-2">
                                <h3 id="fecha-profesional" >Jueves, 12 de mayo</h3>
                                <span id="hora-profesional">10:47 - 11:47 a.m</span>
                            </div>
                            <div class="col-md-5 p-0 mb-2 text-center">
                                <h3>Tipo de cita</h3>
                                <span id="tipo_cita-profesional">Presencial</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="" id="form-agendar-cita-profesional">
                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0">
                                    <label for="appoiment_type">Tipo de cita</label>
                                    <select id="appoiment_type" name="appoiment_type">
                                        <option ></option>
                                        <option value="Virtual">Virtual</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="appoiment_place">Lugar de cita</label>
                                    <input type="text" id="appoiment_place" name="appoiment_place">
                                </div>
                                <div class="col-md-6 p-0 pr-2">
                                    <label for="pay_type">Modalidad de pago</label>
                                    <select id="pay_type" name="pay_type">
                                        <option ></option>
                                        <option value="Virtual">Virtual</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-md-6 p-0 pl-2">
                                    <label for="pay">Pago</label>
                                    <input type="text" id="pay" name="pay">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_transparent px-4" id="cancelar-cita-btn-profesional">Cancelar</button>
                    <button type="submit" class="modal_btn_blue px-4" id="">Agendar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  reagendar cita -->
    <div class="modal fade" id="reagendar_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Reagendar cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal_info_cita mb-3">
                        <div class="p-3">
                            <h2 id="nombre_paciente-profesional">Laura León</h2>
                            <p>Cc 1033457845</p>
                            <p>laural@hotmail.com</p>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-7 p-0 pl-3 mb-2">
                                <h3 id="fecha-profesional" >Jueves, 12 de mayo</h3>
                                <span id="hora-profesional">10:47 - 11:47 a.m</span>
                            </div>
                            <div class="col-md-5 p-0 mb-2 text-center">
                                <h3>Tipo de cita</h3>
                                <span id="tipo_cita-profesional">Presencial</span>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="" id="form-agendar-cita-profesional">
                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="available_time">Horario disponible</label>
                                    <select id="available_time" name="available_time">
                                        <option ></option>
                                        <option value="Mañana">08:00 - 12:00</option>
                                        <option value="Tarde">12:00 - 18:00</option>
                                        <option value="Noche">18:00 - 20:00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_transparent px-4" id="cancelar-cita-btn-profesional">Cancelar</button>
                    <button type="submit" class="modal_btn_blue px-4" id="">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Cancelar cita -->
    <div class="modal fade" id="cancelar_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Cancelar cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal_info_cita mb-3">
                        <div class="p-3">
                            <h2 id="nombre_paciente-profesional">Laura León</h2>
                            <p>Cc 1033457845</p>
                            <p>laural@hotmail.com</p>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-7 p-0 pl-3 mb-2">
                                <h3 id="fecha-profesional" >Jueves, 12 de mayo</h3>
                                <span id="hora-profesional">10:47 - 11:47 a.m</span>
                            </div>
                            <div class="col-md-5 p-0 mb-2 text-center">
                                <h3>Tipo de cita</h3>
                                <span id="tipo_cita-profesional">Presencial</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_transparent px-4" id="cancelar-cita-btn-profesional">Cancelar</button>
                    <button type="submit" class="modal_btn_blue px-4" id="">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <!-- Full calendar JS -->
    <script src="{{ asset('fullCalendar/main.js') }}"></script>
    <script src="{{ asset('fullCalendar/locales/es.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            //Iniciar data
            var weekNotBusiness = '{!! json_encode($weekNotBusiness) !!}';

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                businessHours: {!! json_encode($horario->horario) !!},
                //events: '',
                // Botones de mes, semana y día.
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // Propiedad para cambio de lenguaje
                locale: 'es',
                // Evento de mensaje de alerta
                dateClick: function (event) {
                    var today = moment();

                    var day = moment(event.date);

                    if (weekNotBusiness.includes(event.date.getDay()))
                    {

                        if (today.startOf('day').diff(day.startOf('day'), 'days') <= 0)
                        {
                            if (event.view.type === "dayGridMonth") {
                                $('#btn-day-clicked').data("date", event.dateStr);
                                $('#btn-day-see').data("date", event.dateStr);

                                $('#modal_dia_calendario').modal();
                            }
                        } else {
                            calendar.changeView('timeGridDay', event.dateStr);
                        }

                    } else {
                        alert('');
                    }
                },
                selectable: false,
                editable: false,
                //
                eventClick: function(info) {
                },
                //
                select: function(info) {
                },
                //
                dayCellDidMount: function (date) {
                }
            });
            calendar.render();
        });
    </script>
@endsection
