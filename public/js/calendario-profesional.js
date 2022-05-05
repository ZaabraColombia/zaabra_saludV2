
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
            // $('#event-clicked').modal();
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
    /************* Fin Calendario *************/
    /************* Citas *************/
    //Permite listar el horario disponible
    function citas_libre(date, disponibilidad) {

        $.ajax({
            data: { date: date},
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
                $('#alerta-general').html(alert(response.message, 'danger'));
            }
        });
    }

    //Abrir modal para asignar cita
    $('#btn-agendar-cita').click(function (e) {
        e.preventDefault();

        var btn = $(this);
        var modal = $('#modal_agregar_cita');

        $('#form-agendar-cita-profesional')[0].reset();



        citas_libre(btn.data('date'), $('#disponibilidad'));

        $('#lugar').val($('#lugar').data('default'));

        modal.modal();

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

