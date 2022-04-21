@extends('instituciones.profesionales.layouts.panel')

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
                <span class="text__md black_light">Administre su calendario de citas.</span>
            </div>

            <div class="time_cita">
                <div class="main">
                    <div class="circle">
                        <div id="stopwatch" class="stopwatch">00:00</div>
                        <div class="buttons">
                            <!-- <div class="stop" onclick="stop()"></div> -->
                            <div id="play-pause" class="paused" onclick="playPause()"></div>
                        </div>
                    </div>
                    <div id="seconds-sphere" class="seconds-sphere"></div>
                </div>

            
                <div class="col-12 p-0 input__box">
                    <!-- <label for="observacion">Observación</label> -->
                    <textarea name="observacion" id="observacion" cols="35" rows="5" placeholder="Observaciones"></textarea>
                </div>
            </div>

            <div class="col-12 col-lg-11 col-xl-8 p-0" id="alerta-general"></div>

            <div class="col-12 col-lg-11 col-xl-8 p-0 mb-3">
                <div class="col-12 d-flex justify-content-end px-0 pt-3">
                    <button id="actualizar-calendar" class="button_blue_form">
                        <i data-feather="refresh-cw" class="pr-2"></i>Actualizar
                    </button>
                </div>

                <div id="calendar"></div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Full calendar JS -->
    <script src="{{ asset('fullCalendar/main.js') }}"></script>
    <script src="{{ asset('fullCalendar/locales/es.js') }}"></script>

    <!-- Select 2 -->
    <script src="{{ asset('js/filtro-ubicacion.js') }}"></script>

    <script>
        moment.locale('es');
        document.addEventListener('DOMContentLoaded', function() {

            //Iniciar data
            {{-- var weekNotBusiness = '{!! json_encode($weekNotBusiness) !!}'; --}}

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                {{-- businessHours: {!! json_encode($horario->horario) !!}, --}}
                events: '{{ route('profesional.agenda.calendario.ver-citas') }}',
                // Botones de mes, semana y día.
                headerToolbar: {
                    left: 'prev',
                    center: 'title,dayGridMonth,timeGridWeek,timeGridDay,today',
                    right: 'next'
                },

                slotLabelInterval: {
                    minutes: 30
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                },
                eventShortHeight: 15,
                slotDuration: '00:15',
                snapDuration: '02:00',
                customButtons: {
                    bloquear: {
                        text: 'Bloquear',
                        click: function() {

                        }
                    },
                    // actualizar: {
                    //     text: 'Actualizar',
                    //     click: function() {
                    //         calendar.refetchEvents();
                    //         var message = {
                    //             title:  'Hecho',
                    //             text:   'Citas actualizadas'
                    //         };
                    //         $('#alerta-general').html(alert(message, 'success'));
                    //     },
                    //     //class: "button_blue_form"
                    // }
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
                                $('#btn-reservar-agenda').data('date', event.dateStr);
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
                            var modal;

                            if (res.item.estado === 'reservado')
                            {
                                modal = $('#modal_ver_reserva');

                                modal.find('.fecha_inicio').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                                modal.find('.fecha_fin').html(moment(res.item.fecha_fin).format('dddd, D MMMM/YYYY'));
                                modal.find('.comentario').html(res.item.comentario);

                                $('#btn-reserva-cancelar').data('id', res.item.id);
                                $('#btn-reserva-editar').data('id', res.item.id);

                                modal.modal();
                            } else {

                                modal = $('#modal_ver_cita');

                                modal.find('.fecha').html(moment(res.item.fecha_inicio).format('dddd, D MMMM/YYYY'));
                                modal.find('.hora').html(moment(res.item.fecha_inicio).format('hh:mm A') + '-' + moment(res.item.fecha_fin).format('hh:mm A'));
                                modal.find('.nombre_paciente').html(res.item.nombre_paciente);
                                modal.find('.tipo_cita').html(res.item.tipo_cita);
                                modal.find('.modalidad').html(res.item.modalidad);
                                modal.find('.correo').html(res.item.correo);
                                modal.find('.numero_id').html(res.item.numero_id);

                                $('#btn-cita-cancelar').data('id', res.item.id);
                                $('#btn-cita-reagendar').data('id', res.item.id);
                                $('#btn-cita-editar').data('id', res.item.id);
                                $('#btn-cita-completar').data('id', res.item.id);

                                modal.modal();
                            }
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

    <script>
        const stopwatch = document.getElementById('stopwatch');
        const playPauseButton = document.getElementById('play-pause');
        const secondsSphere = document.getElementById('seconds-sphere');

        let stopwatchInterval;
        let runningTime = 0;

        const playPause = () => {
            const isPaused = !playPauseButton.classList.contains('running');
            if (isPaused) {
                playPauseButton.classList.add('running');
                start();
            } else {
                playPauseButton.classList.remove('running');
                pause();
            }
        }

        const pause = () => {
            secondsSphere.style.animationPlayState = 'paused';
            clearInterval(stopwatchInterval);
        }

        // const stop = () => {
        //     secondsSphere.style.transform = 'rotate(-90deg) translateX(60px)';
        //     secondsSphere.style.animation = 'none';
        //     playPauseButton.classList.remove('running');
        //     runningTime = 0;
        //     clearInterval(stopwatchInterval);
        //     stopwatch.textContent = '00:00';
        // }

        const start = () => {
            secondsSphere.style.animation = 'rotacion 60s linear infinite';
            let startTime = Date.now() - runningTime;
            secondsSphere.style.animationPlayState = 'running';
            stopwatchInterval = setInterval( () => {
                runningTime = Date.now() - startTime;
                stopwatch.textContent = calculateTime(runningTime);
            }, 1000)
        }

        const calculateTime = runningTime => {
            const total_seconds = Math.floor(runningTime / 1000);
            const total_minutes = Math.floor(total_seconds / 60);

            const display_seconds = (total_seconds % 60).toString().padStart(2, "0");
            const display_minutes = total_minutes.toString().padStart(2, "0");

            return `${display_minutes}:${display_seconds}`
        }
    </script>
@endsection
