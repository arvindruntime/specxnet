$(document).ready(function() {

    table.url = window.baseUrl + 'activity/get/leadactivity' + window.customeFilter;



    table.columns = [

            { "data": "lead_activity_id", "name": "lead_activity_id", "title": "<input name='select_all' type='checkbox' id='ckbCheckAll'>" },

            { "data": "status", "name": "status", "title": "Status" },

            { "data": "activity_type", "name": "activity_type", "title": "Type" },



            { "data": "activity_title", "name": "activity_title", "title": "Activity Title" },

            //{ "data": "opportunity_title", "name": "opportunity_title", "title": "Opportunity Title" },

            { "data": "fullName", "name": "fullName", "title": "Assigned User" },

            { "data": "activity_start_datetime", "name": "activity_date", "title": "Activity Date" },

            //{ "data": "description", "name": "description", "title": "Activity Notes" },

            { "data": "client_name", "name": "client_name", "title": "Customer Deatils" },

            { "data": "email", "name": "email", "title": "Email" },

            { "data": "phone", "name": "phone", "title": "Phone" },

            { "data": "lead_activity_id", "name": "lead_activity_id", "title": "Comments" }

        ],

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

                    if (data == 'Email') {

                        return '<a href="#" class="edit-company" data-url="' + window.baseUrl + 'activity/form/' + window.userType + '/' + row.lead_activity_id + '" data-toggle="modal" data-target="#modal" style="margin-left:10px;">' + data + '</a>';

                    } else {

                        return '</i> <a href="#" class="edit-company" data-url="' + window.baseUrl + 'activity/form/' + window.userType + '/' + row.lead_activity_id + '" data-toggle="modal" data-target="#modal">' + data + '</a>';

                    }



                },

                "targets": 2

            },

            {

                "render": function(data, type, row) {

                    if (row.commentCount != 0) {

                        return '<a href="#" class="send-email notification" data-url="' + window.baseUrl + 'activity/comment/' + row.lead_activity_id + '" data-toggle="modal" data-target="#modal" style="margin-left: 9px;"><i class="flaticon-comment"></i><span class="badge">' + row.commentCount + '</span></a>';

                    } else {

                        return '<a href="#" class="send-email notification" data-url="' + window.baseUrl + 'activity/comment/' + row.lead_activity_id + '" data-toggle="modal" data-target="#modal" style="margin-left: 9px;"><i class="flaticon-comment"></i></a>';

                    }



                },

                "targets": 9

            }

        ];

    table.createDataTable();

    $(document).on('click', '.edit-company', function() {

        thisObj = $(this);

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.updateActivity);

        // alert("jyukbjkjhdxrdytfulbjn");

        // $('.snehal').modal("hide");



        // $('#selectLeadOpp').hide();

        // $('#selectLeadOpp').fadeOut();

        // $('.updateActivity').modal("show");

    });



    $(document).on('click', '.send-email', function() {

        thisObj = $(this);

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.sendEmail);

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

        var list = $('#deleteRows').val();

        var arr = list.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join("_");

        var rest = rest.trim();

        var res = confirm("Do You Want To Export Selected Data Into Excel ?");

        if (rest == '') {

            alert('Please select atleast 1 record !');

        } else if (res) {

            window.location.href = window.baseUrl + 'activity/createExcel/' + rest;

        }

    });



    // Check if phone no. || Email exist for follow up //

    function chackexist()

    {

        alert("click");

        alert($("#userphn").val());

        alert($("#useremail").val());

    }



    // START : datePicker added //

    /*  $(function()

        {

          $(document).on('click', '#datepicker', function(e)

          { 

            var element = document.getElementById("dateCaleder");

            var child=document.getElementById("datepicker");

            $('#dateCaleder').append('<input type="text" id="calenderTwo" name="calenderActivityDates"/>'); //add input box

            element.removeChild(child);

             var datepicker = new ej.calendars.DatePicker({ width: "255px" });

                  datepicker.appendTo('#calenderTwo');



          });

      });*/



    /*  $(function()

        {

          $(document).on('click', '#datepickerUpdte', function(e)

          { 

            var element = document.getElementById("dateCaleder");

            var child=document.getElementById("datepickerUpdte");

            $('#dateCaleder').append('<input type="text" id="calenderThree" name="calenderActivityDates"/>'); //add input box

            element.removeChild(child);

             var datepicker = new ej.calendars.DatePicker({ width: "255px" });

                  datepicker.appendTo('#calenderThree');

          });

      });*/

    /*

        $(function()

        {

          $(document).on('click', '#m_datepicker_4_2', function(e)

          {

            var element = document.getElementById("follow-up-date");

            var child=document.getElementById("m_datepicker_4_2");

            $('#follow-up-date').append('<input type="text" id="calenderscheduleOne" name="calenderDatesFollowUp"/>'); //add input box

            element.removeChild(child);

             var datepicker = new ej.calendars.DatePicker({ width: "255px" });

                  datepicker.appendTo('#calenderscheduleOne');



          });

      }); */



    /*      $(function()

      {

        $(document).on('click', '#m_datepicker_4_3', function(e)

        {

          var element = document.getElementById("follow-up-date");

          var child=document.getElementById("m_datepicker_4_3");

          $('#follow-up-date').append('<input type="text" id="calenderscheduleTwo" name="calenderDatesFollowUp"/> '); //add input box

          element.removeChild(child);

           var datepicker = new ej.calendars.DatePicker({ width: "255px" });

                datepicker.appendTo('#calenderscheduleTwo');



        });

    }); */



    // END : datePicker added //





});



