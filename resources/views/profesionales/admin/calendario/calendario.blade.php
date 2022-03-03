@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
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
                    {{--                    <a href="{{route('profesional.configurar-calendario')}}" class="button_blue_form mr-3">--}}
                    {{--                        <i class="fas fa-cogs pr-2"></i>Configuración de cita--}}
                    {{--                    </a>--}}

                    <button id="actualizar-calendar" class="button_blue_form"><i class="fas fa-sync-alt pr-2"></i>Actualizar</button>
                </div>

                <div class="contains_option_days">
                    <h2 class="dias no_disponible"><i></i> Días no disponibles</h2>
                    <h2 class="dias"><i></i> Días disponibles</h2>
                </div>

                {{--                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_dia_calendario">--}}
                {{--                    Día del calendario--}}
                {{--                </button>--}}
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_opcion_cita">
                    Opciones de la cita
                </button>
            </div>
            <div class="col-12 col-lg-9 p-0" id="alerta-general"></div>
            <div class="col-12 col-lg-9 p-0">
                <div id="calendar"></div>
            </div>
        </div>

    </section>

    <!-- Modal día calendario -->
    <div class="modal fade" id="modal_dia_calendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" target="_blank">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal-title date_calendar">
                        <span id="span-day-clicked"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal_btn_blue" id="btn-day-clicked">Agendar cita</button>
                    <button type="button" class="modal_btn_blue" id="btn-day-see">Ver citas</button>
                    {{--                    <button type="submit" class="modal_btn_blue" id=""--}}
                    {{--                            data-toggle="modal" data-target="#modalPagoEspera" formtarget="_blank">Horario disponible--}}
                    {{--                    </button>--}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ver cita -->
    <div class="modal fade" id="modal_ver_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h2 class="mb-3 nombre_paciente"></h2>
                    <div class="mb-2">
                        <h3 class="fecha"></h3>
                        <span class="hora"></span>
                    </div>
                    <div class="mb-2">
                        <h3>Tipo de cita</h3>
                        <span class="tipo_cita"></span>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="modal_btn_transparent" id="btn-cita-cancelar"
                            data-toggle="modal" data-target="#cancelar_cita" formtarget="_blank">
                        Cancelar cita
                    </button>
                    <button type="submit" class="modal_btn_blue" id="btn-cita-reagendar"
                            data-toggle="modal" data-target="#reagendar_cita" formtarget="_blank">
                        Reagendar cita
                    </button>
                    <button type="submit" class="modal_btn_blue" id="btn-cita-editar"
                            data-toggle="modal" data-target="#editar_cita" formtarget="_blank">
                        Editar cita
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal  agendar cita -->
    <div class="modal fade" id="agregar_cita" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <h1>Agendar cita</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('profesional.calendario.crear-cita') }}" id="form-agendar-cita-profesional">
                    <div class="modal-body">

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-agregar_cita"></div>
                                <div class="col-12 p-0">
                                    <label for="numero_id">Número de identificación</label>
                                    <select type="text" id="numero_id" name="numero_id" required>
                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" id="nombre" name="nombre" readonly/>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" id="apellido" name="apellido" readonly/>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="correo">Correo</label>
                                    <input type="email" id="correo" name="correo" readonly/>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="tipo_cita">Tipo de cita</label>
                                    <select id="tipo_cita" name="tipo_cita" required>
                                        <option ></option>
                                        @if($tipoCitas->isNotEmpty())
                                            @foreach($tipoCitas as $cita)
                                                <option value="{{ $cita->id }}" data-cantidad="{{ $cita->valorconsulta }}">{{ $cita->nombreconsulta }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="disponibilidad">Horario disponible</label>
                                    <select id="disponibilidad" name="disponibilidad" required></select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="lugar">Lugar de cita</label>
                                    <input type="text" id="lugar" name="lugar" required
                                           value="{{ $user->profecional->direccion }}"
                                           data-default="{{ $user->profecional->direccion }}" />
                                </div>
                                <div class="col-md-6 p-0 pr-2">
                                    <label for="cantidad">Pago</label>
                                    <input type="text" id="cantidad" name="cantidad" required/>
                                </div>
                                <div class="col-md-6 p-0 pl-2">
                                    <label for="modalidad_pago">Modalidad de pago</label>
                                    <select id="modalidad_pago" name="modalidad_pago" required>
                                        <option></option>
                                        <option value="Virtual">Virtual</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="modal_btn_transparent px-4"
                                id="cancelar-cita-btn-profesional" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="modal_btn_blue px-4">Agendar</button>
                    </div>
                </form>
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

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Full calendar JS -->
    <script src="{{ asset('fullCalendar/main.js') }}"></script>
    <script src="{{ asset('fullCalendar/locales/es.js') }}"></script>

    <script>
        moment.locale('es');
        document.addEventListener('DOMContentLoaded', function() {

            //Iniciar data
            var weekNotBusiness = '{!! json_encode($weekNotBusiness) !!}';

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                businessHours: {!! json_encode($horario->horario) !!},
                events: '{{ route('profesional.calendario.ver-citas') }}',
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
                                console.log(event.dateStr);
                                $('#btn-day-clicked').data('date', event.dateStr);
                                $('#btn-day-see').data('date', event.dateStr);
                                $('#span-day-clicked').html(day.format('MMMM D/YYYY'));

                                $('#modal_dia_calendario').modal();
                            }
                        } else {
                            calendar.changeView('timeGridDay', event.dateStr);
                        }

                    } else {
                        alert('Día no laboral');
                    }
                },
                selectable: false,
                editable: false,
                //Abrir evento
                eventClick: function(info) {

                    // $('.event-click-data').data('id', info.event._def.publicId)
                    // $('#event-clicked').modal();
                    $.ajax({
                        data: { id: info.event._def.publicId},
                        dataType: 'json',
                        url: '{{ route('profesional.calendario.ver-cita') }}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        success: function (res) {
                            var modal = $('#modal_ver_cita');

                            modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                            modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') + '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                            modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                            modal.find('.tipo_cita').html(res.item.tipo_cita);

                            $('#cancelar_cita').data('id', res.item.id);
                            $('#reagendar_cita').data('id', res.item.id);
                            $('#editar_cita').data('id', res.item.id);

                            modal.modal();
                        },
                        error: function (res, status) {
                            var response = res.responseJSON;
                            $('#alerta-general').html(alert(response.message, 'danger'));
                        }
                    });
                },
                select: function(info) {

                },
                dayCellDidMount: function (date) {

                }
            });
            calendar.render();

            //Permite listar el horario disponible
            function citas_libre(date, disponibilidad) {
                $.ajax({
                    data: { date: date},
                    dataType: 'json',
                    url: '{{ route('profesional.calendario.dias-libre') }}',
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

            //Actualizar eventos
            $('#actualizar-calendar').click(function (e) {
                calendar.refetchEvents();
                var message = {
                    title:  'Hecho',
                    text:   'Citas actualizadas'
                };
                $('#alerta-general').html(alert(message, 'success'));
            });

            //Abrir vista dia en el calendario
            $('#btn-day-see').click(function (e) {
                var btn = $(this);
                calendar.changeView('timeGridDay', btn.data('date'));
                $('#modal_dia_calendario').modal('hide');
            });

            //Abrir modal para asignar cita
            $('#btn-day-clicked').click(function (e) {
                e.preventDefault();

                var btn = $(this);
                citas_libre(btn.data('date'), $('#disponibilidad'));

                $('#agregar_cita').modal();
                $('#lugar').val($('#lugar').data('default'));

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


        });
    </script>
@endsection
