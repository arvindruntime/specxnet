$(document).ready(function() {

    // remove unwanted comment from a code

    table.url = window.baseUrl + 'user/get/users/' + window.userType + window.customeFilter;

    // Bimal Sharma

    // now column added from user library

    table.columns = window.column;

    table.columnDefs = [

        {

            "render": function(data, type, row) {

                return '<input name="id" value="' + data + '" class="checkBoxClass" type="checkbox">';

            },

            "targets": 0,

            "orderable": false

        },

        {

            "render": function(data, type, row) {

                return '<a href="#" class="edit-company" data-url="' + window.baseUrl + 'user/form/' + window.userType + '/' + row.user + '" data-toggle="modal" data-target="#modal">' + data + '</a>';

            },

            "targets": 1

        }

    ];

    table.createDataTable();

    $(document).on('click', '.edit-company', function() {

        thisObj = $(this);

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayForm);

    });



    // Add tab functionalities to call from user page

    for (var i = 0; i < window.moduleTabs.length; i++) {

        if (window.moduleTabs[i] == 'GridView') {

            GridView();

        } else if (window.moduleTabs[i] == 'Freez') {

            Freez();

        }

    }

    $(document).on('click', '#UsrActi', function(e) {
        if ($(this).is(':checked')) {
            switchStatus = $(this).is(':checked');
            $("#UsrActi").val('active');
        } else {
            switchStatus = $(this).is(':checked');
            $("#UsrActi").val('inactive');
        }
    });


    $('#exportExcel').click(function() {

        var list = $('#deleteRows').val();

        var arr = list.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join("_");

        var rest = rest.trim();

        var res = confirm("Do You Want To Export Selected Data Into Excel ?");

        if (rest == '') {

            alert('Please select atleast 1 record !');

        } else if (res) {

            window.location.href = window.baseUrl + 'users/createExcel/' + window.userType + '/' + rest;

        }

    });



});



