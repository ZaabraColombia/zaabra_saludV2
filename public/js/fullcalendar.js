document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

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
        setTimeout(function (){
            console.log(calendar.getEvents());
        }, 3000);
    }
});
