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
                title: 'paciente 1',
                start: '2021-08-22',
                especialidad: 'especialidad',
                //paciente: 'paciente 1',
                tipo_cita: 'Presencial'
            }
        ],
        dateClick: function(info) {
            console.log(info.dateStr);
            //limpiar el formulario
            //$('#form-agendar-cita-profesional')[0].reset();
            $('#fecha_input-profesional').val(info.dateStr);
            $('#agregar-cita-profesional').modal('show');
        },
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
        },
        eventClick: function(info) {
            console.log(info.event);

            $('#nombre_paciente-profesional').html(info.event.title);
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

    $('#agendar-cita-profesional').click(function (e){
        var fecha = moment($('#fecha_input-profesional').val() + " " + $('#hora_input-profesional').val() , "YYYY-MM-DD H:mm").format();
        console.log(fecha);
        calendar.addEvent({
            title: $('#paciente_input-profesional').val(),
            start: fecha,
            especialidad: $('#especialidad_input-profesional').val(),
            //paciente: 'paciente 1',
            tipo_cita: $('#tipo_cita_select-profesional').val()
        });
        $('#agregar-cita-profesional').modal('hide');
    });
});
