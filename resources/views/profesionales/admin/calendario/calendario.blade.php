@extends('profesionales.admin.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <section class="section">
        <div class="row containt_agendaProf" id="basic-table">
            <div class="col-12 col-lg-10 col-xl-8 p-0">
                <div class="my-4 my-xl-5">
                    <h1 class="title__xl blue_bold">Mi Calendario</h1>
                    <span class="text__md black_light">Administre su calendario de citas</span>
                </div>

                <div class="row m-0 pb-4">
                    <button id="actualizar-calendar" class="button_blue_form"><i class="fas fa-sync-alt pr-2"></i>Actualizar</button>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_ver_cita">
                        Open modal
                    </button> -->
                </div>

                <div class="row m-0 content_dias_agenda mb-md-3">
                    <div class="col-md-4 p-0">
                        <span class="disponible"> <i></i> Días disponibles</span>
                    </div>

                    <div class="col-md-4 p-0 content_center_agenda">
                        <span class="cita_pag"> <i></i> Citas pagadas</span>
                    </div>

                    <div class="col-md-4 p-0 content_right_agenda">
                        <span class="cita_pag_pres"> <i></i> Cita pago presencial</span>
                    </div>

                    <div class="col-md-4 p-0">
                        <span class="no_disponible"> <i></i> Días no disponibles</span>
                    </div>

                    <div class="col-md-4 p-0 content_center_agenda">
                        <span class="cita_agen"> <i></i> Citas agendadas</span>
                    </div>

                    <div class="col-md-4 p-0 content_right_agenda">
                        <span class="cita_cancel"> <i></i> Citas canceladas</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-10 col-xl-8 p-0" id="alerta-general"></div>

            <div class="col-12 col-lg-10 col-xl-8 p-0 mb-3">
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
                    <button type="button" class="button_blue" id="btn-day-clicked">Agendar cita</button>
                    <button type="button" class="button_blue" id="btn-day-see">Ver citas</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  agendar cita -->
    <div class="modal fade" id="agregar_cita" tabindex="-1" role="dialog">
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

                                <div class="col-12 col-lg-6 p-0 pl-lg-2">
                                    <label for="disponibilidad">Horario disponible</label>
                                    <select id="disponibilidad" name="disponibilidad" required></select>
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
    <div class="modal fade" id="modal_ver_cita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <span class="tipo_cita"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" id="btn-cita-cancelar">
                        Cancelar cita
                    </button>
                    <button type="submit" class="button_blue" id="btn-cita-reagendar">
                        Reagendar cita
                    </button>
                    <button type="submit" class="button_blue" id="btn-cita-editar">
                        Editar cita
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar cita -->
    <div class="modal fade" id="modal_editar_cita" tabindex="-1" >
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
                                    <span class="tipo_cita"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form_modal">
                            <div class="row m-0">
                                <div class="col-12 p-0" id="alerta-editar"></div>
                                <input type="hidden" id="id_cita-editar" name="id_cita"/>
                                <div class="col-12 p-0">
                                    <label for="tipo_cita-editar">Tipo de cita</label>
                                    <select id="tipo_cita-editar" name="tipo_cita" required>
                                        <option ></option>
                                        @if($tipoCitas->isNotEmpty())
                                            @foreach($tipoCitas as $cita)
                                                <option value="{{ $cita->id }}">{{ $cita->nombreconsulta }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
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
                                    <span class="tipo_cita"></span>
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
                                <span class="tipo_cita"></span>
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
                events: '{{ route('profesional.agenda.calendario.ver-citas') }}',
                // Botones de mes, semana y día.
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // Propiedad para cambio de lenguaje
                locale: 'es',
                allDaySlot: false,

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
                        url: '{{ route('profesional.agenda.calendario.ver-cita') }}',
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
                            modal.find('.correo').html(res.item.correo);
                            modal.find('.numero_id').html(res.item.numero_id);

                            $('#btn-cita-cancelar').data('id', res.item.id);
                            $('#btn-cita-reagendar').data('id', res.item.id);
                            $('#btn-cita-editar').data('id', res.item.id);

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

                }, 
            });
            calendar.render();

            //Permite listar el horario disponible
            function citas_libre(date, disponibilidad) {
                $.ajax({
                    data: { date: date},
                    dataType: 'json',
                    url: '{{ route('profesional.agenda.calendario.dias-libre') }}',
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
                        modal.find('.correo').html(res.item.correo);
                        modal.find('.numero_id').html(res.item.numero_id);

                        modal.find('#tipo_cita-editar').val(res.item.tipo_cita_id);
                        modal.find('#lugar-editar').val(res.item.lugar);
                        modal.find('#modalidad_pago-editar').val(res.item.modalidad);
                        modal.find('#cantidad-editar').val(res.item.cantidad);
                        modal.find('#id_cita-editar').val(res.item.id);

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
        });
    </script>
@endsection
