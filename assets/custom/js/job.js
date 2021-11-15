$(document).ready(function() {
	table.url = window.baseUrl+'job/get/jobs';

	table.columns = [
        { "data": "id", "title": "<input name='select_all' type='checkbox' id='ckbCheckAll'>" },
      	{ "data": "id", "title": "ID" },
        { "data": "status", "title": "Status" },				{ "data": "project_name", "title": "Name" },				{ "data": "type", "title": "Type" },
        { "data": "created_by", "title": "Created By" },
        { "data": "created_at", "title": "Created At" }
    ],
	table.columnDefs =  [	
      {
      "render": function ( data, type, row ) {
          return '<input name="id" value="'+data+'" class="checkBoxClass" type="checkbox">';
      },
      "targets": 0,
          "orderable": false
    },
  ];
	table.createDataTable();
	$(document).on('click','.edit-company',function () {
		thisObj = $(this);
		var url = thisObj.data('url');
		ajax.init();
		ajax.method ='get';
		ajax.url = url;
		ajax.ajaxCall(ajax.displayForm);
    // alert("jyukbjkjhdxrdytfulbjn");
    // $('.snehal').modal("hide");

    // $('#selectLeadOpp').hide();
    // $('#selectLeadOpp').fadeOut();
    // $('.updateActivity').modal("show");
	});			$(document).on('click', '#AddProjectBtn', function(e) {		$('#saveAs').html('Save & New');	$('#item_header').html('Add Item');    $('#AddProjectModal').modal("show");    $("#AddProjectModal").addClass("show");    $('#AddProjectModal').show();});$(document).on('click', '#AddProjectAction', function(e){    var form_data = new FormData();	var projects_types_id = $('#projects_types_id option:selected').val();	var projects_status_id = $('#projects_status_id option:selected').val();	var projects_name = $('#projects_name').val();    var bw_id = $("#bw_id").val();    //form_data.append("photo", document.getElementById('add_photo').files[0]);    form_data.append("projects_types_id", projects_types_id);	form_data.append("projects_status_id", projects_status_id);	form_data.append("name", projects_name);    $.ajax({        url: "jobs/addProjectAction",        method: "POST",        data: form_data,        contentType: false,        cache: false,        processData: false,        success: function(data) {            console.log(data);            var newData = JSON.parse(data);            $('#itemSuccessMessage').html(newData.message);                $("#add_room_type").val('');								$('.alert-danger').hide();				$('.alert-success').show();								$('#success').html(newData.message);							$('#globalModal').modal("show");				$("#globalModal").addClass("show");				$('#globalModal').show();				        }    });});
});
