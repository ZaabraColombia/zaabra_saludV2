//Lenguaje de moment
moment.locale('es');

//cargar despues de cargar el DOM
document.addEventListener('DOMContentLoaded', function() {

    //Calendario
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        businessHours: calendarEl.dataset.weekBissness,
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

    //

});
