$(document).ready(function() {
    var calendar = $('#m_calendar').fullCalendar({
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: 'calendar/calendarData',
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            let now = new Date();
            var today = $.fullCalendar.formatDate(start, "Y-MM-DD") + 'T' + now.getHours() + ':' + now.getMinutes();
            var user_id = $('#user_id').val();
            //var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            // alert(today)
            $('#select_existing').css("display", "block");
            //$('#activity_typeUpdate').val(title);
            $('#initiated_byUpdate').val(user_id);
            $('#assigned_byUpdate').val(user_id);
            $('#datepickerUpdte').val(today);
            $('#datepicker').val(today);
            $('#setActivityTitle').html('Add Activity');
            // $('#activity_status').val(lead_activity_status);
            // $('#follow_up_datetime').val(follow_up_datetime);
            // $('#reminderUpdate').val(reminder);
            // $('#activity_title').val(title);
            // $('#leadActivityUpdateId').val(lid);
            // $('#oppTitle').html(opportunity_title);
            dataString = 'type=Phone Call';
            ajax.url = 'calendar/getType';
            $.ajax({
                type: "post",
                url: ajax.url,
                data: dataString,
                success: function(data) {
                    $('#activityStatus').html(data);
                }
            });
        },
        editable: true,
        eventResize: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var title = event.activity_type;
            var id = event.id;
            $.ajax({
                url: "update.php",
                type: "POST",
                data: { title: title, start: start, end: end, id: id },
                success: function() {
                    calendar.fullCalendar('refetchEvents');
                    alert('Event Update');
                }
            })
        },

        eventDrop: function(event) {
            // var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            // var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            // var title = event.title;
            // var id = event.id;
            // $.ajax({
            //  url:"update.php",
            //  type:"POST",
            //  data:{title:title, start:start, end:end, id:id},
            //  success:function()
            //  {
            //   calendar.fullCalendar('refetchEvents');
            //   alert("Event Updated");
            //  }
            // });
        },

        eventClick: function(event) {
            //console.log(event);
            $('#select_existing').css("display", "block");
            var lid = event.lead_activity_id;
            var activity_start_datetime = event.activity_start_datetime;
            var activity_end_datetime = event.activity_end_datetime;
            var reminder = event.reminder;
            var activity_type = event.activity_type;
            var initiated_by = event.initiated_by;
            var assigned_by = event.assigned_by;
            var lead_activity_status = event.lead_activity_status;
            var title = event.title;
            var follow_up_datetime = event.follow_up_datetime;
            var opportunity_title = event.opportunity_title;

            $('#activity_typeUpdate').val(title);
            $('#initiated_byUpdate').val(initiated_by);
            $('#assigned_byUpdate').val(assigned_by);
            $('#datepickerUpdte').val(activity_start_datetime);
            $('#datepicker').val(activity_end_datetime);
            $('#activity_status').val(lead_activity_status);
            $('#follow_up_datetime').val(follow_up_datetime);
            $('#reminderUpdate').val(reminder);
            $('#activity_title').val(title);
            $('#leadActivityUpdateId').val(lid);
            $('#oppTitle').html("Opportunity Type: " + opportunity_title);

            dataString = 'type=' + title + '&lead_activity_status=' + lead_activity_status;
            ajax.url = 'calendar/getType';
            $.ajax({
                type: "post",
                url: ajax.url,
                data: dataString,
                success: function(data) {
                    $('#activityStatus').html(data);
                }
            });
            // if(confirm("Are you sure you want to remove it?"))
            // {
            //  var id = event.id;
            //  $.ajax({
            //   url:"delete.php",
            //   type:"POST",
            //   data:{id:id},
            //   success:function()
            //   {
            //    calendar.fullCalendar('refetchEvents');
            //    alert("Event Removed");
            //   }
            //  })
            // }
        },

    });
});