$(function() {

    // start : select all  recod for delete and send email //

    $(document).on('click', '#ckbCheckAll', function(e) {

        $(".checkBoxClass").prop('checked', $(this).prop("checked"));

        var favoriteDelete = ["delete"];

        $.each($("input[name='id']:checked"), function() {

            favoriteDelete.push($(this).val());

        });

        var favoritePermDelete = ["permDelete"];

        $.each($("input[name='id']:checked"), function() {

            favoritePermDelete.push($(this).val());

        });



        var favoriteEmail = ["email"];

        $.each($("input[name='id']:checked"), function() {

            favoriteEmail.push($(this).val());

        });

        if (this.checked) {

            // Enable #x

            $("#checkedAction").prop("disabled", false);

            $('.checked_action').addClass('activeData');

        } else {

            $('.checked_action').removeClass('activeData');

            // Disable #x

            $("#checkedAction").prop("disabled", true);

        }

        var ChackedValuesDelete = favoriteDelete.join(", ");

        var ChackedValuesEmail = favoriteEmail.join(", ");
        var ChackedValuesPermDelete = favoritePermDelete.join(",");

        $('#checkedAction').val('Checked Action');

        $('#sendEmail').val(ChackedValuesEmail);
        $('#permanentDeleteRows').val(ChackedValuesPermDelete);

        $('#deleteRows').val(ChackedValuesDelete);

    })

    // end : select all recod for delete and send email //





    // start : select single recod for delete and send email //

    $(document).on('click', '.checkBoxClass', function(e) {

        var favoriteDelete = ["delete"];

        $.each($("input[name='id']:checked"), function() {

            favoriteDelete.push($(this).val());

        });

        var favoritePermDelete = ["permDelete"];

        $.each($("input[name='id']:checked"), function() {

            favoritePermDelete.push($(this).val());

        });

        if (this.checked) {

            // Enable #x

            $("#checkedAction").prop("disabled", false);

            $('.checked_action').addClass('activeData');

        } else {

            $('.checked_action').removeClass('activeData');

            // Disable #x

            $("#checkedAction").prop("disabled", true);

        }



        var favoriteEmail = ["email"];

        $.each($("input[name='id']:checked"), function() {

            favoriteEmail.push($(this).val());

            $("#checkedAction").prop("disabled", false);

            $('.checked_action').addClass('activeData');

        });





        var ChackedValuesDelete = favoriteDelete.join(", ");
        var ChackedValuesPermDelete = favoritePermDelete.join(",");

        var ChackedValuesEmail = favoriteEmail.join(", ");

        $('#checkedAction').val('Checked Action');

        $('#sendEmail').val(ChackedValuesEmail);

        $('#deleteRows').val(ChackedValuesDelete);
        $('#permanentDeleteRows').val(ChackedValuesPermDelete);



    })

    // end : select single recod for delete and send email //



    $(document).on('change', '#checkedAction', function(e) {

        var deactivateids = this.value;

        var arr = deactivateids.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join(",");

        if (fst == "delete") {

            var toBeDelete = 'deleteThis=' + rest;

            var answer = confirm("Are you sure you want to delete record!");

            ajax.url = window.baseUrl + 'users/deleteUser';

            if (answer) {

                $.ajax({

                    type: "POST",

                    url: ajax.url,

                    data: toBeDelete,

                    success: function(data) {

                        window.location.reload();

                    },

                    error: function() { alert("Error Deleting User."); }

                });

            } else {

                window.location.reload();

            }

        }
        if (fst == "permDelete") {

            var toBeDelete = 'deleteThis=' + rest;
            var answer = confirm("Are you sure you want to delete record Permanently!");

            ajax.url = window.baseUrl + 'users/permDeleteUActivity';

            if (answer) {

                $.ajax({

                    type: "POST",

                    url: ajax.url,

                    data: toBeDelete,

                    success: function(data) {
                        window.location.reload();

                    },

                    error: function() { alert("Error Deleting User."); }

                });

            } else {

                window.location.reload();

            }

        }
        if (fst == "email") {

            var toBeDelete = 'getEmail=' + rest;

            ajax.url = window.baseUrl + 'users/getEmailIds';



            $.ajax({

                type: "POST",

                url: ajax.url,

                data: toBeDelete,

                success: function(data) {

                    $('#role_new_modal').modal('show');

                    $('#emailIdUsr').val(data);

                    CKEDITOR.replace('txtEditor');

                },

                error: function() {

                    alert("Error Deleting User.");

                }



            });



        }

    })





    // $(document).on('click', '#sendmailtousers', function(e)

    //    { e.preventDefault();

    //     var userEmail = $("#emailIdUsr").val();

    //     var userEmailCC = $("#add_cc").val();

    //     var userEmailBCC = $("#add_bcc").val();

    //     var userSubject = $("#emailSubject").val();

    //     var userMessage = $("#txtEditor").html(); 



    //     var dataString = 'usrEmail=' + userEmail +'&usrCC=' + userEmailCC +'&usrBCC=' + userEmailBCC +'&usrSub=' + userSubject + '&usrMsg=' + userMessage;

    //     ajax.url = window.baseUrl+'users/sendBulkEmail';

    //       $.ajax({

    //           type: "POST",

    //           url: ajax.url,

    //           data: dataString,

    //           success: function(data){

    //               if (data == '200') {

    //                  var msg = "<div class='alert alert-success'><strong>Success!</strong> Email Send Successfully</div>";

    //                  $('#validation_errors').html(msg);

    //                  //window.location.reload();

    //              } else {

    //                  $('#validation_errors').html(data);

    //              }

    //              //window.location.reload();

    //           },

    //           error: function() 

    //           { 

    //             alert("Error Deleting User."); 

    //           }

    //                // error: function() { alert("Error Deleting User."); }



    //       });



    //    })

});



$(document).on('click', '.delete_top2', function(e) {

    var res = confirm("Are You Sure, You Want To Delete This Contact ?");

    if (res) {

        var filterResult = this.value;

        var toBeDelete = 'deleteThis=' + filterResult;

        ajax.url = window.baseUrl + 'users/deleteusercontact';

        $.ajax({

            type: "POST",

            url: ajax.url,

            data: toBeDelete,

            success: function(data) {

            },

            error: function() {

                alert("Error Deleting User Contact.");

            }



        });

    }

})



// $(document).ready(function() {

//         $("#txtEditor").Editor();





// });

