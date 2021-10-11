var ajax = {
	selectorName : 'form', 
	selector: '',
	method: 'post',
	data: [],
	dataType : 'json',
	url:'',
	formObj:null,
	init :  function(param=null) {
		ajax.formSubmit();
	},
	formSubmit : function() {
		$('button').on('click',function(e){
			ajax.clickButton = $(this).data('type');
		});
		$('form').on('submit',function(e){
			e.preventDefault();
			ajax.formObj= thisObj = $(this);
			ajax.data = thisObj.serialize();
			ajax.data = new FormData(thisObj[0]);
			ajax.method = thisObj.attr('method');
			ajax.url = thisObj.attr('action');
			ajax.ajaxCall(ajax.formSubmitResponse);
		});
	},
	ajaxCall: function(callBackMethod) {
		$.ajax({
            url: ajax.url,
            dataType: ajax.dataType,
            type: ajax.method,
            data: ajax.data,
            processData: false,
			contentType: false,
            success: function (result) { 
            },
            error: function () {
            }  

        }).then(function(data){
        	callBackMethod(data);
        	if(data.data.editor){
        		for(var i in data.data.editor){
        			CKEDITOR.replace(data.data.editor[i]);
        		}
        	}

        	

        	$('.datepicker').datepicker({
  				autoclose: true,
  				format: "dd-M-yyyy",
			});
			$('.select2').select2();
        });
	},
	displayForm: function(data) { 
		if (data.data.heading == 'No Permissions Access') {
			alert(data.data.heading);
			location.reload();
		} else {
			if(data.code == 200) {
				$('h5.form-modal-tile').html(data.data.heading);
				$('#modal').find('.modal-body').html(data.data.html);
				$(document).find('.datetimepickerRfq').datetimepicker({format: 'd-M-Y h:i'});
				ajax.formSubmit();
				// $(document).find("#range_weight").ionRangeSlider({
	   //          	min: 1,
	   //          	max: 100,
	   //          	from: 5
	   //      	});
	        	$('button').on('click',function(e){
					ajax.clickButton = $(this).data('type'); 
				});
	        	$(document).find("#m_datepicker_modal").datepicker({rtl:mUtil.isRTL(),todayBtn:"linked",clearBtn:!0,todayHighlight:!0})
				//bootstrap WYSIHTML5 - text editor
				CKEDITOR.replace('message_signature');
				CKEDITOR.replace('description');
			}
		}	
	},
	formSubmitResponse : function(data) {console.log(ajax.clickButton);
		if (data.error) {
			$(document).find("#validation_errors").html(data.error);
			ajax.formObj.parents('.modal').find('#validation_errors').html(data.error);
		} else {
			if(ajax.clickButton == 'save') {
				location.reload();
			} else if(ajax.clickButton == 'save_n_close'){
				ajax.formObj.parents('.modal').find('#validation_errors').html(data.message);
				ajax.resetForm();
				if (window.moduleType == 'leadOpportunity') {
					$("#priLeadOppId").val(data.data);
				}
			} else if (ajax.clickButton == 'convetToJob') {
				ajax.convertToJob(data);
			}
		}
	},
	resetForm : function() {
		ajax.formObj[0].reset();
	},

	convertToJob: function(data) {
		if(data.code == 200 && data.lead_id !='') {
			ajax.url = 'lead/convertToJob';
			dataString = 'value='+data.lead_id;
			$.ajax({
			  type: "POST",
			  url: ajax.url,
			  data: dataString,
			  success: function(data){
			    location.reload();
			  },
			  error: function() { alert("Error Deleting User."); }
			  
			});
		}	
	},
	getExistUser: function(data) {
		alert("ajax call for exist");
		if(data.code == 200) {
			$('#modal').find('.modal-body').html(data.data.html);
			('#select_existing').hide();
			var OpportunityID = "<input type='text' name='userID' value='" + existUsrID + "'/><br/><br/>";
        	$("#leadDetailsExist").append(OpportunityID);
			ajax.formSubmit();
		}	
	},
	updateActivity: function(data) {
		if (data.data.heading == 'No Permissions Access') {
			alert(data.data.heading);
			location.reload();
		} else {
			if(data.code == 200) {
				$('#modal').find('.modal-body').html(data.data.html);
				$('#selectLeadOpp').hide();
				$('#addLeadActivity').show();

				ajax.formSubmit();
				$('h5.form-modal-tile').html(data.data.heading);
				CKEDITOR.replace('description');
			}
		}
	},
	sendEmail: function(data) {
		if(data.code == 200) {
			$('#modal').find('.modal-body').html(data.data.html);
			$('#selectLeadOpp').hide();
			$('#addLeadActivity').show();

			ajax.formSubmit();
			$('h5.form-modal-tile').html(data.data.heading);
		}	
	},
	gridViewData: function(data) {
		if(data.code == 200) {
			if(data.data.columns) {
				$('#gridView').modal('hide');
				table.destroyDataTable();
				table.columns = data.data.columns;
				$('#datatable').html('');
				table.createDataTable();
			}

			if(data.data.options) {
				var html = '<option value="">Select View</option>';
				for (var i = 0; i < data.data.options.length; i++) {
					var selected = (data.data.options[i].grid_id == data.data.gridId)?'selected':''; 
					html+='<option value="'+data.data.options[i].grid_id+'" '+selected+'>'+data.data.options[i].grid_name+'</option>'
				}
				$('.gridView').html(html);
			}

		}
	},
	displayFormProposal: function(data){
		if (data.data.heading == 'No Permissions Access') {
			alert(data.data.heading);
			location.reload();
		} else {
			if(data.code == 200) {
				$('#modal').find('.modal-body').html(data.data.html);
				ajax.formSubmit();
				$(document).find("#range_weight").ionRangeSlider({
	            	min: 1,
	            	max: 100,
	            	from: 5
	        	});
	        	$('button').on('click',function(e){
					ajax.clickButton = $(this).data('type'); 
				});
	        	$(document).find("#m_datepicker_modal").datepicker({rtl:mUtil.isRTL(),todayBtn:"linked",clearBtn:!0,todayHighlight:!0})
				$('h5.form-modal-tile').html(data.data.heading);
				var fk_pid = $("#fk_pid").val();
	        	datastring = {fk_pid : fk_pid};
	        	table.proposalPopupTable(datastring);
	        	CKEDITOR.replace('format_header');
			    CKEDITOR.replace('format_footer');
			    CKEDITOR.replace('description');
			}
		}
	},
	displayFormRfq: function(data){
		if(data.code == 200) {
			$('#modal').find('.modal-body').html(data.data.html);
			ajax.formSubmit();
			$(document).find("#range_weight").ionRangeSlider({
            	min: 1,
            	max: 100,
            	from: 5
        	});
        	$('button').on('click',function(e){
				ajax.clickButton = $(this).data('type'); 
			});
        	$(document).find("#m_datepicker_modal").datepicker({rtl:mUtil.isRTL(),todayBtn:"linked",clearBtn:!0,todayHighlight:!0})
			$('h5.form-modal-tile').html(data.data.heading);
			var fk_b_id = $("#fk_b_id").val();
        	datastring = {fk_b_id : fk_b_id};
        	table.rfqPopupTable(datastring);
		}
	},
	displayFormActivity: function(data){
		if (data.data.heading == 'No Permissions Access') {
			alert(data.data.heading);
			location.reload();
		} else {
			if(data.code == 200) {
				$('#modal').find('.modal-body').html(data.data.html);
				$(document).find('.datetimepickerRfq').datetimepicker({format: 'd-M-Y h:i'});
				ajax.formSubmit();
				$(document).find("#range_weight").ionRangeSlider({
	            	min: 1,
	            	max: 100,
	            	from: 5
	        	});

	        	$('button').on('click',function(e){
					ajax.clickButton = $(this).data('type'); 
				});
				$('h5.form-modal-tile').html(data.data.heading);
				var lop_id = $("#priLeadOppId").val();
	        	datastring = {lead_opportunity_id : lop_id};
	        	table.activityPopupTable(datastring);
	        	table.leadproposalPopupTable(datastring);
	        	var fk_b_id = $('#fk_b_id').val();
			    datastring = {fk_b_id : fk_b_id};
			    if (fk_b_id) {
			    	table.rfqPopupTable(datastring);
			    	CKEDITOR.replace('format_header');
			    	CKEDITOR.replace('format_footer');
			    	CKEDITOR.replace('description');
			    }
			} else {
				var fk_b_id = $('#fk_b_id').val();
			    datastring = {fk_b_id : fk_b_id};
			    if (fk_b_id) {
			    	table.rfqPopupTable(datastring);
			    	CKEDITOR.replace('format_header');
			    	CKEDITOR.replace('format_footer');
			    	CKEDITOR.replace('description');
			    }
			}
		}
	},
	displayuploadBid: function(data){

		if(data.code == 200) {
			$('#modal').find('.modal-body').html(data.data);
		}
	},
	displayRfqResponse: function(data){
		
		if(data.code == 200) {
			$('#modal').find('.modal-body').html(data.data.html);
			ajax.formSubmit();
			// $(document).find("#range_weight").ionRangeSlider({
   //          	min: 1,
   //          	max: 100,
   //          	from: 5
   //      	});

			$('h5.form-modal-tile').html(data.data.heading);
		}
	},
	approveRFQ: function(data){ alert('HHH');
		
		if(data.code == 200) {
			$('#modal2').find('.newBody').html(data.data.html);
			ajax.formSubmit();
			// $(document).find("#range_weight").ionRangeSlider({
   //          	min: 1,
   //          	max: 100,
   //          	from: 5
   //      	});

			$('formTitle').html(data.data.heading);
		}
	}
}
