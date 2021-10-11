$(document).ready(function() {
	table.url = window.baseUrl+'job/get/jobs';

	table.columns = [
        { "data": "job_id", "title": "<input name='select_all' type='checkbox' id='ckbCheckAll'>" },
      	{ "data": "job_name", "title": "Job Name" },
        { "data": "customer_contact", "title": "Customer Contact" },
        { "data": "converted_by", "title": "Converted By" },
        { "data": "converted_date", "title": "Converted Date" }
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
	});
});
