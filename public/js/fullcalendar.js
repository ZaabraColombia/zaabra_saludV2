document.addEventListener('DOMContentLoaded', function() {

    moment.locale('es');

    var calendarEl = document.getElementById('calendar');

    var count = 0;

    //var events = $.parseJSON($('#data-eventos-profesional').data('events'));

    var calendar = new FullCalendar.Calendar(calendarEl, {

        selectable: true,

        //Parametro para la creación del botón agendar cita
        customButtons: {
            myCustomButton: {
            text: 'Agendar cita',
                click: function() {
                    alert('clicked the custom button!');
                }
            }
        },

        headerToolbar: {
            left: 'prev,next today,myCustomButton',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        locale: 'es',
        events: $('#data-eventos-profesional').data('events'),
        dateClick: function(info) {
            //alert('clicked ' + info.dateStr);
            var modal = $('#agendar-cita-modal-paciente');
            if (modal.length > 0) {
                modal.modal();
                $('#fecha_input-paciente').val(info.dateStr);
            }
        },
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
        },
        eventClick: function(info) {
            //console.log(info);

            //Llenar el modal con la informacion
            $('#profesional-paciente').html(info.event.extendedProps.profesional);
            $('#especialidad-paciente').html(info.event.title);
            $('#fecha-paciente').html(moment(info.event.start).format('dddd, D MMMM'));
            $('#hora-paciente').html(moment(info.event.start).format('hh:mm A '));
            $('#tipo_cita-paceinte').html(info.event.extendedProps.tipo_cita);

            // ID del evento
            //$('#editar-cita-btn-profesional').data('id', info.event.id);
            //$('#cancelar-cita-btn-profesional').data('id', info.event.id);

            //Activar modal
            $('#ver-cita-paciente').modal();
        }
      });

    if (calendarEl !=  null) {
        calendar.render();
    }

    //Permite simular pagar la cita
    $("#pagar-cita-paciente").click(function (){
        var fecha = moment($('#fecha_input-paciente').val() + " " + $('#hora_input-paciente').val() , "YYYY-MM-DD H:mm").format();
        console.log(fecha);
        count++;
        calendar.addEvent({
            id: count,
            title: $('#especialidad_profesional-paciente').html(),
            profesional: $('#nombre_profesional-paciente').html(),
            start: fecha,
            //paciente: 'paciente 1',
            tipo_cita: $('#tipo_cita-select-paciente').val(),
            //color: 'blue',
            //textColor: 'white'
            allDay: true,
        });
        $('#agendar-cita-modal-paciente').modal('hide');
    });
});
