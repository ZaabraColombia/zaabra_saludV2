@extends('instituciones.profesionales.layouts.panel')

@section('styles')
    <link rel="stylesheet" href="{{ asset('fullCalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
@endsection

@section('contenido')
    <section class="section">
        <div class="row containt__calendar" id="basic-table">
            <div class="col-12">
                <div class="my-4 my-xl-5">
                    <h1 class="title__xl blue_bold">Calendario</h1>
                    <span class="text__md black_light">Administre su calendario de citas.</span>
                </div>
            </div>

            <div class="col-12 col-lg-11 col-xl-8 p-0" id="alertas"></div>

            <div class="col-12 col-lg-11 col-xl-8 p-0 mb-3">
                <div class="col-12 d-flex justify-content-end px-0 pt-3">
                    <button id="actualizar-calendar" class="button_blue_form">
                        <i data-feather="refresh-cw" class="pr-2"></i>Actualizar
                    </button>

                    <button class="button_blue" data-toggle="modal" data-target="#modal_">
                        launch modal
                    </button>
                </div>

                <div id="calendar"></div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade modal_contactos" id="modal_">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Mantener las cases "label-*" -->
                <div class="modal-body">
                    <h1>Datos del paciente</h1>

                    <div class="d-flex justify-content-center mb-3">
                        <img id="ver-foto" class="img__see_contacs" src='{{ asset($contacto->foto ?? 'img/menu/avatar.png') }}'>
                    </div>

                    <div class="">
                        <div>
                            <span class="font_roboto fs_text_small black_light">Nombre: &nbsp;</span>
                            <span class="fs_text black_strong">Alexander Alejandro Castiblanco Sepulveda</span>
                        </div>

                        <div>
                            <span class="font_roboto fs_text_small black_light">Tipo de documento: &nbsp;</span>
                            <span class="fs_text black_strong">Cédula de Ciudadanía</span>
                        </div>

                        <div>
                            <span class="font_roboto fs_text_small black_light">Número de documento: &nbsp;</span>
                            <span class="fs_text black_strong">0.000.000.000</span>
                        </div>

                        <div>
                            <span class="font_roboto fs_text_small black_light">Motivo de consulta: &nbsp;</span>
                            <span class="fs_text black_strong">Consulta primera vez</span>
                        </div>
                    </div>

                    <div class="dropdown-divider" style="color: #c2c2c2"></div>

                    <label class="font_roboto fs_text_small black_light mb-0" for="">Duración de la cita:</label>
                    <div class="main">
                        <div class="circle">
                            <div id="stopwatch" class="stopwatch black_strong fs_title">00:00</div>
                            <button id="play-pause" class="paused" onclick="playPause()">
                                <span id="texto">Iniciar</span>
                            </button>
                        </div>
                        <div id="seconds-sphere" class="seconds-sphere"></div>
                    </div>

                    <div class="col-12 p-0 input__box">
                        <label class="font_roboto fs_text_small black_light mb-2" for="observacion">Observaciones</label>
                        <textarea name="observacion" id="observacion" cols="35" rows="5"></textarea>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_blue" data-dismiss="modal">Finalizar consulta</button>
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
                events: {
                    url: '{{ route('institucion.profesional.calendario.ver-citas') }}',
                    method: 'post',
                    extraParams:{
                        "_token" : '{{ csrf_token() }}'
                    }
                },
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
                },
                // Propiedad para cambio de lenguaje
                locale: 'es',
                allDaySlot: false,
                // Evento de mensaje de alerta
                dateClick: function (event) {

                },
                selectable: false,
                editable: false,

                //Abrir evento
                eventClick: function(info) {
                    console.log(info);
                    /*$.ajax({
                        data: { id: info.event._def.publicId},
                        dataType: 'json',
                        url: '',
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
                    });*/
                },

                select: function(info) {

                },

                dayCellDidMount: function (date) {

                },
            });
            calendar.render();

            //Actualizar eventos
            $('#actualizar-calendar').click(function (e) {
                calendar.refetchEvents();
                var message = {
                    title:  'Hecho',
                    text:   'Citas actualizadas'
                };
                $('#alertas').html(alert(message, 'success'));
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

            // Evento para cambiar el texto del botón Iniciar del cronometro
            texto.innerHTML=texto.innerHTML=="Finalizar"?"Iniciar":"Finalizar";
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
        <script>

    </script>
@endsection
