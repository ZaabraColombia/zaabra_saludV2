
//Lenguaje de moment
moment.locale('es');

//cargar despues de cargar el DOM
document.addEventListener('DOMContentLoaded', function() {

    /************* Calendario *************/
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        businessHours: calendarEl.dataset.weekbissness,
        events: calendarEl.dataset.events,
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
            var today = moment();

            var day = moment(event.date);

            if (calendarEl.dataset.days.includes(event.date.getDay()))
            {

                if (today.startOf('day').diff(day.startOf('day'), 'days') <= 0)
                {
                    if (event.view.type === "dayGridMonth") {

                        $('#span-day-clicked').html(day.format('MMMM D/YYYY'));

                        $('#btn-ver-dia').data('date', event.dateStr);
                        $('#btn-agendar-cita').data('date', event.dateStr);

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
            // $('#event-clicked').modal()
            $.ajax({
                dataType: 'json',
                url: info.event.extendedProps.ver,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                success: function (res) {
                    var modal;

                    if (res.item.estado === 'reservado')
                    {
                        modal = $('#modal_ver_reserva');

                        $('#btn-reserva-cancelar').data('url', res.item.data.ver);
                        $('#btn-reserva-editar').data('url', res.item.data.ver);
                    } else {

                        modal = $('#modal_ver_cita');

                        $('#btn-cita-cancelar, #btn-cita-reagendar, #btn-cita-editar, #btn-cita-completar')
                            .data('url', res.item.data.ver);
                    }

                    $.each(res.item.ver, function (key, item) {
                        modal.find('.' + key).html(item);
                    });

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

    //Actualizar eventos
    $('#actualizar-calendar').click(function (e) {
        calendar.refetchEvents();
        $('#alerta-general').html(alert({
            title:  'Hecho',
            text:   'Citas actualizadas'
        }, 'success'));
    });

    //Abrir vista dia en el calendario
    $('#btn-ver-dia').click(function (e) {
        var btn = $(this);
        calendar.changeView('timeGridDay', btn.data('date'));
        $('#modal_dia_calendario').modal('hide');
    });

    /************* Fin Calendario *************/
    /************* Colores *************/
    //Configurar colores
    $('.colors').change(function (event) {
        $('#form-actualizar-colores-calendario').submit();
    });

    //Configurar colores
    $('#form-actualizar-colores-calendario').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function (data) {
            $('#alerta-general').html(alert(data.message, 'success'));
            calendar.refetchEvents();
        }, 'json').fail( function (data) {
            $('#alerta-general').html(alert(data.responseJSON.message, 'danger'));
        });
    });
    /************* Fin Colores *************/
    /************* Configuraciones *************/
    //Activar plugin datepicker
    $('.fecha-disponible').datepicker({
        daysOfWeekDisabled: calendarEl.dataset.daysblock,
        language: 'es',
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        endDate: moment().add('days', calendarEl.dataset.dayslimit).format('YYYY-MM-DD'),
    });

    //Permite listar el horario disponible
    function citas_libre(disponibilidad) {
        if (disponibilidad.length > 0){
            $.ajax({
                data: {
                    date: $(disponibilidad.data('fecha')).val(),
                    servicio: $(disponibilidad.data('servicio')).val()
                },
                dataType: 'json',
                url: calendarEl.dataset.daysfree,
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
                    $(disponibilidad.parents('form').data('alerta')).html(alert(response.message, 'danger'));
                }
            });
        }
    }

    //Permite activar y desactivar convenios
    $('.checkbox-activar-convenios').change(function (event) {
        var convenio = $(this).parents('.input-group').find('.convenio');
        convenio.prop('disabled', !$(this).prop('checked'));
        convenio.val('');
    });

    //Llama todos los convenios de un servicio
    $('.servicio').change(function (event) {
        var servicio = $(this);
        var convenio =  $(servicio.data('convenios'));

        convenio.prop('disabled', true);
        convenio.parents('.input-group').find('.checkbox-activar-convenios').prop('checked', false);

        if (servicio.val() !== '')
        {
            $.post(servicio.find('option:selected').data('url'), function (data) {
                convenio.html('<option></option>');
                $.each(data.items, function (key, item) {
                    convenio.append('<option value="' + item.id + '" data-cantidad="' + item.pivot.valor_paciente + '">' + item.nombre_completo + '</option>');
                });
            }).fail(function (data) {
                servicio.parents('.modal').find('.alertas').html(alert(data.responseJSON.message, 'danger'));
            });

            citas_libre($(servicio.data('disponibilidad')));

        } else {
            $(servicio.data('convenios')).html('').val('');
        }
    });

    //Rellena la cantidad de la cita
    $('#convenio, #servicio').change(function (event) {
        var option = $(this).find('option:selected');
        if (option.data('cantidad')) {$('.valor').val(option.data('cantidad'));}
    });

    //Llama a dias libres
    $('.fecha').change(function (event) {
        citas_libre($($(this).data('disponibilidad')));
    });


    //formularios capturar submit
    $('.forms-calendario').submit(function (e) {
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

                $(form.data('modal')).modal('hide');

                calendar.refetchEvents();
            },
            error: function (res, status) {

                var response = res.responseJSON;

                $(form.data('alerta')).html(alert(response.message, 'danger'));

                calendar.refetchEvents();
            }
        });
    });

    //Buscar paciente
    $('#numero_id').select2({
        language: 'es',
        theme: 'bootstrap4',
        ajax: {
            url: $('#numero_id').data('url'),
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
        dropdownParent: $('#modal_agregar_cita')
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

    /************* Fin Configuraciones *************/

    /************* Citas *************/
    //Abrir modal para asignar cita
    $('#btn-agendar-cita').click(function (e) {
        e.preventDefault();

        var btn = $(this);
        var modal = $('#modal_agregar_cita');
        var form = $('#form-agendar-cita');
        var lugar = $('#lugar');
        var pais = $('#pais_id');

        form[0].reset();

        $('.checkbox-activar-convenios').prop('checked', false);
        $('#convenios').prop('disabled', true).html('<option></option>');
        $('#fecha').val(btn.data('date'));
        $('#numero_id').val(null).trigger('change');

        lugar.val(lugar.data('default'));
        pais.val(pais.data('id')).trigger('change');

        $('#modal_dia_calendario').modal('hide');

        modal.modal();
    });

    //abrir modal para actualizar cita
    $('#btn-cita-editar').click(function (e) {
        var btn = $(this);
        $('#modal_ver_cita').modal('hide');
        var form = $('#form-editar-cita');

        $.ajax({
            dataType: 'json',
            url: btn.data('url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            success: function (res) {
                var modal = $('#modal_editar_cita');

                $.each(res.item.ver, function (key, item) {
                    modal.find('.' + key).html(item);
                });

                $('#servicio-editar').val(res.item.data.servicio).trigger('change');
                if (res.item.data.convenio)
                {
                    setTimeout(function () {
                        $('#convenio-editar').val(res.item.data.convenio).prop('disabled', false);
                        $('#activar-convenios-editar').prop('checked', true);
                    }, 1000);
                }else{
                    $('#convenio-editar').prop('disabled', true);
                    $('#activar-convenios-editar').prop('checked', false);
                }
                $('#ciudad_id-editar').data('id', res.item.data.ciudad);
                $('#provincia_id-editar').data('id', res.item.data.provinvia);
                $('#departamento_id-editar').data('id', res.item.data.departamento);
                $('#pais_id-editar').data('id', res.item.data.pais).val(res.item.data.pais).trigger('changue');

                $('#lugar-editar').val( res.item.data.lugar);

                $('#modalidad_pago-editar').val(res.item.data.modalidad);
                $('#cantidad-editar').val(res.item.data.valor);
                $('#cantidad_convenio-editar-editar').val(res.item.data.valor_convenio);

                form.attr('action', res.item.data.editar)


                modal.modal();
            },
            error: function (res, status) {
                var response = res.responseJSON;
                $('#alerta-general').html(alert(response.message, 'danger'));
            }
        });
    });

    //Abrir modal para reagendar cita
    $('#btn-cita-reagendar').click(function (e) {
        var btn = $(this);
        $('#modal_ver_cita').modal('hide');
        var form = $('#form-cita-reagendar');

        $.ajax({
            data: { id: btn.data('id') },
            dataType: 'json',
            url: btn.data('url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            success: function (res) {
                var modal = $('#modal_reagendar_cita');

                $.each(res.item.ver, function (key, item) {
                    modal.find('.' + key).html(item);
                });

                modal.find('#fecha-reasignar').val(res.item.data.fecha);
                modal.find('#servicio-reasignar').val(res.item.data.servicio);

                form.attr('action', res.item.data.reagendar);
                citas_libre($('#disponibilidad-reasignar'));

                modal.modal();
            },
            error: function (res, status) {
                var response = res.responseJSON;
                $('#alerta-general').html(alert(response.message, 'danger'));
            }
        });
    });

    //Abrir modal para cancelar cita
    $('#btn-cita-cancelar').click(function (e) {
        var btn = $(this);
        $('#modal_ver_cita').modal('hide');
        var form = $('#form-cita-cancelar');

        $.ajax({
            data: { id: btn.data('id') },
            dataType: 'json',
            url: btn.data('url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            success: function (res) {
                var modal = $('#modal_cancelar_cita');

                $.each(res.item.ver, function (key, item) {
                    modal.find('.' + key).html(item);
                });
                form.attr('action', res.item.data.cancelar);

                modal.modal();
            },
            error: function (res, status) {
                var response = res.responseJSON;
                $('#alerta-general').html(alert(response.message, 'danger'));
            }
        });
    });

    //Modal para completar cita
    $('#btn-cita-completar').click(function (e) {
        var btn = $(this);
        $('#modal_ver_cita').modal('hide');
        var form = $('#form-completar-cita');

        $.ajax({
            data: { id: btn.data('id') },
            dataType: 'json',
            url: btn.data('url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            success: function (res) {
                var modal = $('#modal_completar_cita');

                $.each(res.item.ver, function (key, item) {
                    modal.find('.' + key).html(item);
                });

                form.attr('action', res.item.data.completar);
                form[0].reset();

                stop();

                modal.modal();
            },
            error: function (res, status) {
                var response = res.responseJSON;
                $('#alerta-general').html(alert(response.message, 'danger'));
            }
        });
    });
    /************* Fin Citas *************/
});
/************* Cronometro *************/
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
    $('#segundos').val(Math.floor(runningTime / 1000));
}

const stop = () => {
    secondsSphere.style.transform = 'rotate(-90deg) translateX(60px)';
    secondsSphere.style.animation = 'none';
    playPauseButton.classList.remove('running');
    runningTime = 0;
    clearInterval(stopwatchInterval);
    stopwatch.textContent = '00:00';
    $('#segundos').val(0);
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
/************* Fin Cronometro *************/



