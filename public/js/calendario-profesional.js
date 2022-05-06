
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

                        $('#btn-reserva-cancelar').data('url', res.item.ver);
                        $('#btn-reserva-editar').data('url', res.item.ver);
                    } else {

                        modal = $('#modal_ver_cita');

                        $('#btn-cita-cancelar').data('url', res.item.ver);
                        $('#btn-cita-reagendar').data('url', res.item.ver);
                        $('#btn-cita-editar').data('url', res.item.ver);
                        $('#btn-cita-completar').data('url', res.item.ver);
                    }

                    $.each(res.item, function (key, item) {
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
    //Configurar colores
    $('.colors').change(function (event) {
        $('#form-actualizar-colores-calendario').submit();
    });

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

    //Abrir vista dia en el calendario
    $('#btn-ver-dia').click(function (e) {
        var btn = $(this);
        calendar.changeView('timeGridDay', btn.data('date'));
        $('#modal_dia_calendario').modal('hide');
    });

    $('.fecha-disponible').datepicker({
        daysOfWeekDisabled: calendarEl.dataset.daysblock,
        language: 'es',
        format: 'yyyy-mm-dd',
        startDate: moment().format('YYYY-MM-DD'),
        endDate: moment().add('days', calendarEl.dataset.dayslimit).format('YYYY-MM-DD'),
    });

    /************* Fin Calendario *************/
    /************* Citas *************/
    //Permite listar el horario disponible
    function citas_libre(disponibilidad) {
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
                $(disponibilidad.data('alerts')).html(alert(response.message, 'danger'));
            }
        });
    }

    //Permite activar y desactivar convenios
    $('.checkbox-activar-convenios').change(function (event) {
        var convenio = $(this).parents('.input-group').find('.convenios');
        convenio.prop('disabled', !$(this).prop('checked'));
        convenio.val('');
    });

    //Llama todos los convenios de un servicio
    $('.servicio').change(function (event) {
        var servicio = $(this);

        $(servicio.data('convenios')).prop('disabled', !$(this).prop('checked'));
        $(servicio.data('convenios')).parents('.input-group')
            .find('.checkbox-activar-convenios').prop('checked', false);


        if (servicio.val() !== '')
        {
            $.post(servicio.find('option:selected').data('url'), function (data) {
                $(servicio.data('convenios')).html('<option></option>')
                $.each(data.items, function (key, item) {
                    $(servicio.data('convenios')).append('<option value="' + item.id + '" data-cantidad="' + item.pivot.valor_paciente + '">' + item.nombre_completo + '</option>');
                });
            }).fail(function (data) {
                servicio.parents('.modal').find('.alertas').html(alert(data.responseJSON.message, 'danger'));
            });

            citas_libre($(servicio.data('disponibilidad')));

        } else {
            $(servicio.data('convenios')).html('').val('');
        }
    });

    //Llama a dias libres
    $('.fecha').change(function (event) {
        citas_libre($($(this).data('disponibilidad')));
    });

    //Rellena la cantidad de la cita
    $('.convenios, .servicio').change(function (event) {
        var option = $(this).find('option:selected');
        if (option.data('cantidad')) {$('.valor').val(option.data('cantidad'));}
    });

    //Abrir modal para asignar cita
    $('#btn-agendar-cita').click(function (e) {
        e.preventDefault();

        var btn = $(this);
        var modal = $('#modal_agregar_cita');

        $('#form-agendar-cita-profesional')[0].reset();

        $('.checkbox-activar-convenios').prop('checked', false);
        $('#convenios').prop('disabled', true)
        $('#fecha').val(btn.data('date'));

        $('#lugar').val($('#lugar').data('default'));

        $('#modal_dia_calendario').modal('hide');

        modal.modal();
    });

    //Crear la cita
    $('#form-agendar-cita-profesional').submit(function (e) {
        agregar_cita(e, $(this));
    });

    $('#btn-agendar-cita-profesional').click(function (e) {
        agregar_cita(e, $('#form-agendar-cita-profesional'));
    });

    function agregar_cita(e, form)
    {
        e.preventDefault();

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

                $('#modal_agregar_cita').modal('hide');
                //resetear formulario
                form[0].reset();
                $('#lugar').val($('#lugar').data('default'));
                $('#numero_id').val(null).trigger('change');
                $('.checkbox-activar-convenios').prop('checked', false);
                $('#convenios').prop('disabled', true)
                $('#fecha').val('');

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
    }
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


    /************* Fin Citas *************/
});

function ubicacion() {
    // var pais = $('#pais_id');
    // pais.val(pais.data('id')).trigger('change');
    //
    // setTimeout(function () {
    //     var departamento = $('#departamento_id');
    //     departamento.val(departamento.data('id')).trigger('change');
    // },500);
    // setTimeout(function () {
    //     var provincia = $('#provincia_id');
    //     provincia.val(provincia.data('id')).trigger('change');
    // },1000);
    // setTimeout(function () {
    //     var ciudad = $('#ciudad_id');
    //     ciudad.val(ciudad.data('id')).trigger('change');
    // },1500);

    var pais = $('#pais_id');
    pais.val(pais.data('id'))
        .then(function () {
            console.log('ok');
        }).trigger('change');

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
}

