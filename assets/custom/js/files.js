$(document).ready(function() {
	debugger
	console.log(window.folderType);
  table.url = window.baseUrl+'files/get/files/'+window.folderType+window.customeFilter;
	table.columns = window.column,
	table.columnDefs =  [
		{
			"render": function ( data, type, row ) {
    			return '<input name="id" value="'+data+'" class="checkBoxClass checkbox-action" type="checkbox">';
			},
			"targets": 0,
      "orderable": false
		},
		{
			"render": function ( data, type, row ) {
				if(row.file_type=='Photo')
				{
					return '<a href="#" class="edit-company" data-url="'+window.baseUrl+'files/form/'+window.folderType+'/'+row.file_id+'" data-toggle="modal" data-target="#modal"><i class="fa fa-file-image"></i> '+data+'</a>';
				}
				else if(row.file_type=='Video')
				{
    			return '<a href="#" class="edit-company" data-url="'+window.baseUrl+'files/form/'+window.folderType+'/'+row.file_id+'" data-toggle="modal" data-target="#modal"><i class="fa fa-video-camera"></i> '+data+'</a>';
				}
				else
				{
				return '<a href="#" class="edit-company" data-url="'+window.baseUrl+'files/form/'+window.folderType+'/'+row.file_id+'" data-toggle="modal" data-target="#modal"><i class="fas fa-file"></i> '+data+'</a>';
				}
			},
			"targets": 1
		},
    {
			"render": function ( data, type, row ) {
				
				return data;
			},
			"targets": 2
		},
	{
			"render": function ( data, type, row ) {
				
				return data;
			},
			"targets": 3
		}
    ];
	table.createDataTable();
	console.log(table);
	$(document).on('click','.edit-company',function () {
		thisObj = $(this);
		var url = thisObj.data('url');
		ajax.init();
		ajax.method ='get';
		ajax.url = url;
		ajax.ajaxCall(ajax.displayForm);
	});

    // Add tab functionalities to call from user page
    for(var i=0;i<window.moduleTabs.length;i++) {
        if(window.moduleTabs[i] == 'GridView') {
            GridView();
        }else if(window.moduleTabs[i] == 'Freez') {
            Freez();
        }
    }
  $('#exportExcel').click(function() {
  		var list = $('#deleteRows').val();
  		var arr = list.split(",");
        var fst = arr.splice(0,1).join("");
        var rest = arr.join("_");
        var res = confirm("Do You Want To Export Selected Data Into Excel ?");
        if (rest == '') {
        	alert('Please select atleast 1 record !');
        } else if (res) {
        	window.location.href = window.baseUrl+'folders/createExcel/'+window.folderType;  
        }
    });

});


/*function checkDoc() {
    if (document.getElementById("checkDocuments").checked == true) {
        document.getElementById('doc_type_name').disabled = true;
        document.getElementById('doc_type_text').disabled = true;
        document.getElementById('doc_type_file').disabled = true;
    }
    else {
        document.getElementById('doc_type_name').disabled = false;
        document.getElementById('doc_type_text').disabled = false;
        document.getElementById('doc_type_file').disabled = false;
    }
}*/

/*function checkDocType(val) {
    if (val =='TextBox') {
       document.getElementById("add_doc").style.display = "block";
       document.getElementById("doc_type_text").style.display = "block";
       document.getElementById("doc_type_file").style.display = "none";
    } else if (val =='File') {
        document.getElementById("add_doc").style.display = "block";
        document.getElementById("doc_type_text").style.display = "none";
        document.getElementById("doc_type_file").style.display = "block";
    } else {
        document.getElementById("add_doc").style.display = "none";
        document.getElementById("doc_type_text").style.display = "none";
        document.getElementById("doc_type_file").style.display = "none";
    }
    
}*/

/**
  * Script to display country code in front of business contact textbox after selecting country.
  * @author Sagar Kodalkar
  */ 

/*function getCountryCode(val) {
    var str = val.split("-");
    var dialing_code = str[1];
    var countryCode = '+'+str[1];
    var country = str[0];
    document.getElementById("dialing_code").value = countryCode;
    var request = new XMLHttpRequest();
    request.open("GET", "company/getCompanyIdentifier/"+dialing_code);

    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if(this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            document.getElementById("replaceIdentifier").innerHTML = this.responseText;
        }
    };

    // Sending the request to the server
    request.send();
}*/

// Add tab functionalities to call from user page
    // for(var i=0;i<window.moduleTabs.length;i++) {
    //     if(window.moduleTabs[i] == 'GridView') {
    //         GridView();
    //     }else if(window.moduleTabs[i] == 'Freez') {
    //         Freez();
    //     }
    // }

