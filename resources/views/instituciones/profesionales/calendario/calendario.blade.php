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
                    <h1 class="title__xl green_bold">Calendario</h1>
                    <span class="text__md black_light">Administre su calendario de citas.</span>
                </div>
            </div>

            <div class="col-12 col-lg-11 col-xl-8 p-0" id="alertas"></div>

            <div class="col-12 col-lg-11 col-xl-8 p-0 mb-3">
                <div class="col-12 d-flex justify-content-end px-0 pt-3">
                    <button id="actualizar-calendar" class="button_green_form">
                        <i data-feather="refresh-cw" class="pr-2"></i>Actualizar
                    </button>
                </div>

                <div id="calendar"></div>
            </div>
        </div>
    </section>

    <!-- Modal Datos del paciente -->
    <div class="modal fade modal_contactos" id="modal-finalizar-cita" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal_container">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-finalizar-cita">
                    <!-- Mantener las cases "label-*" -->
                    <div class="modal-body">
                        <h1 class="mb-3">Datos del paciente</h1>

                        <div class="d-flex justify-content-center mb-3">
                            <img id="foto" class="img__see_contacs foto">
                        </div>

                        <div class="row m-0">
                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Nombre: &nbsp;</h5>
                                <span class="fs_text_small black_light paciente"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Documento: &nbsp;</h5>
                                <span class="fs_text_small black_light identificacion"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Teléfono: &nbsp;</h5>
                                <span class="fs_text_small black_light celular"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Fecha de la atención: &nbsp;</h5>
                                <span class="fs_text_small black_light fecha"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Hora de la atención: &nbsp;</h5>
                                <span class="fs_text_small black_light hora"></span>
                            </div>

                            <div class="col-12 col-lg-6 p-0 d-flex">
                                <h5 class="fs_text_small black_strong">Tipo de atención: &nbsp;</h5>
                                <span class="fs_text_small black_light atencion"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Servicio: &nbsp;</h5>
                                <span class="fs_text_small black_light servicio"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Categoría del servicio: &nbsp;</h5>
                                <span class="fs_text_small black_light tipo_servicio"></span>
                            </div>

                            <div class="col-12 p-0 col-lg-6 d-flex">
                                <h5 class="fs_text_small black_strong">Especialidad: &nbsp;</h5>
                                <span class="fs_text_small black_light especialidad"></span>
                            </div>

                            <div class="col-12 p-0 d-flex">
                                <h5 class="fs_text_small black_strong">Cups:</h5>
                                <span class="fs_text_small black_light cups pl-2" style="line-height: 1.3"></span>
                            </div>
                        </div>

                        <div class="dropdown-divider" style="color: #c2c2c2"></div>

                        <label class="fs_text_small black_strong mb-0" for="">Duración de la cita:</label>
                        <div class="main">
                            <div class="circle">
                                <div id="stopwatch" class="stopwatch black_strong fs_title">00:00</div>
                                <button id="play-pause" class="paused finalizar" type="button" onclick="playPause()">
                                    <span class="fs_text_small" id="texto">Iniciar</span>
                                </button>
                            </div>
                            <div id="seconds-sphere" class="seconds-sphere"></div>
                            <input type="hidden" name="segundos" id="segundos">
                        </div>

                        <div class="col-12 p-0 input__box_modal">
                            <label class="fs_text_small black_strong mb-2" for="comentario">Observaciones</label>
                            <textarea name="comentario" id="comentario" cols="35" rows="5" class="comentario"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer content_btn_center finalizar">
                        <button type="submit" class="button_blue fs_text_small">Finalizar consulta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-ver-bloqueo" >
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
                            <h3>Fecha inicio</h3>
                            <p class="fecha_inicio"></p>
                            <h3>Fecha fin</h3>
                            <p class="fecha_fin"></p>
                            <h3>Comentario</h3>
                            <p class="comentario"></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer content_btn_center">
                    <button type="button" class="button_transparent" id="btn-reserva-cancelar"  data-dismiss="modal">
                        cerrar
                    </button>
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

                    $.ajax({
                        data: { id: info.event._def.publicId},
                        dataType: 'json',
                        url: info.event.extendedProps.show,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'post',
                        success: function (res) {
                            var modal;

                            $('#form-finalizar-cita')[0].reset();
                            $('#form-finalizar-cita').removeAttr('action');

                            if (res.item.estado === 'reservado')
                            {
                                modal = $('#modal-ver-bloqueo');

                                modal.find('.fecha_inicio').html(res.item.fecha_inicio);
                                modal.find('.fecha_fin').html(res.item.fecha_fin);
                                modal.find('.comentario').html(res.item.comentario);

                                $('#btn-reserva-cancelar').data('id', res.item.id);
                                $('#btn-reserva-editar').data('id', res.item.id);

                                modal.modal();
                            } else {

                                modal = $('#modal-finalizar-cita');

                                $.each(res.item, function (key, item) {
                                    if (key !== 'foto' && key !== 'finalizar') modal.find('.' + key).html(item);
                                });

                                modal.find('.foto').attr('src', res.item.foto);
                                if (res.item.estado === 'completado') {
                                    $('.finalizar').hide();

                                    var total_minutes = Math.floor(res.item.duracion / 60);

                                    var display_seconds = (res.item.duracion % 60).toString().padStart(2, "0");
                                    var display_minutes = total_minutes.toString().padStart(2, "0");

                                    $('#stopwatch').html(display_minutes + ":" + display_seconds)
                                    $('#comentario').prop('readonly', true);
                                } else {

                                    $('.finalizar').show();
                                    $('#form-finalizar-cita').attr('action', res.item.finalizar);
                                    $('#comentario').prop('readonly', false);
                                    stop();
                                }

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

            //Actualizar eventos
            $('#actualizar-calendar').click(function (e) {
                calendar.refetchEvents();
                var message = {
                    title:  'Hecho',
                    text:   'Citas actualizadas'
                };
                $('#alertas').html(alert(message, 'success'));
            });

            $('#form-finalizar-cita').submit(function (event) {
                event.preventDefault();
                var form = $(this);

                //obtener segundos
                $('#segundos').val(Math.floor(runningTime / 1000));
                stop();

                $.ajax({
                    data: form.serialize(),
                    dataType: 'json',
                    url: form.attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    success: function (res) {
                        $('#alertas').html(alert(res.message, 'success'));
                        $('#modal-finalizar-cita').modal('hide');
                    },
                    error: function (res, status) {
                        var response = res.responseJSON;
                        $('#alertas').html(alert(response.message, 'danger'));
                        $('#modal-finalizar-cita').modal('hide');
                    }
                });

            });
        });

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
            texto.innerHTML= (texto.innerHTML === "Finalizar") ? "Iniciar" : "Finalizar";
        }

        const pause = () => {
            secondsSphere.style.animationPlayState = 'paused';
            clearInterval(stopwatchInterval);
        }

        const stop = () => {
            secondsSphere.style.transform = 'rotate(-90deg) translateX(60px)';
            secondsSphere.style.animation = 'none';
            playPauseButton.classList.remove('running');
            runningTime = 0;
            clearInterval(stopwatchInterval);
            stopwatch.textContent = '00:00';
        }

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