//     $(document).ready(function() {

//         $("#txtEditor").Editor();

// });



// $(function()

// {

//    $(document).on('change', '#selecLeadOpportinutyadd', function(e)

//    {

//     var leadOppId = this.value; 

//     var arr = leadOppId.split(":");   

//     var fst = arr.splice(0,1).join("");

//     var e1 =arr[0]; var p1 =arr[1];

//     var full_name = arr[2]; var designation =arr[3];

//     var company =arr[4];var opportunity_title =arr[5];var fk_lead_opportunity_id =arr[6];

//     var email = e1.replace(',', ' | ');

//     var phone = p1.replace(',', ' | ');

//     $('#selectLeadOpp').hide();

//     $('#addLeadActivity').modal("show");

//     $('#opp-create-update').val(fst);

//     $('#attachFullname').html(full_name);

//     $('#attachDesignation').html(designation);

//     $('#attachCompany').html(company);

//     $('#attachPhone').html(phone);

//     $('#attachEmail').html(email);

//     $('#oppTitle').html(opportunity_title);

//     $('#fk_lead_opportunity_id').val(fk_lead_opportunity_id);

//     CKEDITOR.replace('message');

//    })



// });





$(function()

    {

        $(document).on('click', '.btn-add', function(e)

            {

                e.preventDefault();

                var controlForm = $('#myRepeatingLeadContact:first'),

                    currentEntry = $(this).parents('.entry:first'),

                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');

                controlForm.find('.entry:not(:last) .btn-add')

                .removeClass('btn-add').addClass('btn-remove')

                .removeClass('btn-success').addClass('btn-danger')

                .html(' <span><i class="la la-trash-o"></i><span>Delete</span></span>');

            }).on('click', '.btn-remove', function(e)

            {

                // e.preventDefault();

                // $(this).parents('.entry:first').remove();

                // return false;

            });

    });







$(function()

    {

        // start : select all  recod for delete and send email //

        $(document).on('click', '#ckbCheckAll', function(e)

            {

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

                $('#sendEmail').val(ChackedValuesEmail);

                $('#deleteRows').val(ChackedValuesDelete);
                $('#permanentDeleteRows').val(ChackedValuesPermDelete);

            })

        // end : select all recod for delete and send email //





        // start : select single recod for delete and send email //

        $(document).on('click', '.checkBoxClass', function(e)

            {

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



                var favoriteEmail = ["email"];

                $.each($("input[name='id']:checked"), function() {

                    favoriteEmail.push($(this).val());

                    $("#checkedAction").prop("disabled", false);

                    $('.checked_action').addClass('activeData');

                });
                var favoritePermDelete = ["permDelete"];

                $.each($("input[name='id']:checked"), function() {

                    favoritePermDelete.push($(this).val());

                });


                var ChackedValuesDelete = favoriteDelete.join(", ");

                var ChackedValuesEmail = favoriteEmail.join(", ");
                var ChackedValuesPermDelete = favoritePermDelete.join(",");

                $('#deleteRows').val(ChackedValuesDelete);

                $('#permanentDeleteRows').val(ChackedValuesPermDelete);


            })

        // end : select single recod for delete and send email //



        $(document).on('change', '#checkedAction', function(e)

            {

                var deactivateids = this.value;

                var arr = deactivateids.split(",");

                var fst = arr.splice(0, 1).join("");

                var rest = arr.join(",");

                if (fst == "delete") {

                    var toBeDelete = 'deleteThis=' + rest;

                    var answer = confirm("Are you sure you want to delete record!");

                    ajax.url = window.baseUrl + 'activity/deleteUActivity';

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
                if (fst == "permDelete") {

                    var toBeDelete = 'deleteThis=' + rest;
                    var answer = confirm("Are you sure you want to delete record Permanently!");

                    ajax.url = window.baseUrl + 'activity/permDeleteUActivity';

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

                    ajax.url = window.baseUrl + 'activity/getEmailIds';



                    $.ajax({

                        type: "POST",

                        url: ajax.url,

                        data: toBeDelete,

                        success: function(data) {

                            $('#role_new_modal').modal('show');

                            $('#emailIdUsr').val(data);

                        },

                        error: function()

                        {

                            alert("Error Deleting User.");

                        }



                    });



                }

            })





        $(document).on('click', '#sendmailtousers', function(e)

            {
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

                    error: function()

                    {

                        alert("Error Deleting User.");

                    }

                    // error: function() { alert("Error Deleting User."); }



                });



            })

    });