$(function()
    {
        // start : select all  recod for delete and send email //
       $(document).on('click', '#ckbCheckAll', function(e)
       {
        $(".checkBoxClass").prop('checked', $(this).prop("checked")); 
        var favoriteDelete = ["delete"];
            $.each($("input[name='id']:checked"), function(){   
              favoriteDelete.push($(this).val());
          });

        var favoriteEmail = ["email"];
          $.each($("input[name='id']:checked"), function(){   
            favoriteEmail.push($(this).val());
        });

            var ChackedValuesDelete = favoriteDelete.join(",");
            var ChackedValuesEmail = favoriteEmail.join(",");
            if(this.checked) {
              // Enable #x
              $( "#checkedAction" ).prop( "disabled", false );
              $('.checked_action').addClass('activeData');
              } else {
                  $('.checked_action').removeClass('activeData');
                  // Disable #x
                  $( "#checkedAction" ).prop( "disabled", true );
            }
            $('#sendEmail').val(ChackedValuesEmail);
            $('#deleteRows').val(ChackedValuesDelete);
       })
       // end : select all recod for delete and send email //


       // start : select single recod for delete and send email //
       $(document).on('click', '.checkBoxClass', function(e)
       { 
        var favoriteDelete = ["delete"];
            $.each($("input[name='id']:checked"), function(){   
              favoriteDelete.push($(this).val());
          });

            if(this.checked) {
              // Enable #x
              $( "#checkedAction" ).prop( "disabled", false );
              $('.checked_action').addClass('activeData');
              } else {
                  $('.checked_action').removeClass('activeData');
                  // Disable #x
                  $( "#checkedAction" ).prop( "disabled", true );
            }

        var favoriteEmail = ["email"];
          $.each($("input[name='id']:checked"), function(){   
            favoriteEmail.push($(this).val());
            $( "#checkedAction" ).prop( "disabled", false );
            $('.checked_action').addClass('activeData');
        });
            var ChackedValuesDelete = favoriteDelete.join(",");
            var ChackedValuesEmail = favoriteEmail.join(",");
            
            $('#sendEmail').val(ChackedValuesEmail);
            $('#deleteRows').val(ChackedValuesDelete);

       })
       // end : select single recod for delete and send email //
     
    $(document).on('change', '#checkedAction', function(e)
       { 
        var deactivateids = this.value; 
        var arr = deactivateids.split(",");
        var fst = arr.splice(0,1).join("");
        var rest = arr.join(",");        
        if(fst == "delete"){
          var toBeDelete = 'deleteThis=' + rest;
          var answer = confirm("Are you sure you want to delete record! NOTE: If this is a parent folder, child folder will also get deleted");
          ajax.url = window.baseUrl+'folders/deleteFolder';
          if (answer) {
              $.ajax({
                  type: "POST",
                  url: ajax.url,
                  data: toBeDelete,
                  success: function(data){
                           window.location.reload();                     
                   },
                   error: function() { alert("Error Deleting User."); }
              });
          }
          else {
              window.location.reload();
          } 
        }
        /*if(fst == "email"){
          var toBeDelete = 'getEmail=' + rest;
          ajax.url = window.baseUrl+'Company/getEmailIds';
          
          $.ajax({
              type: "POST",
              url: ajax.url,
              data: toBeDelete,
              success: function(data){
                $('#role_new_modal').modal('show');
                $('#emailIdUsr').val(data);                     
              },
              error: function() 
              { 
                alert("Error Deleting User."); 
              }
              
          });
           
        }   */      
       })


     /* $(document).on('click', '#sendmailtousers', function(e)
       { e.preventDefault();
        var userEmail = $("#emailIdUsr").val();
        var userSubject = $("#emailSubject").val();
        var userMessage = $("#msgEeditor").html(); 

        var dataString = 'usrEmail=' + userEmail +'&usrSub=' + userSubject + '&usrMsg=' + userMessage 
        // alert(dataString);
        ajax.url = window.baseUrl+'company/sendBulkEmail';
        alert(ajax.url);
          $.ajax({
              type: "POST",
              url: ajax.url,
              data: dataString,
              success: function(data){
                  if (data == '200') {
                     var msg = "<div class='alert alert-success'><strong>Success!</strong> Email Send Successfully</div>";
                     $('#validation_errors').html(msg);
                     window.location.reload();
                 } else {
                     $('#validation_errors').html(data);
                 }
                 window.location.reload();
              },
              error: function() 
              { 
                alert("Error Deleting User."); 
              }
                   // error: function() { alert("Error Deleting User."); }
              
          });
       
       })*/
    });