$(function() {

    $(document).on('click', '#savefilter', function(e) {

        $('#mySaveFilterModal').modal('show');

    })

    $(document).on('click', '#saveMyFilter', function(e) {

        $('#mySaveFilterModal').modal('show');

        var filterName = $("#filter_name").val();

        var full_name = $("#filterfullname").val();

        //var last_name = $("#filterlastName").val();

        // var designation = $("#filterdesignation").val();

        var roleId = $("#filterRoleId").children("option:selected").val();

        var userStatus = $("#filterStatus").children("option:selected").val();

        var designation = $("#filterDesignation").val();

        // var city = $("#filter_city"). val();

        // var state = $("#filter_state"). val();

        // var country = $("#filter_country"). val();



        var dataString = 'filterName=' + filterName + '&full_name=' + full_name + '&userStatus=' + userStatus + '&roleId=' + roleId + '&designation=' + designation

        // console.log(dataString);

        ajax.url = window.baseUrl + 'users/savefilter';

        // alert(ajax.url);

        $.ajax({

            type: "POST",

            url: ajax.url,

            data: dataString,

            success: function(data) {

                var newData = JSON.parse(data);

                if (newData.code == '200') {

                    $('#validation_errors_filter_message').html(newData.message);
                    $("#filter_name").val("");
                    closeSaveFilter();
                    //window.location.reload();

                } else {

                    $('#validation_errors_filter_message').html(newData.message);

                }

            },

            error: function() { alert("Error Saving Filter."); }



        });

    })

});



$(function() {

    $(document).on('change', '#filterListData', function(e) {

        var filterResult = this.value;
        // console.log(filterResult);
        var arr = filterResult.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join(",");

        obj = JSON.parse(rest);
        // console.log(obj);


        var full_name = obj.full_name;

        var userStatus = obj.userStatus;

        var roleId = obj.roleId;

        var designation = obj.designation;

        // $('#filterfirstName').val(first_name);

        $('#filterfullname').val(full_name);

        $('#filterStatus').val(userStatus);

        $('#filterRoleId').val(roleId);

        $('#filterDesignation').val(designation);

        $('#saved_filter_id').val(fst);

    })



    $(document).on('change', '#gridsort', function(e) {



    })



});



$(document).ready(function() {

    $("select.filter").change(function() {

        var selectedfilter = $(this).children("option:selected").val();

        var dataString = 'filter_id=' + selectedfilter;

        $.ajax({

            type: "POST",

            url: window.baseUrl + "proposal/filter/get",

            data: dataString,

            cache: false,

            success: function(html) {

                $('#replaceFilter').html(html);

            }

        });

    });

});







$(function() {

    var x1 = 1; //initlal text box count

    $(document).on('click', '#usrContactAdd', function(e) {

        //   debugger

        //   e.preventDefault();

        //   var controlForm = $('#myRepeatingFields:first'),

        //     currentEntry = $(this).parents('.entry:first'),

        //     newEntry = $(currentEntry.clone()).appendTo(controlForm);

        //       newEntry.find('input').val('');

        //       controlForm.find('.entry:not(:last) .btn-add')

        //     .removeClass('btn-add').addClass('btn-remove')

        //     .removeClass('btn-success').addClass('btn-danger')

        //     .html('<span> <i class="la la-remove" style="height:14px"></i> <span><i  class="la la-remove></i></span> </span>');

        // }).on('click', '.btn-remove', function(e)

        // {

        //   e.preventDefault();

        //   $(this).parents('.entry:first').remove();

        //   return false;

        // });

        var wrapper_property = $("#cloneThisCt"); //Fields wrapper

        var add_button_property = $("#usrContactAdd"); //Add button ID





        // $(add_button_property).click(function(e){ //on add input button click

        //debugger

        // e.preventDefault();

        //max input box allowed

        x1++; //text box increment

        // $(wrapper_property).append('<div><div class="entry input-group form-group  m-form__group row"><div class=" col-lg-4 col-md-4 col-sm-12"><input type="text" name="contact_detail[]" class="form-control m-input"></div><div class=" col-lg-4 col-md-4 col-sm-12"><select class="form-control" id="m_notify_state" name="contact_type[]" style="height: 30px !important"><option value="success">Email</option><option value="danger">Phone</option></select></div></div>' +'<a href="#" id="remove" style="float:right;margin-top:-35px; margin-right:30%;position:relative; z-index:2"><span class="input-group-btn"><button type="button" class="btn-sm btn m-btn--icon btn-remove btn-danger"><span> <i class="la la-remove" style="height:4px"></i> <span></span></span></button></span></a></div>');

        var divId = Math.round(new Date().getTime() + (Math.random() * 100));



        $(wrapper_property).append('<div class="entry-row" id="' + divId + '"><div class="entry input-group form-group  m-form__group row"><div class=" col-lg-4 col-md-4 col-sm-12"><input type="text" name="contact_detail[]" class="form-control m-input"></div><div class=" col-lg-4 col-md-4 col-sm-12"><select class="form-control" id="m_notify_state" name="contact_type[]" style="height: 30px !important"><option value="success">Email</option><option value="danger">Phone</option><option value="warn">Mobile</option></select></div></div>' + '<a href="#" id="remove" style="float:right;margin-top:-44px; margin-right:30%;position:relative; z-index:2" class="mob-cross"><span class="input-group-btn"><button type="button" class="btn-sm btn m-btn--icon btn-remove btn-danger"><span> <i class="la la-remove" style="height:14px"></i> <span></span></span></button></span></a></div>');



        // });

    });



});



