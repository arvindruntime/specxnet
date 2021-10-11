var g = null;
$(document).ready(function() {
  defaultView = [];
  defaultView['day'] =  'agendaDay';
  defaultView['week'] =  'agendaWeek';
  defaultView['month'] =  'month';
  if(window.moduleType == 'day' || window.moduleType == 'week' || window.moduleType =='month')
  {

    var calendar = $('#datatable').fullCalendar({
      defaultView: defaultView[window.moduleType],
      events: {
        url: window.baseUrl+'shedule/get/calendar',
        error: function() {
          alert('unable to get event');
        }
      }
    });
  } else if(window.moduleType == 'gantt-chart'){
    
    $.ajax({
      url: window.baseUrl+'shedule/get/gantt',
      dataType: 'json',
      type: 'post',
      processData: false,
      contentType: false,
      success: function (result) { 
        gantChart(result)
      },
      error: function () {
      }
    })



    function gantChart(data)
    {
      g = new JSGantt.GanttChart('g',document.getElementById('GanttChartDIV'), 'day');
      g.setShowRes(1); // Show/Hide Responsible (0/1)
      g.setShowDur(1); // Show/Hide Duration (0/1)
      g.setShowComp(1); // Show/Hide % Complete(0/1)
      g.setCaptionType('Resource');  // Set to Show Caption (None,Caption,Resource,Duration,Complete)
      g.setFormatArr("day")
      
      if(g) {
        for(var i in data) {
          row = data[i]
          g.AddTaskItem(new JSGantt.TaskItem(row['id'],  row['title'],    row['from'],  row['to'],  row['color'], 0, 0, 'Ilan',  100, 0, 1, 0));      
        }
      }

      g.Draw(); 
      g.DrawDependencies();

    }
  } else {
    table.url = window.baseUrl+'shedule/get/schedules/'+window.moduleType+window.customeFilter;
    table.columns = window.column;
    table.columnDefs =  [
    {
      "render": function ( data, type, row ) {
        console.log(row);
          return '<a href="#" class="edit-schedule" data-url="'+window.baseUrl+'schedule/form/'+row.id+'" data-toggle="modal" data-target="#modal">'+data+'</a>';
      },
      "targets": 0
    } 
    ];
    table.createDataTable();  
  }

  $(document).on('click','.edit-schedule',function () {
    thisObj = $(this);
    var url = thisObj.data('url');
    ajax.init();
    ajax.method ='get';
    ajax.url = url;
    ajax.ajaxCall(ajax.displayForm);
  });

  function excelUpload() {
        var name = document.getElementById("customFile").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['xls', 'xlsx', 'csv']) == -1) {
            $('.excel-upload-response').html('Invalid Excel File');
            return false;
        }
        if (name == '' || name == 'undefined') {
            $('.excel-upload-response').html('Please Select File First.');
            return false;
        }
        var rfq_id = $('#fk_b_id').val();
        form_data.append("uploadFile", document.getElementById('customFile').files[0]);
        //form_data.append("rfq_id", document.getElementById('rfq_id').value());
        //console.log(document.getElementById('customFile').files[0]);
        $.ajax({
            url: "rfq/importData/"+rfq_id,
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                    $('#importExcel').html("Excel Uploading...");
                    $('#importExcel').prop('disabled',true);
            },
            success: function (data) {
                var newData = JSON.parse(data);
                $('#importExcel').html("Upload");
                $('#validation_errors_upload_tab').html(newData.message);
                // $('#importExcel').prop('disabled',false);
                // if (newData.code == 200) {
                //     window.location.reload();
                // }
            }
        });
      }
  

   

});
