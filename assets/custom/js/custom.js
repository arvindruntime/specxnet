$(document).ready(function() {

    // to open popup of url
    $('.m-menu__link-badge').click(function() {
        thisObj = $(this);
        var url = thisObj.find('.m-menu__link-icon').data('url');
        ajax.init();
        ajax.method = 'get';
        ajax.url = url;
        ajax.ajaxCall(ajax.displayForm);
    });

    // to checkaction drop down
    $(document).on('change', '.checkbox-action', function() {
        if (this.checked) {
            $('.checked_action').addClass('activeData');
        } else {
            $('.checked_action').removeClass('activeData');
        }
    });
});
$(function() {
    $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();
        var controlForm = $('#cloneDiv:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        newEntry.find('input').val('');
        $('#conatctInfoU').removeAttr('required');
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

// Grid for tab.php script start //

$(document).ready(function() {
    $('#myselect3').click(function() {

        $('#gridView').modal("show");
        $("#gridView").addClass("show");
        $('#gridView').show();

    });
});

$(document).ready(function() {
    $('#ischeck').click(function() {
        if ($("#ischeck").prop('checked') == true) {
            $("input#saveGrid").prop('disabled', false);
        } else {
            $("input#saveGrid").prop('disabled', true);
        }
    });
});

$(document).on('#myselect5', 'change', function() {
    var opval = $("#myselect5").val();
    if (opval == "thirdoption") {
        $('#select_existing').modal("show");
        $("#select_existing").addClass("show");
        $('#select_existing').show();
        //-------Hide required fields-----------------

    } else {
        $('#select_existing').modal("hide");
        $("#select_existing").removeClass("show");
    }
});

function getExistCusUsr() {
    var existUsrID = document.getElementById("existUId").value;
    $.ajax({
        type: "POST",
        url: "<?php echo base_url().'LeadOpportunity/existCustomer'; ?>",
        data: 'userId=' + existUsrID,
        success: function(theResponse) {
            $('#select_existing').hide();
            $('#selectExistingCustomer').html(theResponse);


        }
    });
}


$(document).ready(function() {
    $('#myselect3').click(function() {

        $('#gridView').modal("show");
        $("#gridView").addClass("show");
        $('#gridView').show();

    });
});

$(document).ready(function() {
    $('#ischeck').click(function() {
        if ($("#ischeck").prop('checked') == true) {
            $("input#saveGrid").prop('disabled', false);
        } else {
            $("input#saveGrid").prop('disabled', true);
        }
    });
});

/**
 * Script to display success message after successful insert or import.
 * @author Sagar Kodalkar
 */
window.setTimeout(function() {
    $("#deleteMsg").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 4000);




function GridView() {
    $('#feedInput').on('submit', function(e) {
        e.preventDefault();
        var thisObj = $(this);
        // ajax.data = thisObj.serialize();
        ajax.data = new FormData(thisObj[0]);
        ajax.method = thisObj.attr('method');
        ajax.url = thisObj.attr('action');
        ajax.ajaxCall(ajax.gridViewData);
    });

    $("select.gridView").change(function() {
        var selectedgrid = $(this).children("option:selected").val();
        ajax.method = 'POST';
        ajax.data = '';
        if (window.moduleType == "company") {
            ajax.url = window.baseUrl + 'company/create/gridview/' + selectedgrid;
        } else if (window.moduleType == "users") {
            ajax.url = window.baseUrl + 'user/create/gridview/' + selectedgrid;
        } else if (window.moduleType == "leadOpportunity") {
            ajax.url = window.baseUrl + 'lead/create/gridview/' + selectedgrid;
        } else if (window.moduleType == "leadActivity") {
            ajax.url = window.baseUrl + 'activity/create/gridview/' + selectedgrid;
        } else if (window.moduleType == "proposal") {
            ajax.url = window.baseUrl + 'proposal/create/gridview/' + selectedgrid;
        } else if (window.moduleType == 'warranty') {
            ajax.url = window.baseUrl + 'warranty/createGrid/' + selectedgrid;
        }
        ajax.ajaxCall(ajax.gridViewData);
    });

    $('#myselect3').on('click', function(e) {
        tbody = $('#feedInput').find('.modal-body').find('tbody');
        tbody.html('');
        for (var i = 0; i < window.column.length; i++) {
            if (i != 0) {
                tbody.append('<tr align="center"><th>' + window.column[i].title + '</th><td><input type="checkbox" name="internal[]" value="' + i + '"></td></tr>');
            }
        }
        tbody.append('<tr align="center"><th><b>Save For Future</b><input id="save-for-future" type="checkbox" name="ischeck" id="ischeck"></th><td><input type="text" name="saveGrid" id="saveGrid" disabled="true" required=""></td></tr>');
        tbody.append('<tr><th></th><td><input type="submit" value="Submit"></td></tr>');
    });

    $(document).on('change', '#save-for-future', function() {
        if (this.checked) {
            $(document).find('#saveGrid').prop('disabled', false);
        } else {
            $(document).find('#saveGrid').prop('disabled', true);
        }
    });


}

function Freez() {
    $('#freeze').on('change', function() {
        var column = 0;
        if (this.checked) {
            var column = $('.freezeColumn').val();
            table.addFreezColumn(column);
            table.updateDataTable();
        } else {
            table.addFreezColumn();
            table.updateDataTable();
        }
    });

    $('.freezeColumn').change(function() {
        if ($('#freeze').prop('checked')) {
            column = $(this).val();
            table.addFreezColumn(column);
            table.updateDataTable();
        }
    })


}

function UploadTable() {

}

function DownloadTable() {

}
// .btn-danger
$(function() {
    $(document).on('click', '.btn-update', function(e) {
        e.preventDefault();
        var controlForm = $('#newClondedContact'),
            currentEntry = $(this).parents('.entry').find('.entry-row:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
        // alert("controlForm");
        // alert(newEntry);
        newEntry.find('input').val('');
        // controlForm.find('#oldData:not(:last) .btn-danger')
        //    .removeClass('btn-danger').addClass('btn-add')
        //    .removeClass('btn-danger').addClass('btn-success')
        //    .html('<span><i class="la la-plus"></i><span>Add</span></span>');
    }).on('click', '.btn-remove', function(e) {
        e.preventDefault();
        var value = this.value;
        if (value != '') {
            datastring = 'contact_id=' + this.value;
            var res = confirm("Are You Sure, You Want To Delete This Contact ?");
            if (res) {
                $.ajax({
                    type: "POST",
                    url: window.baseUrl + "users/getCountOfContact",
                    data: datastring,
                    dataType: "html",
                    success: function(data) {
                        if (data != 'Success') {
                            $('#validation_errors_update_opportunity').html(data);
                        } else {
                            $(this).parents('.entry:first').remove();
                            return false;
                        }
                    },
                    error: function() { alert("Error posting feed."); }
                });
            }
        }
    });
});

$(function() {
    $(document).on('change', '#selecLeadOpportinuty', function(e) {
        var leadOppId = this.value;
        var nameArr = leadOppId.split(':');
        var oppId = nameArr[0];
        var ctEmail = nameArr[1];
        var ctPhone = nameArr[2];
        document.getElementById('leadOppUserCtTypeId').innerHTML = ctEmail;
        document.getElementById('toEmail').innerHTML = ctEmail;
        document.getElementById('leadPhoneId').innerHTML = ctPhone;
        $('#selectLeadOpp').hide();
        $('#addLeadActivity').modal("show");
        var OpportunityID = "<input type='hidden' name='leadopportunityId' value='" + oppId + "'/><br/><input type='hidden' name='leadopportuCtInvo' value='" + ctInfo + "'/></br><input type='hidden' name='leadopportuCtTypr' value='" + ctType + "'/>";
        $("#leadDetails").append(OpportunityID);

    })

});


function getCountryCode(val) {
    if (val != '') {
        $("#companyCountryColor").css("display", "none");
        $("#userCountryColor").css("display", "none");
    } else {
        $("#companyCountryColor").css("display", "block");
        $("#userCountryColor").css("display", "block");
    }

    var str = val.split("-");
    var countryCode = '+' + str[1];
    var country = str[0];
    document.getElementById("dialing_code").value = countryCode;
    document.getElementById("dialing_code_append").innerHTML = countryCode;

    var request = new XMLHttpRequest();
    request.open("GET", "company/getCompanyIdentifier/" + country);

    request.onreadystatechange = function() {
        // Check if the request is compete and was successful
        if (this.readyState === 4 && this.status === 200) {
            // console.log(this.responseText);
            document.getElementById("replaceIdentifier").innerHTML = this.responseText;
        }
    };

    // Sending the request to the server
    request.send();
}

function getCountryCodeForUsers(val) {
    var str = val.split("-");
    var countryCode = '+' + str[1];
    var contact = $('#company_bussiness_contact').val();
    // if (contact !='') {
    //   var cont = contact.split("-");
    //   if (cont[1] !='') {
    //     var new_contact = countryCode + '-' +cont[1];
    //     $('#company_bussiness_contact').val(new_contact);
    //   } else {
    //     var new_contact = countryCode + '-' +contact;
    //     $('#company_bussiness_contact').val(new_contact);
    //   }
    // } else {
    //   $('#company_bussiness_contact').val(countryCode+' - ');
    // }
    document.getElementById("dialing_code").value = countryCode;
    document.getElementById("dialing_code_append").innerHTML = countryCode;
}


function checkDoc() {
    if (document.getElementById("checkDocuments").checked == true) {
        document.getElementById('doc_type_name').disabled = true;
        document.getElementById('doc_type_text').disabled = true;
        document.getElementById('doc_type_file').disabled = true;
    } else {
        document.getElementById('doc_type_name').disabled = false;
        document.getElementById('doc_type_text').disabled = false;
        document.getElementById('doc_type_file').disabled = false;
    }
}

// Delete/ Success Message Popups 
// @Sagar Kodalkar.
window.setTimeout(function() {
    $("#deleteMsg").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 4000);

//----Js For Proposal Form Starts-------------------------
$(document).on('click', '#saveProposal', function(e) {
    var approval_date = $("#approval_date").val();
    var notes = $("#notes").val();
    var lead_opportunity_id = $("#lead_opportunity_id").val();
    var p_id = $("#p_id").val();

    datastring = 'approval_date=' + approval_date + '&notes=' + notes + '&p_id=' + p_id;

    $.ajax({
        type: "POST",
        url: window.baseUrl + "proposal/save",
        data: datastring,
        dataType: "html",
        success: function(data) {
            var msg = "<div class='alert alert-success'><strong>Success!</strong> Proposal Updated Successfully</div>";
            $('#validation_errors_proposal').html(msg);
        },
        error: function() { alert("Error posting feed."); }
    });

});


$(document).on('click', '#approve', function(e) {
    check = confirm("Are you sure, you want to Approve ?");

    if (check) {
        $("#commentStatus").val('Approved');
        $('#comment-modal').modal('show');
    }

});

function AddRecordNo() {

    var fk_pid = $("#fk_pid").val();
    var fk_pwid = $("#fk_pw_id").val();
    var record_no = $("#record_no").val();
    var status = $("#commentRecordStatus").val();
    var customer_id = $("#customer").val();
    var fk_po_id = $("#fk_po_id").val();
    if (status == 'Released PO') {
        url = "proposal/addPO";
        datastring = 'fk_pid=' + fk_pid + '&fk_pwid=' + fk_pwid + '&status=' + status + '&customer_id=' + customer_id + '&po_no=' + record_no;
    } else if (status == 'Released') {
        url = "proposal/addReleaseStatus";
        datastring = 'fk_pid=' + fk_pid + '&fk_pwid=' + fk_pwid + '&status=' + status + '&customer_id=' + customer_id + '&proposal_no=' + record_no;
    } else if (status == 'Released Invoice') {
        url = "proposal/addInvoice";
        datastring = 'fk_pid=' + fk_pid + '&fk_pwid=' + fk_pwid + '&status=' + status + '&customer_id=' + customer_id + '&invoice_no=' + record_no + '&fk_po_id=' + fk_po_id;
    }
    $.ajax({

        url: url,

        method: "POST",

        data: datastring,

        data: datastring,

        dataType: "html",

        success: function(data) {

            // console.log(data);

            var newData = JSON.parse(data);

            $('#commentMsg').html(newData.message);
            $('#recordNo-modal').modal('toggle');
            window.location.reload();
            return false;

        }

    });

}

function AddComment() {
    var form_data = new FormData();
    var proposal_no = "";
    var p_id = $("#fk_pid").val();

    var comment = $("#comment").val();

    var commentStatus = $("#commentStatus").val();
    if (commentStatus == "Release") {
        var proposal_no = $("#proposal_no").val();
        form_data.append("proposal_no", proposal_no);
    }

    form_data.append("p_id", p_id);

    form_data.append("comment", comment);

    form_data.append("commentStatus", commentStatus);


    $.ajax({

        url: "proposal/addComment",

        method: "POST",

        data: form_data,

        contentType: false,

        cache: false,

        processData: false,

        success: function(data) {

            var newData = JSON.parse(data);

            $('#commentMsg').html(newData.message);
            $('#comment-modal').modal('toggle');
            window.location.href = window.baseUrl + "purchase_order";
            // window.location.reload();
            return false;

        }

    });

}


$(document).on('click', '#decline', function(e) {
    check = confirm("Are you sure, you want to Decline ?");

    if (check) {
        $("#commentStatus").val('Declined');
        $('#comment-modal').modal('show');
    }

});
$(document).on('click', '#release', function(e) {
    check = confirm("Are you sure, you want to Release ?");

    if (check) {
        min = 1000;
        max = 500000;
        min = Math.ceil(min);
        max = Math.floor(max);
        const num = Math.floor(Math.random() * (max - min + 1)) + min;
        proposal_no = num.toString().padStart(6, "0");
        $("#commentRecordStatus").val('Released');
        $("#record_label").text('Proposal No.');
        $("#record_no").val(proposal_no);
        $('#recordNo-modal').modal('show');
    }

});

// $(document).on('click', '#reBid', function(e) {
//     check = confirm("Are you sure, you want to change status to Rebid ?");

//     if (check) {

//         var fk_pid = $("#fk_pid").val();
//         var status = 'Re Bid';
//         url = "rfq/addInvoice";
//         datastring = 'fk_pid=' + fk_pid + '&status=' + status;

//         $.ajax({

//             url: url,

//             method: "POST",

//             data: datastring,

//             dataType: "html",

//             success: function(data) {

//                 // console.log(data);

//                 var newData = JSON.parse(data);

//                 // $('#commentMsg').html(newData.message);
//                 $('#recordNo-modal').modal('toggle');
//                 window.location.reload();
//                 return false;

//             }

//         });

//     }

// });

$(document).on('click', '#checkWorkshhet', function(e) {
    var lead_opportunity_id = $("#lead_opportunity_id").val();
    var approval_deadline = $("#approval_date").val();
    var notes = $("#notes").val();
    var p_id = $("#fk_pid").val();
    var dataString = 'notes=' + notes + '&approval_deadline=' + approval_deadline + '&lead_opportunity_id=' + lead_opportunity_id;
    if (p_id) {
        $("#showUL").css("display", "block");
        $("#checkWorkshhet").prop("checked", true);
        $("#checkWorkshhet").attr("disabled", true);
    } else {
        $.ajax({
            type: "POST",
            url: window.baseUrl + "proposal/addProposal",
            data: dataString,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                if (lead_opportunity_id == '') {
                    $('#lead_id_alert').html('<b>This field is required.</b>');
                    $("#checkWorkshhet").prop("checked", false);
                    return false;
                } else if (response.code == 200) {
                    $('#lead_id_alert').html('');
                    $("#showUL").css("display", "block");
                    $("#checkWorkshhet").attr("disabled", true);
                    var msg = "<div class='alert alert-success'><strong>Success!</strong> Proposal Added Successfully</div>";
                    $('#fk_pid').val(response.data);
                    $('#add_import_id').val(response.data);
                    $('#validation_errors_proposal').html(msg);
                    $('#pw_id').val(response.itemId);
                    datastring = { fk_pid: response.data };
                    table.proposalPopupTable(datastring);
                    CKEDITOR.replace('format_header');
                    CKEDITOR.replace('format_footer');
                } else {
                    $('#validation_errors_proposal').html(response.message);
                    $("#showUL").css("display", "none");
                    $("#checkWorkshhet").attr("disabled", false);
                }

            },
            error: function() { alert("Error posting feed."); }
        });
    }

});


$(document).on('click', '#add_format', function(e) {
    // var format_header = $("#format_header").val();
    var format_header = CKEDITOR.instances.format_header.getData();

    //var format_footer = $("#format_footer").val();
    var format_footer = CKEDITOR.instances.format_footer.getData();
    var fk_pid = $("#fk_pid").val();
    var pf_id = $("#pf_id").val();

    var dataString = 'format_header=' + format_header + '&format_footer=' + format_footer + '&fk_pid=' + fk_pid + '&pf_id=' + pf_id;

    // $.ajax({
    //         type: "POST",
    //         url: window.baseUrl+"Proposal/Format/add",
    //         data: dataString,
    //         dataType: "html",
    //         success: function(data){
    //             var response = JSON.parse(data);
    //             if (response.code == 200) {
    //                 $('#validation_errors_proposal_format').html(response.message);
    //                 $("#fk_pid").val();
    //                 $('#add_format').val('Update Format');
    //             } else {
    //                 $('#validation_errors_proposal_format').html(response.message);
    //             }

    //         },
    //         error: function() { alert("Error posting feed."); }
    //    });
});
//----Js For Proposal Form Ends---------------------------

function checkUpdateBoxNew() {
    if (document.getElementById("checkUpdateOld").checked == true) {
        document.getElementById('add_follow_up').style.visibility = 'visible';
        document.getElementById("add_follow_up").disabled = false;

        document.getElementById('m_datepicker_4_3').style.visibility = 'visible';
        document.getElementById("m_datepicker_4_3").disabled = false;

        document.getElementById('at_label').style.visibility = 'visible';
        document.getElementById("at_label").disabled = false;

        document.getElementById('atUpdatetwo').style.visibility = 'visible';
        document.getElementById("atUpdatetwo").disabled = false;
    } else {
        document.getElementById('add_follow_up').style.visibility = 'hidden';
        document.getElementById("add_follow_up").disabled = true;

        document.getElementById('m_datepicker_4_3').style.visibility = 'hidden';
        document.getElementById("m_datepicker_4_3").disabled = true;

        document.getElementById('at_label').style.visibility = 'hidden';
        document.getElementById("at_label").disabled = true;

        document.getElementById('atUpdatetwo').style.visibility = 'hidden';
        document.getElementById("atUpdatetwo").disabled = true;
    }
}

function checkUpdateData() {
    if (document.getElementById("checkUpdateavailable").checked == false) {

        document.getElementById('add_follow_up').style.visibility = 'hidden';
        document.getElementById("add_follow_up").disabled = true;

        document.getElementById('m_datepicker_4_2').style.visibility = 'hidden';
        document.getElementById("m_datepicker_4_2").disabled = true;

        document.getElementById('at_label').style.visibility = 'hidden';
        document.getElementById("at_label").disabled = true;

        document.getElementById('atUpdateOld').style.visibility = 'hidden';
        document.getElementById("atUpdateOld").disabled = true;
    }
    if (document.getElementById("checkUpdateavailable").checked == true) {

        document.getElementById('add_follow_up').style.visibility = 'visible';
        document.getElementById("add_follow_up").disabled = false;

        document.getElementById('m_datepicker_4_2').style.visibility = 'visible';
        document.getElementById("m_datepicker_4_2").disabled = false;

        document.getElementById('at_label').style.visibility = 'visible';
        document.getElementById("at_label").disabled = false;

        document.getElementById('atUpdateOld').style.visibility = 'visible';
        document.getElementById("atUpdateOld").disabled = false;
    }

}

$(document).on('click', '#adminpermissioncheck', function(e) {
    if (this.checked) {
        alert('By Clicking this, You have assigned all permissions to this User');
        $(".permissionCheckbox").prop('checked', $(this).prop("checked"));
    } else {
        alert('By Clicking this, You have removed all permissions from this User');
        $(".permissionCheckbox").prop('checked', $(this).prop("checked"));
    }
});

//----------------------------------------Lead Opportunity-------------------------------------------
$(function() {
    $(document).on('change', '#selectLeadUsr', function(e) {
        var leaduseOpp = this.value;
        if (leaduseOpp == "thirdoption") {
            $('#select_existing').modal("show");
            // $("#select_existing").addClass("show");
            $('#select_existing').show();
        } else if (leaduseOpp == "1") {
            $('#select_existing').modal("hide");
            $("#LeadUsrFName").attr("disabled", false);
            $("#LeadUsrLName").attr("disabled", false);
            $("#LeadUsrDesi").attr("disabled", false);
            $("#LeadusrComp").attr("disabled", false);
            $("#LeadUsrAdd").attr("disabled", false);
            $("#LeadUsrCity").attr("disabled", false);
            $("#LeadUsrState").attr("disabled", false);
            $("#LeadUsrPin").attr("disabled", false);
            $("#add_country").attr("disabled", false);
            //-------Remove Values-----------------
            $('#LeadUsrFName').val('');
            $('#userID').val('');
            $('#LeadUsrLName').val('');
            $('#LeadUsrDesi').val('');
            $('#LeadusrComp').val('');
            $('#LeadUsrAdd').val('');
            $('#LeadUsrCity').val('');
            $('#LeadUsrState').val('');
            $('#LeadUsrPin').val('');
            $('#add_country').val('');


            var usercontact = '';
            $.ajax({
                type: "POST",
                url: 'lead/getContactFields',
                data: usercontact,
                success: function(data) {
                    $('#select_existing').hide();
                    $('#myRepeatingFieldsforNewUser').remove();
                    $('#myRepeatingFields').html(data);
                },
                error: function() { alert("Error fetching User."); }

            });
        }

    })

});

$(function() {
    $(document).on('click', '#existUId', function(e) {
        var leaduseOpp = this.value;
        var nameArr = leaduseOpp.split('|');
        var usrId = nameArr[0];
        var usrFName = nameArr[1];
        var usrLName = nameArr[2];
        var usrDesi = nameArr[3];
        var usrCompId = nameArr[4];
        var usrStAdd = nameArr[5];
        var usrCity = nameArr[6];
        var usrState = nameArr[7];
        var usrPin = nameArr[8];
        var usrcountry = nameArr[9];
        var usrCtInfo = nameArr[10];
        var usrCtType = nameArr[11];
        var phone = nameArr[12];
        var email = nameArr[13];
        var user_contact_id = nameArr[14];
        var company_name = nameArr[15];
        var bussiness_contact = nameArr[16];
        var company_add = nameArr[17];
        var company_city = nameArr[18];
        var company_state = nameArr[19];
        var company_country = nameArr[20];
        var dialing_code = nameArr[21];
        var companyCountry = company_country + '-' + dialing_code.replace("+", "");
        var company_zip = nameArr[22];
        var industry_name = nameArr[23];
        var fk_industry_id = nameArr[24];
        var parentCompany = nameArr[25];
        var parentCompanyId = nameArr[26];
        var countryName = nameArr[27];
        var department_name = nameArr[28];
        var department_id = nameArr[29];

        $('#LeadUsrFName').val(usrFName);
        $('#userID').val(usrId);
        $('#LeadUsrLName').val(usrLName);
        $('#LeadUsrDesi').val(usrDesi);
        $('#LeadusrComp').val(company_name);
        $('#LeadUsrAdd').val(company_add);
        $('#LeadUsrCity').val(company_city);
        $('#LeadUsrState').val(company_state);
        $('#LeadUsrPin').val(company_zip);
        $('#add_country').val(companyCountry);
        $('#dialing_code').val(dialing_code);
        $('#company_bussiness_contact').val(bussiness_contact);
        $('#department_name').val(department_name);
        $('#deptId').val(department_id);
        $('#company_id').val(usrCompId);
        $('#parent_comp').val(parentCompany);
        $('#parent_company').val(parentCompanyId);
        $('#fk_industry_name').val(industry_name);
        $('#fk_industry_id').val(fk_industry_id);
        $('#UsrAdd').val(usrStAdd);
        $('#UsrPin').val(usrPin);
        $('#UsrCity').val(usrCity);
        $('#UsrState').val(usrState);
        $('#add_user_country').val(usrcountry);
        $('#pphone').val(phone);
        $('#pemail').val(email);
        $('#emailText').html('');

        //--------------Disable All Fields--------------------
        $("#LeadUsrFName").attr("disabled", true);
        $("#LeadUsrLName").attr("disabled", true);
        $("#LeadUsrDesi").attr("disabled", true);
        $("#LeadusrComp").attr("disabled", true);
        $("#LeadUsrAdd").attr("disabled", true);
        $("#LeadUsrCity").attr("disabled", true);
        $("#LeadUsrState").attr("disabled", true);
        $("#LeadUsrPin").attr("disabled", true);
        $("#add_country").attr("disabled", true);
        $("#company_bussiness_contact").attr("disabled", true);
        $("#department_name").attr("disabled", true);
        $("#parent_comp").attr("disabled", true);
        $("#UsrAdd").attr("disabled", true);
        $("#UsrPin").attr("disabled", true);
        $("#UsrCity").attr("disabled", true);
        $("#UsrState").attr("disabled", true);
        $("#add_user_country").attr("disabled", true);
        $("#pphone").attr("disabled", true);
        $("#pemail").attr("disabled", true);
        $("#fk_industry_name").attr("disabled", true);
        $("#sameCompanyAdd").attr("disabled", true);

        //-------Remove Required Check-------------
        $("#firstnameColor").css("display", "none");
        $("#pemailColor").css("display", "none");
        $("#pphoneColor").css("display", "none");
        $("#companyColor").css("display", "none");
        $("#companyCityColor").css("display", "none");
        $("#companyCountryColor").css("display", "none");
        $("#userCountryColor").css("display", "none");
        $("#userCityColor").css("display", "none");
        //---------------End----------------------------------
        var usercontact = 'userID=' + usrId;
        ajax.url = window.baseUrl + 'lead/getUcontData';

        $.ajax({
            type: "POST",
            url: ajax.url,
            data: usercontact,
            success: function(data) {
                // console.log(data);
                $('#select_existing').hide();
                $('#myRepeatingFieldsforNewUser').remove();
                $('#myRepeatingFields').html(data);
            },
            error: function() { alert("Error fetching User."); }

        });


        // // $("#select_existing").removeClass("show");
        // $('#select_existing').hide();
        // $('#LeadUsrFName').val(usrFName);
        // $('#userID').val(usrId);
        // $('#LeadUsrLName').val(usrLName);
        // $('#LeadUsrDesi').val(usrDesi);
        // $('#LeadusrComp').val(usrCompId);
        // $('#LeadUsrAdd').val(usrStAdd);
        // $('#LeadUsrCity').val(usrCity);
        // $('#LeadUsrState').val(usrState);
        // $('#LeadUsrPin').val(usrPin);
        // $('#Leadm_contact_detail').val(usrCtInfo);
        // var select = $('#Leadm_contact_type');
        //  if(usrCtType == "Email"){                
        //     select.empty().append('<option value="">--Select Contact Type --</option><option value="Email" selected>Email</option><option value="Phone">Phone</option>');
        //   }
        //   else{
        //     select.empty().append('<option value="">--Select Contact Type --</option><option value="Email">Email</option><option value="Phone" selected>Phone</option>');
        //   }
    })

});

$(document).ready(function() {
    var IONRangeSlider = { init: function() { $("#m_slider_1").ionRangeSlider(), $("#m_slider_2").ionRangeSlider({ min: 100, max: 1e3, from: 550 }), $("#m_slider_3").ionRangeSlider({ type: "double", grid: !0, min: 0, max: 1e3, from: 200, to: 800, prefix: "$" }), $("#m_slider_4").ionRangeSlider({ type: "double", grid: !0, min: -1e3, max: 1e3, from: -500, to: 500 }), $("#m_slider_5").ionRangeSlider({ type: "double", grid: !0, min: -12.8, max: 12.8, from: -3.2, to: 3.2, step: .1 }), $("#m_slider_6").ionRangeSlider({ type: "single", grid: !0, min: -90, max: 90, from: 0, postfix: "Â°" }), $("#m_slider_7").ionRangeSlider({ type: "double", min: 100, max: 200, from: 145, to: 155, prefix: "Weight: ", postfix: " million pounds", decorate_both: !0 }) } };
    jQuery(document).ready(function() { IONRangeSlider.init(); });
});

$(function() {
    $(document).on('change', '#activityList', function(e) {
        if (this.value == '') {
            $('#commentVal').html('---');
            $('#descVal').html('---');
        } else {
            var activityDetails = this.value;
            var arr = activityDetails.split("_");
            var title = arr[1];
            var description = arr[3];

            $('#commentVal').html(title);
            $('#descVal').html(description);
        }
    })

});

function getEmailList(val) {
    if (val == '') {
        $('#emailText').html('');
        $("#pemailColor").css("display", "block");
    } else {
        $("#pemailColor").css("display", "none");
        var str1 = val;
        var str2 = "@";
        if (str1.indexOf(str2) != -1) {
            var datastring = 'email=' + val;
            ajax.url = window.baseUrl + 'lead/checkEmailExist';
            $.ajax({
                type: "POST",
                url: ajax.url,
                data: datastring,
                success: function(data) {
                    $('#emailText').html(data);
                },
                error: function() { alert("Error fetching User."); }

            });
        }
    }
}

//----------------------------------Lead Activity----------------------------------------------------

// $(function()
// {
//    $(document).on('change', '#selecLeadOpportinutyadd', function(e)
//    {
//     var leadOppId = this.value; 
//     var arr = leadOppId.split(":");   
//     var fst = arr.splice(0,1).join("");
//     var e1 =arr[0]; var p1 =arr[1];
//     var full_name = arr[2]; var designation =arr[3];
//     var company =arr[4];
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
//     CKEDITOR.replace('description');
//    })

// });

$(function() {
    $(document).on('change', '#activity_typeUpdate', function(e) {
        if (this.value == 'Compose Email') {
            $("#descriptionField").css("display", "block");
            $("#attachment").css("display", "block");
            $("#checkSendEmail").css("display", "block");
            $('#title').html('<span style="color:red;">* </span>Subject');
        } else if (this.value == 'Phone Call') {
            $("#descriptionField").css("display", "none");
            $("#attachment").css("display", "none");
            $("#checkSendEmail").css("display", "none");
            $('#title').html('<span style="color:red;">* </span>Add Note');
        } else if (this.value == 'Schedule Meeting') {
            $("#descriptionField").css("display", "none");
            $("#attachment").css("display", "none");
            $("#checkSendEmail").css("display", "none");
            $('#title').html('<span style="color:red;">* </span>Agenda');
            $("#checkSendEmail").css("display", "none");
        } else if (this.value == 'Create Task') {
            $("#descriptionField").css("display", "none");
            $("#attachment").css("display", "none");
            $("#checkSendEmail").css("display", "none");
            $('#title').html('<span style="color:red;">* </span>Title');
            $("#checkSendEmail").css("display", "none");
        }

        $("#drafttime").css("display", "none");
        $("#drafttime").attr("disabled", "disabled");

        ajax.url = 'activity/getActivityStatus';
        dataString = 'activty_type=' + this.value;
        $.ajax({
            type: "POST",
            url: ajax.url,
            data: dataString,
            success: function(data) {
                $('#activityStatus').html(data);
            },
            error: function() { alert("Error Fetching Data."); }
        });
    });

    $(document).on('change', '#activity_status', function(e) {
        if (this.value == 'Complete') {

            $("#followUp").css("display", "block");

            $("#drafttime").css("display", "none");
            $("#drafttime").attr("disabled", "disabled");
        } else if (this.value == 'Send Later') {
            $("#drafttime").removeAttr("disabled");
            $("#drafttime").css("display", "block");
        } else {

            $("#followUp").attr("disabled", "disabled");
            $("#followUp").css("display", "none");
            $("#drafttime").css("display", "none");

            $("#drafttime").css("display", "none");
            $("#drafttime").attr("disabled", "disabled");
            // document.getElementById('drafttime').disabled = true;
        }
    });

});

function selectOpportunity(val) {

    ajax.url = 'activity/getOpportunityDetails';
    dataString = 'value=' + val;
    $.ajax({
        type: "POST",
        url: ajax.url,
        data: dataString,
        success: function(data) {
            var arr = data.split("|");
            // console.log(arr);
            //var fst = 2;
            contacts = arr[3].split(",");
            var contactCount = contacts.length;
            var phoneNew = new Array();
            var emailNew = new Array();
            for (var i = 0; i < contactCount; i++) {
                var conList = contacts[i].split("_");
                if (conList[1] == 'Email') {
                    emailNew[i] = conList[0];
                } else {
                    phoneNew[i] = conList[0];
                }
            }
            var emailList = emailNew.filter(Boolean);
            emailList = emailList.join(' | ');
            var phoneList = phoneNew.filter(Boolean);
            phoneList = phoneList.join(' | ');
            var e1 = arr[0];
            var p1 = arr[1];
            var fk_opportunity_id = arr[4];
            var oppTitle = arr[5];
            var full_name = arr[0];
            var designation = arr[1];
            var company = arr[2];
            var email = emailList;
            var phone = phoneList;

            ajax.url = 'activity/getActivityHistory';
            dataString = 'fk_lead_opportunity_id=' + fk_opportunity_id;
            $.ajax({
                type: "post",
                url: ajax.url,
                data: dataString,
                success: function(data) {
                    $('#getHistory').html(data);
                }
            });


            $('#selectLeadOpp').hide();
            $('#addLeadActivity').modal("show");
            //$('#opp-create-update').val(fst);
            $('#fk_lead_opportunity_id').val(fk_opportunity_id);
            $('#oppTitle').html(oppTitle);
            $('#attachFullname').html(full_name);
            $('#attachDesignation').html(designation);
            $('#attachCompany').html(company);
            $('#attachPhone').html(phone);
            $('#attachEmail').html(email);
            CKEDITOR.replace('message');
        },
        error: function() { alert("Error Adding Division."); }

    });

}


function changeColor(moduleName, val) {
    if (moduleName == 'firstName' && val != '') {
        $("#firstnameColor").css("display", "none");
    } else if (moduleName == 'firstName' && val == '') {
        $("#firstnameColor").css("display", "block");
    }

    if (moduleName == 'pphone' && val != '') {
        $("#pphoneColor").css("display", "none");
    } else if (moduleName == 'pphone' && val == '') {
        $("#pphoneColor").css("display", "block");
    }

    if (moduleName == 'company' && val != '') {
        $("#companyColor").css("display", "none");
    } else if (moduleName == 'company' && val == '') {
        $("#companyColor").css("display", "block");
    }

    if (moduleName == 'city' && val != '') {
        $("#companyCityColor").css("display", "none");
    } else if (moduleName == 'city' && val == '') {
        $("#companyCityColor").css("display", "block");
    }

    if (moduleName == 'usercity' && val != '') {
        $("#userCityColor").css("display", "none");
    } else if (moduleName == 'usercity' && val == '') {
        $("#userCityColor").css("display", "block");
    }

    if (moduleName == 'addNote' && val != '') {
        $("#addNoteColor").css("display", "none");
    } else if (moduleName == 'addNote' && val == '') {
        $("#addNoteColor").css("display", "block");
    }


}

$(document).on('click', '#checkFollowUp', function(e) {
    if (this.checked) {
        $("#showFollowup").css("display", "block");
        $("#showReminder").css("display", "block");
    } else {
        $("#showFollowup").css("display", "none");
        $("#showReminder").css("display", "none");
    }

})

//------------------------------------------------------------------------------


$(document).on('click', '.my-profile', function() {
    thisObj = $(this);
    var url = thisObj.data('url');
    ajax.init();
    ajax.method = 'get';
    ajax.url = url;
    ajax.ajaxCall(ajax.displayForm);
});

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

//-----------------Company-------------------------------------

$(document).on('click', '#addDivision', function(e) {
    var getVal = $("#getValue").val();
    ajax.url = 'company/getDivision';
    dataString = 'value=' + getVal;
    $.ajax({
        type: "POST",
        url: ajax.url,
        data: dataString,
        success: function(data) {
            if (getVal == 'addNew') {
                $('#addDivision').html('Go Back ?');
                $('#getValue').val('goBack');
            } else {
                $('#addDivision').html('Add New ?');
                $('#getValue').val('addNew');
            }
            $('#replaceDivision').html(data);
        },
        error: function() { alert("Error Adding Division."); }

    });

})

$(document).on('click', '#addIndustry', function(e) {
    var getVal = $("#getValue").val();
    ajax.url = 'company/getIndustry';
    dataString = 'value=' + getVal;
    $.ajax({
        type: "POST",
        url: ajax.url,
        data: dataString,
        success: function(data) {
            if (getVal == 'addNew') {
                $('#addIndustry').html('Go Back ?');
                $('#getValue').val('goBack');
            } else {
                $('#addIndustry').html('Add New ?');
                $('#getValue').val('addNew');
            }
            $('#replaceIndustry').html(data);
        },
        error: function() { alert("Error Adding Industry."); }

    });

})


//-------------------Users Module-----------------------------

function getRolePermissions(user_id = null) {
    var roleId = $("#LeadusrRole").children("option:selected").val();
    if (roleId == '') {
        $('#permissionMsg').html("<span style='color:red;'>Please Select Role First !</span>");
    } else {
        ajax.url = window.baseUrl + 'users/getRolePermissions/' + user_id;
        dataString = 'role_id=' + roleId;
        $.ajax({
            type: "POST",
            url: ajax.url,
            data: dataString,
            success: function(data) {
                $('#permissionMsg').html(data);
            },
            error: function() { alert("Error Fetching Permissions."); }

        });
    }
}

function getPermissionValue(val, module_name = null) {
    var id = 'permissioncheck' + val;
    if (module_name == 'View all Users Activities') {
        var user_col_id = 'userActivity' + val;
    }

    if (module_name == 'View all Users Comments') {
        var user_col_id = 'userComment' + val;
    }

    if (module_name == 'View all Users opportunities') {
        var user_col_id = 'userOpportunity' + val;
    }

    if (module_name == 'View All Users Data') {
        var user_col_id = 'userAdded' + val;
    }
    if (module_name == 'View All Company Data') {
        var user_col_id = 'companyAdded' + val;
    }

    var checkStatus = document.getElementById(id).checked;
    if (checkStatus) {
        $("#" + user_col_id).css("display", "block");
    } else {
        $("#" + user_col_id).css("display", "none");
    }
}

function getRoleNotifications(user_id = null) {
    var roleId = $("#LeadusrRole").children("option:selected").val();
    if (roleId == '') {
        $('#notificationMsg').html("<span style='color:red;'>Please Select Role First !</span>");
    } else {
        ajax.url = window.baseUrl + 'users/getRoleNotifications/' + user_id;
        dataString = 'role_id=' + roleId;
        $.ajax({
            type: "POST",
            url: ajax.url,
            data: dataString,
            success: function(data) {
                $('#notificationMsg').html(data);
            },
            error: function() { alert("Error Fetching Permissions."); }

        });
    }
}

// function selectTitle(val) {
// ajax.url = window.baseUrl+'lead/getOpportunityMaster';
// dataString = 'company_name='+val+'&company_type='+type;
// }

function selectCompany(val, type) {
    ajax.url = window.baseUrl + 'users/getCompanyDetails';
    dataString = 'company_name=' + val + '&company_type=' + type;
    $.ajax({
        type: "POST",
        url: ajax.url,
        data: dataString,
        success: function(data) {
            var arr = data.split("|");

            var company_id = arr[0];
            var company_name = arr[1];
            var parent_company_id = arr[2];
            var bussiness_contact = arr[3];
            var street_address = arr[4];
            var city = arr[5];
            var state = arr[6];
            var country = arr[7];
            var dialing_code = arr[8];
            var zip_code = arr[9];
            var fax = arr[10];
            var parentCompany = arr[11];
            var parentCompanyId = arr[12];
            var industry_name = arr[13];
            var industry_id = arr[14];
            if (dialing_code && dialing_code != undefined) {
                // var new_bussiness_contact = dialing_code + ' - ' + bussiness_contact;
                $('#company_bussiness_contact').val(bussiness_contact);
                document.getElementById("dialing_code_append").innerHTML = dialing_code;
                $('#dialing_code').val(dialing_code);
            }

            if (country && country != undefined) {
                $('#companyCountry').val(country);
                $("#companyCountryColor").css("display", "none");
            }

            if (city && city != undefined) {
                $("#companyCityColor").css("display", "none");
            }

            var countryarray = country.split('-');
            $('#add_country').val(country);
            $('#LeadUsrCity').val(city);

            $('#parent_comp').val(parentCompany);
            $('#parent_company').val(parentCompanyId);
            $('#fk_industry_name').val(industry_name);
            $('#fk_industry_id').val(industry_id);
            $('#companyAdd').val(street_address);
            $('#companyPin').val(zip_code);
            $('#companyCity').val(city);
            $('#companyState').val(state);
            $('#company_id').val(company_id);
            //$('#companyCountry').children("option:selected").val(country);

        },
        error: function() { alert("Error Fetching Data."); }

    });

}

$(document).on('click', '#sameCompanyAdd', function(e) {
    if (this.checked) {
        var sa = $('#companyAdd').val();
        var zip = $('#companyPin').val();
        var city = $('#companyCity').val();
        var state = $('#companyState').val();
        var country = $('#companyCountry').val();

        if (sa == '' && zip == '' && city == '' && state == '' && country == '') {
            alert('Please Fill Company Details First.')
        } else {
            $('#UsrAdd').val(sa);
            $('#UsrPin').val(zip);
            $('#UsrCity').val(city);
            $('#UsrState').val(state);
            $('#add_country').val(country);
        }
    } else {
        $('#UsrAdd').val('');
        $('#UsrPin').val('');
        $('#UsrCity').val('');
        $('#UsrState').val('');
        $('#add_country').val('');
    }

})

$(document).on('click', '#sameLeadCompanyAdd', function(e) {
    if (this.checked) {
        var sa = $('#LeadUsrAdd').val();
        var zip = $('#LeadUsrPin').val();
        var city = $('#LeadUsrCity').val();
        var state = $('#LeadUsrState').val();
        var country = $('#add_country').val();

        if (sa == '' && zip == '' && city == '' && state == '' && country == '') {
            alert('Please Fill Company Details First.')
        } else {
            if (city != '') {
                $("#userCityColor").css("display", "none");
            }
            if (country != '') {
                $("#userCountryColor").css("display", "none");
            }
            $('#UsrAdd').val(sa);
            $('#UsrPin').val(zip);
            $('#UsrCity').val(city);
            $('#UsrState').val(state);
            $('#add_user_country').val(country);
        }
    } else {
        $('#UsrAdd').val('');
        $('#UsrPin').val('');
        $('#UsrCity').val('');
        $('#UsrState').val('');
        $('#add_user_country').val('');
    }

});

$(document).on('click', '#activityDetailsCheck', function(e) {
    if (this.checked) {
        $("#activitySection").css("display", "block");
    } else {
        $("#activitySection").css("display", "none");
    }

})

$(document).on('click', '#leadDetailsCheck', function(e) {
    if (this.checked) {
        $("#leadSection").css("display", "block");
    } else {
        $("#leadSection").css("display", "none");
    }

})

$(document).on('click', '#clientDetailsCheck', function(e) {
    if (this.checked) {
        $("#userSection").css("display", "block");
    } else {
        $("#userSection").css("display", "none");
    }

})

//------------Auto Complete Code-------------------------------

// For Company Module
var companytags = window.industry;

function ac_Company(value) {
    var n = companytags.length; //length of datalist tags 
    document.getElementById('datalist').innerHTML = '';
    //setting datalist empty at the start of function 
    //if we skip this step, same name will be repeated 

    l = value.length;
    //input query length 
    for (var i = 0; i < 500; i++) {
        if (((companytags[i].toLowerCase()).indexOf(value.toLowerCase())) > -1) {
            //comparing if input string is existing in tags[i] string 

            var node = document.createElement("option");
            var val = document.createTextNode(companytags[i]);
            node.appendChild(val);

            document.getElementById("datalist").appendChild(node);
            //creating and appending new elements in data list 
            // alert(val);
        }
    }
}

// For Users Module

var companytags = window.companyList;

function ac_UserCompany(value) {
    var n = companytags.length; //length of datalist tags 
    document.getElementById('datalist').innerHTML = '';
    //setting datalist empty at the start of function 
    //if we skip this step, same name will be repeated 

    l = value.length;
    //input query length 
    for (var i = 0; i < 500; i++) {
        if (((companytags[i].toLowerCase()).indexOf(value.toLowerCase())) > -1) {
            //comparing if input string is existing in tags[i] string 

            var node = document.createElement("option");
            var val = document.createTextNode(companytags[i]);
            node.appendChild(val);

            document.getElementById("datalist").appendChild(node);
            //creating and appending new elements in data list 
            // alert(val);
        }
    }
}