$(document).on("click", "#remove", function(e) {

    e.preventDefault();

    // $(this).parent('div').remove(); 

    x1--;

});



$(document).on("click", ".btn-danger", function(e) {

    e.preventDefault();

    // // alert($(this).parents('div').attr('id'));

    // var pardiv = $(this).parents('div').attr('id');

    $(this).parents('.entry-row').remove();

    // $('#"'+pardiv+'"').empty();

    x1--;

});



//---- To Import Excel Data-----------------------

$(document).ready(function() {

    $('#excelUpload').on('submit', function(e) {

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

            url: window.baseUrl + "users/importData/" + window.userType,

            method: "POST",

            data: form_data,

            contentType: false,

            cache: false,

            processData: false,

            beforeSend: function() {

                $('#importExcel').html("Excel Uploading...");

                $('#importExcel').prop('disabled', true);

            },

            success: function(data) {

                var newData = JSON.parse(data);

                $('#importExcel').html("Upload");

                $('.excel-upload-response').html(newData.message);

                $('#importExcel').prop('disabled', false);

                if (newData.code == 200) {

                    window.location.reload();

                }

            }

        });

    });

});



function closeSaveFilter() {

    $('#mySaveFilterModal').modal('hide');

    ajax.url = window.baseUrl + 'users/getSavedFilterDropdown';

    dataString = 'users=users';

    $.ajax({

        type: "POST",

        url: ajax.url,

        data: dataString,

        success: function(data) {

            $('#getFilter').html(data);

        },

        error: function() { alert("Error Deleting User."); }



    });

}





$(document).on('click', '#emailNotifications', function(e) {

    if (this.checked) {

        $(".emailcheck").prop('checked', true);

    } else {

        $(".emailcheck").prop("checked", false);

    }



})



$(document).on('click', '#addDept', function(e) {

    var getVal = $("#deptId").val();

    ajax.url = window.baseUrl + 'users/getDepartment';

    dataString = 'value=' + getVal;

    $.ajax({

        type: "POST",

        url: ajax.url,

        data: dataString,

        success: function(data) {

            if (getVal == 'addNew') {

                $('#addDept').html('Go Back ?');

                $('#deptId').val('goBack');

            } else {

                $('#addDept').html('Add New ?');

                $('#deptId').val('addNew');

            }

            $('#setDepartment').html(data);

        },

        error: function() { alert("Error Deleting User."); }



    });



})



function getJobList(user_id = 0) {

    ajax.url = window.baseUrl + 'users/getUsersJob';

    dataString = 'users=users&user_id=' + user_id;

    $.ajax({

        type: "POST",

        url: ajax.url,

        data: dataString,

        success: function(data) {

            $('#m_portlet_base_demo_14_tab_content').html(data);

        },

        error: function() { alert("Error Deleting User."); }



    });

}



$('.form_datetime').datetimepicker({

    //language:  'fr',

    weekStart: 1,

    todayBtn: 1,

    autoclose: 1,

    todayHighlight: 1,

    startView: 2,

    forceParse: 0,

    showMeridian: 1

});





$(document).on('click', '#setDateTime', function(e) {

    if (this.checked) {

        $("#draft_time").css({ "display": "block" });

    } else {

        $("#draft_time").css({ "display": "none" });

    }



})



// $(document).ready(function() {

//   if (!Modernizr.touch || !Modernizr.inputtypes.date) {

//     $('input[type="datetime-local"]').each(function() {

//       var defaultVal = $(this).val();

//       // console.log(this.name, defaultVal);

//       $(this).attr('type', 'text')

//         .val(moment(defaultVal).format('M/D/YYYY h:mm A'))

//         .datetimepicker({

//           format: 'M/D/YYYY h:mm A',

//           // widgetParent: ???,

//           widgetPositioning: {

//             horizontal: "auto",

//             vertical: "auto"

//           }

//         });

//     });

//   }

// });