$(document).ready(function() {

    table = $('#datatable').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": window.baseUrl + 'role/get/role' + window.customeFilter,
            "type": "GET",
            "data": function(data) {
                // data.country = $('#country').val();
                // data.FirstName = $('#FirstName').val();
                // data.LastName = $('#LastName').val();
                // data.address = $('#address').val();
            }
        },
        "columns": [
            { "data": "role_id", "name": "role_id", "title": "<input name='select_all' type='checkbox' id='ckbCheckAll'>" },

            { "data": "role_name", "name": "role_name", "title": "Role Name" },

            { "data": "role_description", "name": "role_description", "title": "Role Description" },

            { "data": "set_permission", "name": "set_permission", "title": "" },

            { "data": "set_notification", "name": "set_notification", "title": "" }

        ],
        //Set column definition initialisation properties.
        "columnDefs": [{
                "render": function(data, type, row) {
                    return '<input name="id" value="' + data + '" class="checkBoxClass" type="checkbox">';
                },
                "targets": 0,
                "orderable": false
            }, {

                "render": function(data, type, row) {

                    return '<a href="#" class="edit-company" data-url="' + window.baseUrl + 'role/form/' + row.role_id + '" data-toggle="modal" data-target="#modal">' + data + '</a>';

                },

                "targets": 1

                // alert("snehal selcted");

            },

            {

                "render": function(data, type, row) {

                    return '<a href="#" class="btn btn-success m-btn getPermissions" value="' + row.role_id + '" data-url="' + window.baseUrl + 'role/form/permission/' + row.role_id + '" onclick=showModel("' + row.role_id + '")>Set Permission</a>';

                },

                "targets": 3,

                "orderable": false

            },

            {

                "render": function(data, type, row) {

                    return '<a href="#" class="btn btn-success m-btn" value="' + row.role_id + '" data-url="' + window.baseUrl + 'role/form/notification/' + row.role_id + '" onclick=showModelNotification("' + row.role_id + '")>Set Notification</a>';

                },

                "targets": 4,

                "orderable": false

            }

        ],

    });

    $(document).on('click', '.edit-company', function() {

        thisObj = $(this);

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayForm);

        // alert("jyukbjkjhdxrdytfulbjn");

        // $('.snehal').modal("hide");



        // $('#selectLeadOpp').hide();

        // $('#selectLeadOpp').fadeOut();

        // $('.updateActivity').modal("show");

    });



    for (var i = 0; i < window.moduleTabs.length; i++) {

        if (window.moduleTabs[i] == 'GridView') {

            GridView();

        } else if (window.moduleTabs[i] == 'Freez') {

            Freez();

        }

    }



    $('#exportExcel').click(function() {

        var res = confirm("Do You Want To Export All Data Into Excel ?");

        if (res) {

            window.location.href = window.baseUrl + 'activity/createExcel/' + window.userType;

        }

    });



    // START : datePicker added //

    $(function() {

        $(document).on('click', '#datepicker', function(e) {

            var element = document.getElementById("dateCaleder");

            var child = document.getElementById("datepicker");

            $('#dateCaleder').append('<input type="text" id="calenderTwo" name="calenderActivityDates"/>'); //add input box

            element.removeChild(child);

            var datepicker = new ej.calendars.DatePicker({ width: "255px" });

            datepicker.appendTo('#calenderTwo');



        });

    });



    $(function() {

        $(document).on('click', '#datepickerUpdte', function(e) {

            var element = document.getElementById("dateCaleder");

            var child = document.getElementById("datepickerUpdte");

            $('#dateCaleder').append('<input type="text" id="calenderThree" name="calenderActivityDates"/>'); //add input box

            element.removeChild(child);

            var datepicker = new ej.calendars.DatePicker({ width: "255px" });

            datepicker.appendTo('#calenderThree');

        });

    });



    $(function() {

        $(document).on('click', '#m_datepicker_4_2', function(e) {

            var element = document.getElementById("follow-up-date");

            var child = document.getElementById("m_datepicker_4_2");

            $('#follow-up-date').append('<input type="text" id="calenderscheduleOne" name="calenderDatesFollowUp"/>'); //add input box

            element.removeChild(child);

            var datepicker = new ej.calendars.DatePicker({ width: "255px" });

            datepicker.appendTo('#calenderscheduleOne');



        });

    });



    $(function() {

        $(document).on('click', '#m_datepicker_4_3', function(e) {

            var element = document.getElementById("follow-up-date");

            var child = document.getElementById("m_datepicker_4_3");

            $('#follow-up-date').append('<input type="text" id="calenderscheduleTwo" name="calenderDatesFollowUp"/> '); //add input box

            element.removeChild(child);

            var datepicker = new ej.calendars.DatePicker({ width: "255px" });

            datepicker.appendTo('#calenderscheduleTwo');



        });

    });



    // END : datePicker added //





});


$(document).ready(function() {

    $("#txtEditor").Editor();

});





