document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

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
              start: '2021-08-22'
            }
        ],
        dateClick: function(info) {
            //alert('clicked ' + info.dateStr);
        },
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
        }
      });
    calendar.render();
});