$(document).ready(function() {
        $("#txtEditor").Editor();
});


/*$(function() 
    {
       $(document).on('click', '#savefilter', function(e)
       {
          $('#mySaveFilterModal').modal('show');
       })
       $(document).on('click', '#saveMyFilter', function(e)
       {
          $('#mySaveFilterModal').modal('show');
          var filterName = $("#filter_name").val();
          var parentCompany = $("#filter_parent_company_id"). val();
          var companyName = $("#filter_company_name"). val();
          var businessContact = $("#filter_bussiness_contact"). val();
          var city = $("#filter_city"). val();
          var state = $("#filter_state"). val();
          var country = $("#filter_country"). val();
          
          var dataString = 'filterName=' + filterName +'&parentCompany=' + parentCompany + '&companyName=' + companyName + '&businessContact=' + businessContact + '&city=' + city + '&state=' + state + '&country=' + country
          // alert(dataString);
          ajax.url = window.baseUrl+'company/savefilter';
        // alert(ajax.url);
          $.ajax({
              type: "POST",
              url: ajax.url,
              data: dataString,
              success: function(data){
                var newData = JSON.parse(data);
                  if (newData.code == '200') {
                     $('#validation_errors_filter_message').html(newData.message);
                     //window.location.reload();
                 } else {
                     $('#validation_errors_filter_message').html(newData.message);
                 }
              },
              error: function() { alert("Error Deleting User."); }
              
          });
       })
    });

$(function() 
    {
    $(document).on('change', '#filterListData', function(e)
      { 
        // alert(this.value); 
        var filterResult = this.value; 
        var arr = filterResult.split(",");
        var fst = arr.splice(0,1).join("");
        var rest = arr.join(",");
        obj = JSON.parse(rest);

        var filterResComName = obj.companyName;
        var filterResParentComp = obj.parentCompany;
        var filterResBusinesContact = obj.businessContact;
        var filterResCity = obj.city;
        var filterResState = obj.state;
        var filterResCountry = obj.country;

        $('#filter_company_name').val(filterResComName);
        $('#filter_parent_company_id').val(filterResParentComp);
        $('#filter_bussiness_contact').val(filterResBusinesContact);
        $('#filter_city').val(filterResCity);
        $('#filter_state').val(filterResState);
        $('#filter_country').val(filterResCountry);
        $('#saved_filter_id').val(fst);
                
      })
   });

//---- To Import Excel Data-----------------------
$(document).ready(function () {
    $('#excelUpload').on('submit',function(e){
        e.preventDefault();
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
        form_data.append("file", document.getElementById('customFile').files[0]);
        //console.log(document.getElementById('customFile').files[0]);
        $.ajax({
            url: "company/importData",
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
              console.log(data);
                var newData = JSON.parse(data);
                $('#importExcel').html("Upload");
                $('.excel-upload-response').html(newData.message);
                $('#importExcel').prop('disabled',false);
                if (newData.code == 200) {
                    window.location.reload();
                }
            }
        });
    });
});

function deleteFile(val) {
	res = confirm("Do you want to delete this file ?");
	if (res) {
		dataString = 'company_id='+val;
		$.ajax({
            url: "company/deleteAttachFile",
            method: "POST",
            data: dataString,
            success: function (data) {
            	$('#replaceAddImage').html(data);
            }
        });
	}

}

function deleteLiableCertificateFile(val) {
  res = confirm("Do you want to delete this file ?");
  if (res) {
    dataString = 'company_id='+val;
    $.ajax({
            url: "company/deleteAttachLiabilityFile",
            method: "POST",
            data: dataString,
            success: function (data) {
              $('#replaceLiabilityImage').html(data);
            }
        });
  }

}

function deleteWorkmanCertificateFile(val) {
  res = confirm("Do you want to delete this file ?");
  if (res) {
    dataString = 'company_id='+val;
    $.ajax({
            url: "company/deleteAttachWorkmanFile",
            method: "POST",
            data: dataString,
            success: function (data) {
              $('#replaceWorkmanImage').html(data);
            }
        });
  }

}

function closeSaveFilter() {
  $('#mySaveFilterModal').modal('hide');
  ajax.url = 'company/getSavedFilterDropdown';
  dataString = 'companyType='+window.companyType;
  $.ajax({
      type: "POST",
      url: ajax.url,
      data: dataString,
      success: function(data){
        $('#getFilter').html(data);
      },
      error: function() { alert("Error Deleting User."); }
      
  });
}*/
