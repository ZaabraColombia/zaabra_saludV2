document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar-profesional');

    var count = 0;

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
                id: count,
                title: 'paciente 1',
                start: '2021-08-22',
                especialidad: 'especialidad',
                //paciente: 'paciente 1',
                tipo_cita: 'Presencial',
                allDay: true,
            }
        ],
        dateClick: function(info) {
            console.log(info.dateStr);
            //limpiar el formulario
            $("#form-agendar-cita-profesional")[0].reset();
            $('#fecha_input-profesional').val(info.dateStr);
            $('#agregar-cita-profesional').modal('show');
        },
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
        },
        eventClick: function(info) {
            console.log(info.event);

            //Llenar el modal con la informacion
            $('#nombre_paciente-profesional').html(info.event.title);
            $('#especialidad-profesional').html(info.event.extendedProps.especialidad);
            $('#fecha-profesional').html(moment(info.event.start).format('dddd, D MMMM'));
            $('#hora-profesional').html(moment(info.event.start).format('hh:mm A '));
            $('#tipo_cita-profesional').html(info.event.extendedProps.tipo_cita);

            // ID del evento
            $('#editar-cita-btn-profesional').data('id', info.event.id);
            $('#cancelar-cita-btn-profesional').data('id', info.event.id);

            //Activar modal
            $('#ver-cita-profecional').modal();
        }
    });

    if (calendarEl !=  null) {
        calendar.render();
    }

    $('#agendar-cita-profesional').click(function (e){
        var fecha = moment($('#fecha_input-profesional').val() + " " + $('#hora_input-profesional').val() , "YYYY-MM-DD H:mm").format();
        console.log(fecha);
        count++;
        calendar.addEvent({
            id: count,
            title: $('#paciente_input-profesional').val(),
            start: fecha,
            especialidad: $('#especialidad_input-profesional').val(),
            //paciente: 'paciente 1',
            tipo_cita: $('#tipo_cita_select-profesional').val(),
            //color: 'blue',
            //textColor: 'white'
            allDay: true,
        });
        $('#agregar-cita-profesional').modal('hide');
    });

    $('#editar-cita-btn-profesional').click(function (e) {
        var id = $(this).data('id');

        var event = calendar.getEventById(id);

        console.log(event);

        //Llenar el modal con la informacion
        $('#paciente_input-editar-profesional').val(event.title);
        $('#fecha_input-editar-profesional').val(moment(event.start).format('YYYY-MM-DD'));
        $('#hora_input-editar-profesional').val(moment(event.start).format('HH:mm'));
        $('#tipo_cita-profesional>option[value=' + event.extendedProps.tipo_cita +  ']').attr('selected', 'selected');

        $('#ver-cita-profecional').modal('hide');
        $('#editar-cita-model-profesional').modal('show');

    });

    $('#editar-cita-profesional').click(function (e){
        var fecha = moment($('#fecha_input-editar-profesional').val() + " " + $('#hora_input-profesional').val() , "YYYY-MM-DD H:mm").format();

        var id = $('#editar-cita-btn-profesional').data('id');

        var event = calendar.getEventById(id);

        event.remove();
        // event.title = $('#paciente_input-editar-profesional').val();
        // event.start = fecha;
        // event.extendedProps.especialidad =  $('#especialidad_input-profesional').val();
        // event.extendedProps.tipo_cita = fecha;

        calendar.addEvent({
            id: id,
            title: $('#paciente_input-editar-profesional').val(),
            start: fecha,
            especialidad: $('#especialidad_input-profesional').val(),
            //paciente: 'paciente 1',
            tipo_cita: $('#tipo_cita_select-editar-profesional').val(),
            allDay: true,
        });


        $('#editar-cita-model-profesional').modal('hide');
    });

    $('#cancelar-cita-btn-profesional').click(function (e) {
        var id = $(this).data('id');

        var event = calendar.getEventById(id);

        event.remove();

        $('#ver-cita-profecional').modal('hide');
        $('#cancelada-cita-modal-profecional').modal('show');
    });



});
