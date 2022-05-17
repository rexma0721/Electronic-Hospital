$(document).ready(function() {

    $('.load-fullcalendar').click(function(){
        setTimeout(function(){
            $('#calendar').fullCalendar('render');
        },1000);
    });
	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .fc-event').each(function() {

		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});
    var mySwalIn='nothing';
    $('.open-swal').click(function(){
        swal({   title: "An input!",  
            text: "Write something interesting:",  
            type: "input",   
             showCancelButton: true,   
             closeOnConfirm: true,   
             animation: "slide-from-top",   
             inputPlaceholder: "Write something" }, 
             function(inputValue){   
                if (inputValue === false) return false;      
                if (inputValue === "") {     
                    swal.showInputError("You need to write something!");     
                    return false ;
                } 
             mySwalIn=inputValue;
        });
    });

	/* initialize the calendar
	-----------------------------------------------------------------*/

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		},
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            // $('.open-swal').trigger('click');
            // var title=mySwalIn;
            // console.log(mySwalIn);
            var title = prompt('Event Title:');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2016-06-01'
            },
            {
                title: 'Thoriseum Theme making',
                start: '2016-06-20',
                end: '2016-08-15'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-01-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2016-01-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2016-06-11',
                end: '2016-06-13'
            },
            {
                title: 'Meeting',
                start: '2016-07-12T10:30:00',
                end: '2016-07-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2016-08-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2016-08-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2016-08-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2016-09-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2016-11-26T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2016-06-28'
            }
        ]
	});
});