// $(document).ready(function() {

//         $("#txtEditor").Editor();

// });



// $(document).ready(function() {

//          $('textarea#eg-textarea').editable({

//       inlineMode: false

//     })



// });



$(function()

    {

        $(document).on('click', '#savefilter', function(e)

            {

                $('#mySaveFilterModal').modal('show');

            })

        $(document).on('click', '#saveMyFilter', function(e)

            {

                $('#mySaveFilterModal').modal('show');

                var filterName = $("#filter_name").val();

                var filterActivityType = $("#filterActivityType").val();

                var filterStatus = $("#filterStatus").val();

                var filterAssigfgnedUSer = $("#filterAssigfgnedUSer").val();



                var dataString = 'filterName=' + filterName + '&filterActivityType=' + filterActivityType + '&filterStatus=' + filterStatus + '&filterAssigfgnedUSer=' + filterAssigfgnedUSer;

                ajax.url = window.baseUrl + 'activity/savefilter';

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

                    error: function() { alert("Error Deleting User."); }



                });

            })

    });



$(function()

    {

        $(document).on('change', '#filterListData', function(e)

            {

                var filterResult = this.value;

                var arr = filterResult.split(",");

                var fst = arr.splice(0, 1).join("");

                var rest = arr.join(",");

                obj = JSON.parse(rest);

                var filterActivityType = obj.filterActivityType;

                var filterStatus = obj.filterStatus;

                var filterAssigfgnedUSer = obj.filterAssigfgnedUSer;

                $('#filterActivityType').val(filterActivityType);

                $('#filterStatus').val(filterStatus);

                $('#filterAssigfgnedUSer').val(filterAssigfgnedUSer);

                $('#saved_filter_id').val(fst);

            })

    });



function closeSaveFilter() {

    $('#mySaveFilterModal').modal('hide');

    ajax.url = 'activity/getSavedFilterDropdown';

    dataString = 'activity=activity';

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



function sendActivityEmail() {

    var form_data = new FormData();



    var to = $("#to").val();

    var subject = $("#subject").val();

    var message = CKEDITOR.instances.messagebox.getData();

    alert(message);

    var fk_lead_opportunity_id = $("#fk_lead_opportunity_id").val();

    var lead_activity_id = $("#lead_activity_id").val();



    form_data.append("activity_mail", document.getElementById('activity_mail').files[0]);

    form_data.append("to", to);

    form_data.append("subject", subject);

    form_data.append("message", message);

    form_data.append("fk_lead_opportunity_id", fk_lead_opportunity_id);

    form_data.append("lead_activity_id", lead_activity_id);

}



$(document).on('submit', '#sendEmail', function(e) {

    e.preventDefault();

    var form_data = new FormData();

    var to = $("#to").val();

    var subject = $("#subject").val();

    var message = CKEDITOR.instances.messagebox.getData();

    var fk_lead_opportunity_id = $("#fk_lead_opportunity_id").val();

    var lead_activity_id = $("#lead_activity_id").val();



    form_data.append("activity_mail", document.getElementById('activity_mail').files[0]);

    form_data.append("to", to);

    form_data.append("subject", subject);

    form_data.append("message", message);

    form_data.append("fk_lead_opportunity_id", fk_lead_opportunity_id);

    form_data.append("lead_activity_id", lead_activity_id);



    $.ajax({

        url: "activity/send/email",

        method: "POST",

        data: form_data,

        contentType: false,

        cache: false,

        processData: false,



        beforeSend: function() {

            $('#sendEmail').value("Sending...");

            $('#sendEmail').prop('disabled', true);

        },

        success: function(data) {

            location.reload();

        }

    });



});



$(document).on('click', '#sendComment', function(e) {

    var comment = $("#comment").val();

    var lead_activity_id = $("#lead_activity_id").val();

    var dataString = 'comment=' + comment + '&lead_activity_id=' + lead_activity_id;

    ajax.url = window.baseUrl + 'activity/saveComment';

    $.ajax({

        type: "POST",

        url: ajax.url,

        data: dataString,

        success: function(data) {

            $('#commentBox').html(data);

            $('#comment').val('');

        },

        error: function() { alert("Error Fetching Comments."); }



    });

});



function deleteFile(val) {

    res = confirm("Do you want to delete this file ?");

    if (res) {

        dataString = 'lead_activity_id=' + val;

        $.ajax({

            url: "Activity/deleteAttachFile",

            method: "POST",

            data: dataString,

            success: function(data) {

                $('#replaceAddImage').html('<label for="street_address">Attachments</label><input class="form-control m-input" type="file" name="activity_attachment">');

            }

        });

    }



}