$(function() {

    $(document).on('click', '.btn-add', function(e) {

        e.preventDefault();

        var controlForm = $('#myRepeatingLeadContact:first'),

            currentEntry = $(this).parents('.entry:first'),

            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');

        controlForm.find('.entry:not(:last) .btn-add')

        .removeClass('btn-add').addClass('btn-remove')

        .removeClass('btn-success').addClass('btn-danger')

        .html(' <span><i class="la la-trash-o"></i><span>Delete</span></span>');

    }).on('click', '.btn-remove', function(e) {

        // e.preventDefault();

        // $(this).parents('.entry:first').remove();

        // return false;

    });

});



$(function() {

    $(document).on('change', '#selecLeadOpportinuty', function(e) {

        var leadOppId = this.value;

        var arr = leadOppId.split(":");

        var fst = arr.splice(0, 1).join("");

        $('#selectLeadOpp').hide();

        $('#addLeadActivity').modal("show");

        $('#opp-create-update').val(fst);



    })



});



function checkUpdateBoxNew() {

    if (document.getElementById("checkUpdateOld").checked == true) {

        document.getElementById('atUpdatetwo').disabled = false;

        var idd = document.getElementById('m_datepicker_4_3');



        document.getElementById('m_datepicker_4_3').disabled = false;



        var datepicker = new ej.calendars.DatePicker({ width: "255px" });

        datepicker.appendTo('#calenderscheduleTwo');

    } else {

        document.getElementById('atUpdatetwo').disabled = true;

        var idd = document.getElementById('m_datepicker_4_3');





        document.getElementById("calenderscheduleTwo").remove();



    }

}



function checkUpdateData() {

    if (document.getElementById("checkUpdateavailable").checked == false) {

        document.getElementById('m_datepicker_4_2').value = "";

        document.getElementById('m_datepicker_4_2').disabled = true;

        document.getElementById('atUpdateOld').value = ""

        document.getElementById('atUpdateOld').disabled = true;

    }

    if (document.getElementById("checkUpdateavailable").checked == true) {

        document.getElementById('m_datepicker_4_2').disabled = false;

        document.getElementById('atUpdateOld').disabled = false;

    }



}



