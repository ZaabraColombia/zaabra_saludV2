document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar-profesional');


    var calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'es',
        events: [
            {
                id: 'a',
                title: 'my event',
                start: '2021-08-22',
                especialidad: 'especialidad',
                paciente: 'paciente 1',
                tipo_cita: 'Presencial'
            }
        ],
        dateClick: function(info) {
            //alert('clicked ' + info.dateStr);
        },
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
        },
        eventClick: function(info) {
            //console.log(info.event.extendedProps.especialidad);

            $('#nombre_paciente-profesional').html(info.event.extendedProps.paciente);
            $('#especialidad-profesional').html(info.event.extendedProps.especialidad);
            $('#fecha-profesional').html(moment(info.event.start).format('dddd, D MMMM'));
            $('#hora-profesional').html(moment(info.event.start).format('hh:mm A '));
            $('#tipo_cita-profesional').html(info.event.extendedProps.tipo_cita);

            $('#ver-cita-profecional').modal();
        }
    });

    if (calendarEl !=  null) {
        calendar.render();
    }
});
