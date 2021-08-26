document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var count = 0;

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
        /*events: [
            {
                allDay: true,
                id: 'a',
                title: 'my event',
                //start: '2021-08-27',
                //startStr: '2021-08-27T07:00:00Z'
            }
        ],*/
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
            console.log(info);


            // alert('Event: ' + info.event.title);
            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            // alert('View: ' + info.view.type);
            //
            // // change the border color just for fun
            // info.el.style.borderColor = 'red';
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
            profesional: $('#paciente_input-profesional').val(),
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