$(function() {

    // start : select all  recod for delete and send email //

    $(document).on('click', '#ckbCheckAll', function(e) {

        $(".checkBoxClass").prop('checked', $(this).prop("checked"));

        var favoriteDelete = ["delete"];

        $.each($("input[name='id']:checked"), function() {

            favoriteDelete.push($(this).val());

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

        $('#sendEmail').val(ChackedValuesEmail);

        $('#deleteRows').val(ChackedValuesDelete);

    })

    // end : select all recod for delete and send email //





    // start : select single recod for delete and send email //

    $(document).on('click', '.checkBoxClass', function(e) {
        if (this.checked) {
            // Enable #x
            $("#checkedAction").prop("disabled", false);
            $('.checked_action').addClass('activeData');
        } else {
            $('.checked_action').removeClass('activeData');
            // Disable #x
            $("#checkedAction").prop("disabled", true);
        }

        var favoriteDelete = ["delete"];
        $.each($("input[name='id']:checked"), function() {
            favoriteDelete.push($(this).val());
            $("#checkedAction").prop("disabled", false);
            $('.checked_action').addClass('activeData');
        });

        // var favoriteEmail = ["email"];
        // $.each($("input[name='id']:checked"), function() {
        //     favoriteEmail.push($(this).val());
        //     $("#checkedAction").prop("disabled", false);
        //     $('.checked_action').addClass('activeData');
        // });

        // var favoriteAssign = ["assignUser"];
        // $.each($("input[name='id']:checked"), function() {
        //     favoriteAssign.push($(this).val());
        //     $("#checkedAction").prop("disabled", false);
        //     $('.checked_action').addClass('activeData');
        // });


        var ChackedValuesDelete = favoriteDelete.join(",");
        // var ChackedValuesEmail = favoriteEmail.join(",");
        // var ChackedValuesAssign = favoriteAssign.join(",");

        // $('#sendEmail').val(ChackedValuesEmail);
        $('#deleteRows').val(ChackedValuesDelete);
        // $('#AssignUser').val(ChackedValuesAssign);

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

            ajax.url = window.baseUrl + 'role/deleteRole';

            if (answer) {

                $.ajax({

                    type: "POST",

                    url: ajax.url,

                    data: toBeDelete,

                    success: function(data) {

                        window.location.reload();

                    },

                    error: function() { alert("Error Deleting Activity."); }

                });

            } else {

                window.location.reload();

            }

        }

        if (fst == "email") {

            var toBeDelete = 'getEmail=' + rest;

            ajax.url = window.baseUrl + 'activity/getEmailIds';



            $.ajax({

                type: "POST",

                url: ajax.url,

                data: toBeDelete,

                success: function(data) {

                    $('#role_new_modal').modal('show');

                    $('#emailIdUsr').val(data);

                },

                error: function() {

                    alert("Error Deleting User.");

                }



            });



        }

    })





    $(document).on('click', '#sendmailtousers', function(e) {
        e.preventDefault();

        var userEmail = $("#emailIdUsr").val();

        var userSubject = $("#emailSubject").val();

        var userMessage = $("#msgEeditor").html();



        var dataString = 'usrEmail=' + userEmail + '&usrSub=' + userSubject + '&usrMsg=' + userMessage

        alert(dataString);

        ajax.url = window.baseUrl + 'activity/sendBulkEmail';

        alert(ajax.url);

        $.ajax({

            type: "POST",

            url: ajax.url,

            data: dataString,

            success: function(data) {

                if (data == '200') {

                    var msg = "<div class='alert alert-success'><strong>Success!</strong> Email Send Successfully</div>";

                    $('#validation_errors').html(msg);

                    window.location.reload();

                } else {

                    $('#validation_errors').html(data);

                }

                window.location.reload();

            },

            error: function() {

                alert("Error Deleting User.");

            }

            // error: function() { alert("Error Deleting User."); }



        });



    })

});





$(document).ready(function() {

    $("#txtEditor").Editor();

});



$(document).ready(function() {

    $('textarea#eg-textarea').editable({

        inlineMode: false

    })



});



$(function() {

    $(document).on('click', '#emailAllCheck', function(e) {
        $(".emailcheck").prop('checked', $(this).prop("checked"));
    });
    $(document).on('click', '#textAllCheck', function(e) {
        $(".textcheck").prop('checked', $(this).prop("checked"));
    });
    $(document).on('click', '#pushAllCheck', function(e) {
        $(".pushcheck").prop('checked', $(this).prop("checked"));
    });

    $(document).on('click', '#savefilter', function(e) {

        $('#mySaveFilterModal').modal('show');

    })

    $(document).on('click', '#saveMyFilter', function(e) {

        $('#mySaveFilterModal').modal('show');

        var filterName = $("#filter_name").val();

        var OppName = $("#filterActivityName").val();

        var AssignedUser = $("#filterAssigfgnedUSer").val();



        var dataString = 'filterName=' + filterName + '&OppName=' + OppName + '&AssignedUser=' + AssignedUser

        // alert(dataString);

        ajax.url = window.baseUrl + 'Activity/savefilter';

        $.ajax({

            type: "POST",

            url: ajax.url,

            data: dataString,

            success: function(data) {

                console.log(data);

                if (data == '200') {

                    var msg = "<div class='alert alert-success'><strong>Success!</strong> Filter Saved Successfully</div>";

                    $('#validation_errors').html(msg);

                    window.location.reload();

                } else {

                    $('#validation_errors').html(data);

                }

                window.location.reload();

            },

            error: function() { alert("Error Deleting User."); }



        });

    })

});



$(function() {

    $(document).on('change', '#filterListData', function(e) {

        var filterResult = this.value;

        var arr = filterResult.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join(",");

        obj = JSON.parse(rest);

        var filterResComName = obj.OppName;

        var roleId = obj.AssignedUser;

        $('#filterActivityName').val(filterResComName);

        $('#filterAssigfgnedUSer').val(roleId);



    })

});



function showModel(val) {

    $('#modalPermission').modal('show');

    dataString = 'role_id=' + val;

    $.ajax({

        type: "POST",

        url: 'role/getPermissions',

        data: dataString,

        success: function(data) {

            $('#permissions').html(data);

        },

        error: function() { alert("Error Deleting User."); }



    });

}





function showModelNotification(val) {

    $('#modalNotification').modal('show');

    dataString = 'role_id=' + val;

    $.ajax({

        type: "POST",

        url: 'role/getNotification',

        data: dataString,

        success: function(data) {

            $('#notification').html(data);

        },

        error: function() { alert("Error Deleting User."); }



    });

}



// $(function() 

//     {

//        $(document).on('click', '.getPermissions', function(e)

//        {

//           alert(this.value);

//           // $('#mySaveFilterModal').modal('show');

//           // $('#mySaveFilterModal').modal('show');

//           // var filterName = $("#filter_name").val();

//           // var OppName = $("#filterActivityName"). val();

//           // var AssignedUser = $("#filterAssigfgnedUSer"). val();



//           // var dataString = 'filterName=' + filterName +'&OppName=' + OppName + '&AssignedUser=' + AssignedUser

//           // // alert(dataString);

//           // ajax.url = window.baseUrl+'Activity/savefilter';

$.ajax({

    type: "POST",

    url: ajax.url,

    data: dataString,

    success: function(data) {

        console.log(data);

        if (data == '200') {

            var msg = "<div class='alert alert-success'><strong>Success!</strong> Filter Saved Successfully</div>";

            $('#validation_errors').html(msg);

            window.location.reload();

        } else {

            $('#validation_errors').html(data);

        }

        window.location.reload();

    },

    error: function() { alert("Error Deleting User."); }



});

//        })

//     });