$(document).ready(function() {

    table.url = window.baseUrl + 'analysis/get/list/' + window.customeFilter;

    table.columns = window.column,

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
                    console.log(row);
                    if (row.dataAnalysis) {

                        return '<button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal" ' + row.bwiCount + '><span class="m-menu__link-badge"><span class="m-menu__link-icon call-form upload-bid" data-url="' + window.baseUrl + 'analysis/rfqDataAnalysis/' + row.b_id + '" ' + row.modelShow + '>Quote Comparison</span></span></button><button type="button" class="btn btn-primary m-btn m-btn--custom col-sm-122" style="margin-left:10px;" data-toggle="modal" data-target="#m_select_modal" ' + row.bwiCount + '><span class="m-menu__link-badge"><span class="m-menu__link-icon call-form optimal-analysis" data-url="' + window.baseUrl + 'analysis/rfqDataAnalysis/' + row.b_id + '/optimal' + '" ' + row.modelShow + '>Optimal Quote</span></span></button>';

                    } else {

                        return 'No Data Fount For Analysis';

                    }

                },

                "targets": 1,

                "width": 430,

                "orderable": false

            }

        ];

    table.createDataTable();

    $(document).on('click', '.edit-rfq', function() {

        thisObj = $(this);

        dataId = thisObj.data('id');

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayFormActivity);

    });



    $(document).on('click', '.upload-bid', function() {

        thisObj = $(this);

        $('#modal').find('.form-modal-tile').html('Quote Comparison');

        dataId = thisObj.data('id');

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayuploadBid);

    });



    $(document).on('click', '.optimal-analysis', function() {

        thisObj = $(this);

        $('#modal').find('.form-modal-tile').html('Optimal Quote');

        dataId = thisObj.data('id');

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayuploadBid);

    });



});



$(document).on('change', '#lead_opportunity_id', function(e) {

    var val = $('#lead_opportunity_id option:selected').val();

    var dataString = 'lead_opportunity_id=' + val;



    $.ajax({

        type: "POST",

        url: window.baseUrl + "analysis/get/company",

        data: dataString,

        dataType: "html",

        success: function(data) {

            if (data != '') {

                newdata = '(' + data + ')';

                $('#company_name').val(newdata);

            }



        },

        error: function() { alert("Error posting feed."); }

    });

});



// $(document).ready(function () {

//     $('#posts').DataTable({

//         "processing": true,

//         "serverSide": true,

//         "ajax":{

//          "url": "proposal/getItem",

//          "dataType": "json",

//          "type": "POST"

//                        },

//     "columns": [

//               { "data": "title" },

//               { "data": "opportunity_title" },

//               { "data": "sales_person" },

//               { "data": "sales_person" },

//            ]     



//     });

// });

$(document).on('click', '#saveRFQ', function(e) {

    var markup_type_value = '';

    var markup_type_value_ex_factory = '';

    var markup_type_value_fabric = '';

    var markup_type_value_leather = '';

    var fk_b_id = $("#fk_b_id").val();

    var supplier_id = $("#supplier_id").val();

    var lead_opportunity_id = $("#lead_opportunity_id").val();

    var notes = $("#notes").val();

    var approval_deadline = $("#m_datepicker_3_3modal").val();

    var radioValue = $("input[name='markuptypeCheck']:checked").val();

    if (radioValue == 'fixed') {

        markup_type_value_ex_factory = $("#fixedInputBox_ex_factory").val();

        markup_type_value_fabric = $("#fixedInputBox_fabric").val();

        markup_type_value_leather = $("#fixedInputBox_leather").val();

    }

    // alert(fk_b_id);

    // alert(JSON.stringify(supplier_id));

    datastring = { 'b_id': fk_b_id, 'supplier_id': supplier_id, 'approval_deadline': approval_deadline, 'markup_type': radioValue, 'markup_type_value_fabric': markup_type_value_fabric, 'markup_type_value_ex_factory': markup_type_value_ex_factory, 'markup_type_value_leather': markup_type_value_leather, 'notes': notes, 'lead_opportunity_id': lead_opportunity_id };



    // alert(JSON.stringify(datastring));



    $.ajax({

        type: "POST",

        url: window.baseUrl + "analysis/save",

        data: datastring,

        dataType: "html",

        success: function(data) {

            var msg = "<div class='alert alert-success'><strong>Success!</strong> RFQ Updated Successfully</div>";

            $('#validation_errors_rfq').html(msg);

        },

        error: function() { alert("Error posting feed."); }

    });



});



$(document).on('click', '#save', function(e) {

    var fk_b_id = $("#fk_b_id").val();

    var approval_deadline = $("#m_datepicker_3_3modal").val();

    var lead_opportunity_id = $("#lead_opportunity_id").val();

    var supplier_id = $("#supplier_id").val();

    var notes = $("#notes").val();

    // alert(supplier_id.length);

    var item_id = $("#item_id").val();

    if (!lead_opportunity_id) {

        // alert("Please select a Lead Opportunity!! ");

        msg = "<div class='alert alert-success'><strong>Error!</strong> Please select a Lead Opportunity!!</div>";

        $('#validation_errors_rfq').html(msg);

    } else if (supplier_id.length == 0) {

        // alert("Please select the Supplier!! ");

        msg = "<div class='alert alert-success'><strong>Error!</strong> Please select the Supplier!!</div>";

        $('#validation_errors_rfq').html(msg);

    } else if (!item_id) {

        // alert("Please add Items");

        msg = "<div class='alert alert-success'><strong>Error!</strong> Please add Items!!</div>";

        $('#validation_errors_rfq').html(msg);

    } else {

        datastring = { 'fk_b_id': fk_b_id, 'supplier_id': supplier_id, 'approval_deadline': approval_deadline, 'notes': notes };

        check = confirm("Are you sure, you want to sent mail status ?");

        if (check) {

            $.ajax({

                type: "POST",

                url: window.baseUrl + "analysis/sent/mail",

                data: datastring,

                dataType: "html",

                success: function(data) {

                    console.log(data);

                    console.log(data['message']);

                    if (data['message'] == 'Success') {

                        alert("Mail Successfully Sent");

                        msg = "<div class='alert alert-success'><strong>Success!</strong> Mail Successfully Sent</div>";

                        $('#validation_errors_rfq').html(msg);

                    }

                    /* else

                     {$('#validation_errors_rfq').html("somthing went wrong. Please sent mail again");}*/

                    window.location.reload();

                },

                error: function() { alert("Error posting feed."); }

            });

        } else {

            return false;

        }

    }

});





/*$(document).on('click', '#decline', function(e) {

    var fk_b_id = $("#fk_b_id").val();

    datastring = 'fk_b_id='+fk_b_id;

    check = confirm("Are you sure, you want to change status ?");

    if (check) {

        $.ajax({

            type: "POST",

            url: window.baseUrl+"Rfq/set/status/Declined",

            data: datastring,

            dataType: "html",

            success: function(data){

                

                window.location.reload();

            },

            error: function() { alert("Error posting feed."); }

       });

    } else {

        return false;

    }

});



$(document).on('click', '#release', function(e) {

    var fk_pid = $("#fk_pid").val();

    datastring = 'fk_pid='+fk_pid;

    check = confirm("Are you sure, you want to change status ?");

    if (check) {

        $.ajax({

            type: "POST",

            url: window.baseUrl+"Rfq/set/status/Released",

            data: datastring,

            dataType: "html",

            success: function(data){

                // console.log(data);

                window.location.reload();

            },

            error: function() { alert("Error posting feed."); }

       });

    } else {

        return false;

    }

});

*/

function getAmountstructure(amt) {

    var str = amt.toString().split('.');

    if (str[0].length >= 4) {

        //add comma every 3 digits befor decimal

        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');

    }

    var result = str.join('.');

    return result;

}



$(document).on('keyup', '#lead_opportunity', function(e) {

    var lead_opportunity = $("#lead_opportunity").val();

    datastring = 'lead_opportunity=' + lead_opportunity;

    $.ajax({

        type: "POST",

        url: window.baseUrl + "analysis/get/leadOpportunity",

        data: datastring,

        dataType: "html",

        success: function(data) {

            if (data) {

                $('#getLO').html(data);

            }

        },

        error: function() { alert("Error posting feed."); }

    });

});





//----- Unit Price Ex Factory Start-------------------------------

$(document).on('change', '#add_unit_price_markup', function(e) {

    var val = $('#add_unit_price_markup option:selected').text();

    var unit_cost = $("#ex_factory_unit_price").val();

    var quantity = $("#add_quantity").val();

    if (quantity == '') {

        $('#quantity_alert').html('<b>First Add Quantity.</b>');

        $("#add_ex_factory_unit_price_alert").val('');

        $("#add_unit_price_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }



    $('#quantity_alert').html('');

    $('#unit_cost_alert').html('');

    $("#add_ex_factory_total_markup").attr("readonly", false);

    $('#unit_price_markup1').val(val);

    $('#add_ex_factory_mark_up_amt').val('');

    $('#add_ex_factory_total_markup').val('');

    $('#add_total_price_ex_factory').val('');

});



function getExFactoryTotalMarkup(val) {

    var unit_cost = $("#add_ex_factory_unit_price").val();

    //alert(unit_cost);

    var quantity = $("#add_quantity").val();

    //alert(quantity);

    var unit_price_markup = $('#unit_price_markup1').val();

    //alert(unit_price_markup);

    if (quantity == '') {

        $('#quantity_alert').html('<b>First Add Quantity.</b>');

        $("#add_ex_factory_unit_price_alert").val('');

        $("#add_unit_price_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }

    $('#quantity_alert').html('');

    $('#ex_factory_unit_price').html('');

    if (unit_price_markup == '%') {

        var amt = unit_cost * (val / 100);

    } else if (unit_price_markup == '$/unit') {

        var amt = quantity * val;

    } else if (unit_price_markup == 'Total Markup') {

        var amt = quantity * unit_cost + + +val;

    }

    var total_ex_factory = amt + +quantity * unit_cost;

    var ex_factory_markup = getAmountstructure(amt);

    var total_ex_factory_amt = getAmountstructure(total_ex_factory);

    //var owner_price = ;

    $("#add_ex_factory_total_markup").val(ex_factory_markup);

    $("#add_total_price_ex_factory").val(total_ex_factory_amt);

}



//----- Unit Price Ex Factory End-------------------------------



//----- Fabric MArkup Start-------------------------------

$(document).on('change', '#add_fabric_markup', function(e) {

    var val = $('#add_fabric_markup option:selected').text();

    var unit_cost = $("#add_fabric_price").val();

    var quantity = $("#fabric_quantity").val();

    if (quantity == '') {

        $('#add_fabric_quantity_alert').html('<b>First Add Fabrics Quantity.</b>');

        $("#add_fabric_price_alert").val('');

        $("#add_fabric_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#add_fabric_quantity_alert').html('');

        $('#add_fabric_price_alert').html('<b>Add Fabrics Cost.</b>');

        $('#add_fabric_markup').prop('selectedIndex', 0);

        return false;

    }



    $('#add_fabric_quantity_alert').html('');

    $('#add_fabric_price_alert').html('');

    $('#unit_price_markup2').val(val);

    $('#add_fabric_mark_up_amt').val('');

    $('#add_fabrics_total_markup').val('');

    $('#add_unit_total_price_fabric').val('');

});



function getFabricsTotalMarkup(val) {

    var unit_cost = $("#add_fabric_price").val();

    //alert(unit_cost);

    var quantity = $("#add_fabric_quantity").val();

    //alert(quantity);

    var unit_price_markup = $('#unit_price_markup2').val();

    //alert(unit_price_markup);

    if (quantity == '') {

        $('#add_fabric_quantity_alert').html('<b>First Add Quantity.</b>');

        $("#add_fabric_price_alert").val('');

        $("#add_fabric_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#add_fabric_quantity_alert').html('');

        $('#add_fabric_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_fabric_markup').prop('selectedIndex', 0);

        return false;

    }

    $('#add_fabric_quantity_alert').html('');

    $('#add_fabric_price_alert').html('');

    if (unit_price_markup == '%') {

        var amt = unit_cost * (val / 100);

    } else if (unit_price_markup == '$/unit') {

        var amt = quantity * val;

    } else if (unit_price_markup == 'Total Markup') {

        var amt = quantity * unit_cost + + +val;

    }

    var total_ex_factory = amt + +quantity * unit_cost;

    var ex_factory_markup = getAmountstructure(amt);

    var total_ex_factory_amt = getAmountstructure(total_ex_factory);

    //var owner_price = ;

    $("#add_fabrics_total_markup").val(ex_factory_markup);

    $("#add_unit_total_price_fabric").val(total_ex_factory_amt);

}



//----- Fabric MArkup End-------------------------------



//----- Leather Markup Start-------------------------------



$(document).on('change', '#leather_markup', function(e) {

    var val = $('#leather_markup option:selected').text();

    var unit_cost = $("#add_leather_price").val();

    var quantity = $("#add_leather_quantity").val();

    if (quantity == '') {

        $('#add_leather_quantity_alert').html('<b>First Add Leather Quantity.</b>');

        $("#add_leather_price_alert").val('');

        $("#leather_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#add_leather_quantity_alert').html('');

        $('#add_leather_price_alert').html('<b>Add Leather Cost.</b>');

        $('#leather_markup').prop('selectedIndex', 0);

        return false;

    }



    $('#add_leather_quantity_alert').html('');

    $('#add_leather_price_alert').html('');

    $('#unit_price_markup3').val(val);

    $('#add_leather_mark_up_amt').val('');

    $('#add_leather_total_markup').val('');

    $('#add_unit_total_price_leather').val('');

});



function getLeatherTotalMarkup(val) {

    var unit_cost = $("#add_leather_quantity").val();

    var quantity = $("#add_leather_price").val();

    var unit_price_markup = $('#unit_price_markup3').val();



    if (quantity == '') {

        $('#add_leather_quantity_alert').html('<b>First Add Quantity.</b>');

        $("#add_leather_price_alert").val('');

        $("#leather_markup").prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#add_leather_quantity_alert').html('');

        $('#add_leather_price_alert').html('<b>Add Unit Cost.</b>');

        $('#leather_markup').prop('selectedIndex', 0);

        return false;

    }

    $('#add_leather_quantity_alert').html('');

    $('#add_leather_price_alert').html('');

    if (unit_price_markup == '%') {

        var amt = unit_cost * (val / 100);

    } else if (unit_price_markup == '$/unit') {

        var amt = quantity * val;

    } else if (unit_price_markup == 'Total Markup') {

        var amt = quantity * unit_cost + + +val;

    }

    var total_ex_factory = amt + +quantity * unit_cost;

    var ex_factory_markup = getAmountstructure(amt);

    var total_ex_factory_amt = getAmountstructure(total_ex_factory);

    //var owner_price = ;

    $("#add_leather_total_markup").val(ex_factory_markup);

    $("#add_unit_total_price_leather").val(total_ex_factory_amt);

}

//----- Leather Markup End-------------------------------



//------Total Price FOB-----------------------

function getFOB(val) {

    var unit_cost = $("#ex_factory_unit_price").val();

    var quantity = $("#add_quantity").val();

    // var total_price_ex_factory = $('#add_total_price_ex_factory').val();

    if (quantity == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Quantity.</b>');

        $('#add_unit_price_fob_alert').html('<b>Add Quantity in Ex Factory Section.</b>');

        $('#quantity_alert').focus();

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_fob_alert').html('<b>Add Unit Price in Ex Factory Section.</b>');

        $('#add_ex_factory_unit_price').focus();

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }
    /*else if (total_price_ex_factory == '') {

           $('#quantity_alert').html('');

           $('#add_ex_factory_unit_price_alert').html('');

           $('#add_unit_price_fob_alert').html('<b>Need To Set Total Price Ex Factory.</b>');

           // $('#total_price_ex_factory_alert').html('<b>Required to get Total FOB.</b>');

           $('#add_unit_price_markup').prop('selectedIndex',0);

       }*/

    $('#quantity_alert').html('');

    $('#add_ex_factory_unit_price_alert').html('');

    // $('#total_price_ex_factory_alert').html('');

    $('#add_unit_price_fob_alert').html('');



    var fob = (val * quantity);

    //var owner_price = ;

    $("#add_total_price_fob").val(fob);

}

//------Total Price FOB End-------------------



//------Total Price CIF-----------------------

function getCIF(val) {

    var unit_cost = $("#ex_factory_unit_price").val();

    var quantity = $("#add_quantity").val();

    // var total_price_ex_factory = $('#add_total_price_ex_factory').val();

    if (quantity == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Quantity.</b>');

        $('#add_unit_price_cif_alert').html('<b>Add Quantity in Ex Factory Section.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    } else if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_cif_alert').html('<b>Add Unit Price in Ex Factory Section.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }
    /*else if (total_price_ex_factory == '') {

           $('#quantity_alert').html('');

           $('#add_ex_factory_unit_price_alert').html('');

           $('#total_price_ex_factory_alert').html('<b>Required to get Total CIF.</b>');

           $('#add_unit_price_cif_alert').html('<b>Need To Set Total Price Ex Factory.</b>');

           $('#add_unit_price_markup').prop('selectedIndex',0);

       }*/

    $('#quantity_alert').html('');

    $('#add_ex_factory_unit_price_alert').html('');

    // $('#total_price_ex_factory_alert').html('');

    $('#add_unit_price_cif_alert').html('');



    var CIF = (val * quantity);

    //var owner_price = ;

    $("#add_total_price_cif").val(CIF);

}

//------Total Price CIF End-------------------





$(document).on('click', '#addButton', function(e) {

    $('#addModal').modal("show");

    $("#addModal").addClass("show");

    $('#addModal').show();

});



$(document).on('click', '#closeItemButton', function(e) {

    // $('#addModal').modal("hide");

    $("#addModal").removeClass("show");

    // $("#addModal").removeClass("in");

    $('#addModal').hide();

    var fk_b_id = $("#fk_b_id").val();

    location.reload();

    //ajax.ajaxCall(ajax.displayFormActivity);

});



$(document).on('click', '#importButton', function(e) {

    $('#import-excel-modal').modal("show");

    $("#import-excel-modal").addClass("show");

    $('#import-excel-modal').show();

});



// $(document).on('click touch', function(event) {

//     if (!$(event.target).parents().addBack().is('#trigger')) {

//         $('#addModal').hide();

//     }

// });



$(document).on('click', '#closeImportButton', function(e) {

    // $('#import-excel-modal').modal("hide");

    $("#import-excel-modal").removeClass("show");

    $('#import-excel-modal').hide();

    var fk_b_id = $("#fk_b_id").val();

    datastring = { fk_b_id: fk_b_id };

    table.rfqPopupTable(datastring);

    //  $.ajax({

    //      type: "POST",

    //      url: window.baseUrl+"Proposal/table/getItemList",

    //      data: datastring,

    //      dataType: "html",

    //      success: function(data){

    //          if (data !='') {

    //              $('#tableList').html(data);

    //          } else {

    //              $('#tableList').html("<table class='table table-bordered'><thead><tr style='height: 32px;color: black;background-color: #d1cdcd;font-size: 18px'><th>Sr No</th><th>Item</th><th>Item Code</th></tr></thead><tbody><tr><td colspan='3'>No Data Available</td></tr></tbody></table>");

    //          }



    //      },

    //      error: function() { alert("Error posting feed."); }

    // });



});







$(document).on('click', '#close', function(e) {

    $('#modal').modal("hide");

    $("#modal").removeClass("show");

    $('#modal').hide();

    var fk_b_id = $("#fk_b_id").val();

    datastring = { fk_b_id: fk_b_id };

    table.rfqPopupTable(datastring);

});



$(document).on('click', '#checkWorkshhet', function(e) {

    var lead_opportunity_id = $("#lead_opportunity_id").val();

    var approval_deadline = $("#m_datepicker_3_3modal").val();

    var supplier_id = $("#supplier_id").val();

    var notes = $("#notes").val();

    var p_id = $("#fk_b_id").val();

    var dataString = 'notes=' + notes + '&approval_deadline=' + approval_deadline + '&lead_opportunity_id=' + lead_opportunity_id + '&supplier_id=' + supplier_id;

    if (p_id) {

        $("#showUL").css("display", "block");

        $("#checkWorkshhet").prop("checked", true);

        $("#checkWorkshhet").attr("disabled", true);

    } else

    if (lead_opportunity_id == '') {

        $('#lead_id_alert').html('<b>This field is required.</b>');

        $("#checkWorkshhet").prop("checked", false);

        return false;

    } else

    if (approval_deadline == '') {

        $('#deadline_alert').html('<b>This field is required.</b>');

        $("#checkWorkshhet").prop("checked", false);

        return false;

    } else {

        $.ajax({

            type: "POST",

            url: window.baseUrl + "analysis/addRfq",

            data: dataString,

            dataType: "html",

            success: function(data) {

                var response = JSON.parse(data);

                if (response.code == 200) {

                    $('#lead_id_alert').html('');

                    $('#deadline_alert').html('');

                    $("#showUL").css("display", "block");

                    $("#checkWorkshhet").attr("disabled", true);

                    var msg = "<div class='alert alert-success'><strong>Success!</strong> RFQ Added Successfully</div>";

                    $('#fk_b_id').val(response.data);

                    $('#add_import_id').val(response.data);

                    $('#validation_errors_rfq').html(msg);

                    $('#pw_id').val(response.itemId);

                    CKEDITOR.replace('format_header');

                    CKEDITOR.replace('format_footer');

                } else {

                    $('#validation_errors_rfq').html(response.message);

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

    // var format_footer = $("#format_footer").val();

    var format_header = CKEDITOR.instances.format_header.getData();

    var format_footer = CKEDITOR.instances.format_footer.getData();



    var fk_b_id = $("#fk_b_id").val();

    var bf_id = $("#bf_id").val();



    var dataString = 'format_header=' + format_header + '&format_footer=' + format_footer + '&fk_b_id=' + fk_b_id + '&bf_id=' + bf_id;



    $.ajax({

        type: "POST",

        url: window.baseUrl + "analysis/Format/add",

        data: dataString,

        dataType: "html",

        success: function(data) {

            var response = JSON.parse(data);

            if (response.code == 200) {

                $('#validation_errors_rfq_format').html(response.message);

                $("#fk_b_id").val();

                $('#add_format').val('Update Format');

            } else {

                $('#validation_errors_rfq_format').html(response.message);

            }



        },

        error: function() { alert("Error posting feed."); }

    });

});



$(document).on('click', '#saveMyFilter', function(e) {

    e.preventDefault();

    var filter_name = $("#filter_name").val();

    // var status = $("#status").val();

    var opportunity_status = $("#opportunity_status").val();

    var approval_deadline = $("#approval_deadline").val();

    var sales_person = $("#sales_person").val();



    var dataString = 'filter_name=' + filter_name + '&status=' + status + '&opportunity_status=' + opportunity_status + '&approval_deadline=' + approval_deadline + '&sales_person=' + sales_person;

    if (filter_name == '') {

        alert("Filter Name Required !");

    } else if (status == '' && opportunity_status == '' && approval_deadline == '' && sales_person == '') {

        alert("Please Fill Atleast One Field");

    } else {

        var dataString = 'filter_name=' + filter_name + '&status=' + status + '&opportunity_status=' + opportunity_status + '&approval_deadline=' + approval_deadline + '&sales_person=' + sales_person;

        $.ajax({

            type: "POST",

            url: window.baseUrl + "analysis/filter/add",

            data: dataString,

            cache: false,

            success: function(html) {

                window.location.reload();

            }

        });

    }

});



// $(document).ready(function(){

//     $("#feedInput2").submit(function(){

//         e.preventDefault();

//         alert('');

//         $.ajax({

//             type: "POST",

//             url: window.baseUrl+"proposal/filter/get",

//             data: dataString,

//             cache: false,

//             success: function(html) {

//                 $('#replaceFilter').html(html);

//             }

//         });

//     });

// });



$(document).on('change', '#gridsort', function(e) {

    var selectedgrid = $(this).children("option:selected").val();

    createGridTable(selectedgrid)

});



function createGridTable(val = null) {

    var favorite = [];

    var saveGridTextbox;

    $.each($("input[name='internal']:checked"), function() {

        favorite.push($(this).val());

    });

    if ($('#ischeck').is(":checked")) {

        saveGridTextbox = $('#saveGrid').val();

    }

    var datastring = 'internal=' + favorite + '&ischeck=' + saveGridTextbox + '&gridId=' + val;

    $.ajax({

        type: "POST",

        url: window.baseUrl + "analysis/createGrid",

        data: datastring,

        cache: false,

        success: function(html) {

            //console.log(html);

            var data = JSON.parse(html);

            if (data.code == 200) {

                if (data.data.columns) {

                    $('#gridView').modal('hide');

                    table.destroyDataTable();

                    table.columns = data.data.columns;

                    $('#datatable').html('');

                    table.createDataTable();

                }



                if (data.data.options) {

                    var html = '<option value="">Select View</option>';

                    for (var i = 0; i < data.data.options.length; i++) {

                        var selected = (data.data.options[i].grid_id == data.data.gridId) ? 'selected' : '';

                        html += '<option value="' + data.data.options[i].grid_id + '" ' + selected + '>' + data.data.options[i].grid_name + '</option>'

                    }

                    $('.gridView').html(html);

                }



            }

        }

    });

}



$(document).ready(function() {

    $("select.filter").change(function() {

        var selectedfilter = $(this).children("option:selected").val();

        var dataString = 'filter_id=' + selectedfilter;

        $.ajax({

            type: "POST",

            url: window.baseUrl + "analysis/filter/get",

            data: dataString,

            cache: false,

            success: function(html) {

                $('#replaceFilter').html(html);

            }

        });

    });

});



//---- To Import Excel Data-----------------------

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

        form_data.append("rfq_id", document.getElementById('customFile').files[0]);



        //console.log(document.getElementById('customFile').files[0]);

        $.ajax({

            url: "analysis/importData",

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





/*$(document).ready(function() {

    // Function to get input value.

    $('#exportExcel').click(function() {

        var res = confirm("Do You Want To Export All Data Into Excel ?");

        if (res) {

            //var columnFields = $('input#columnFields').val();

            var dataString = 'rfq=' + window.moduleType;

            $.ajax({

                method: "POST",

                url: "rfq/createExcel",

                data: dataString,

                cache: false,

                success: function(html) {

                    //console.log(html);

                    var file = html

                    window.location.href = file;

                }

            });

        }

    });

});*/



$(document).ready(function() {

    // Function to get input value.

    $('#exportExcel').click(function() {

        var list = $('#deleteRows').val();

        var arr = list.split(",");

        var fst = arr.splice(0, 1).join("");

        var rest = arr.join("_");

        var rest = rest.trim();

        if (rest) {

            var res = confirm("Do You Want To Export Selected Data Into Excel ?");

            if (res) {

                //var columnFields = $('input#columnFields').val();

                var dataString = 'rfq=' + window.moduleType + '&b_id=' + rest;

                $.ajax({

                    method: "POST",

                    url: "analysis/createExcel",

                    data: dataString,

                    cache: false,

                    success: function(html) {

                        //console.log(html);

                        var file = html

                        // window.location.href = file;

                    }

                });

            }

        } else {

            alert("Please select atleast 1 record !");

        }

    });

});



// Function to get input value.

function get_preview(b_id) {

    var fk_b_id = $('#fk_b_id').val();

    var dataString = 'b_id=' + fk_b_id;

    $.ajax({

        url: "analysis/get_preview/" + fk_b_id,

        method: "POST",

        data: dataString,

        contentType: false,

        cache: false,

        processData: false,

        success: function(data) {

            $('#printdiv').html(data);

        }

    });

};



function get_Worksheet() {

    var fk_b_id = $('#fk_b_id').val();

    datastring = { fk_b_id: fk_b_id };

    table.rfqPopupTable(datastring);

};







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



    var ChackedValuesDelete = favoriteDelete.join(", ");

    var ChackedValuesEmail = favoriteEmail.join(", ");

    if (hasNumbers(ChackedValuesDelete)) {

        $('.checked_action').addClass('activeData');

    } else {

        $('.checked_action').removeClass('activeData');

    }

    $('#sendEmail').val(ChackedValuesEmail);

    $('#deleteRows').val(ChackedValuesDelete);

});



$(document).on('click', '.checkBoxClass', function(e) {

    var favoriteDelete = ["delete"];

    $.each($("input[name='id']:checked"), function() {

        favoriteDelete.push($(this).val());

    });



    var favoriteEmail = ["email"];

    $.each($("input[name='id']:checked"), function() {

        favoriteEmail.push($(this).val());

    });

    var ChackedValuesDelete = favoriteDelete.join(", ");

    var ChackedValuesEmail = favoriteEmail.join(", ");

    if (hasNumbers(ChackedValuesDelete)) {

        $("#checkedAction").prop("disabled", false);

        $('.checked_action').addClass('activeData');

    } else {

        $("#checkedAction").prop("disabled", true);

        $('.checked_action').removeClass('activeData');

    }

    $('#sendEmail').val(ChackedValuesEmail);

    $('#deleteRows').val(ChackedValuesDelete);



});





$(document).on('click', '#itemckbCheckAll', function(e) {

    $(".itemcheckBoxClass").prop('checked', $(this).prop("checked"));

    var favoriteDelete = ["delete"];

    $.each($("input[name='id']:checked"), function() {

        favoriteDelete.push($(this).val());

    });



    var favoriteEmail = ["email"];

    $.each($("input[name='id']:checked"), function() {

        favoriteEmail.push($(this).val());

    });



    var ChackedValuesDelete = favoriteDelete.join(", ");

    var ChackedValuesEmail = favoriteEmail.join(", ");

    if (hasNumbers(ChackedValuesDelete)) {

        $("#checkedAction").prop("disabled", false);

        $('.checked_action').addClass('activeData');

    } else {

        $('.checked_action').removeClass('activeData');

        $("#checkedAction").prop("disabled", true);

    }

    $('#sendEmail').val(ChackedValuesEmail);

    $('#deleteRows').val(ChackedValuesDelete);

});



$(document).on('click', '.itemcheckBoxClass', function(e) {

    var favoriteDelete = ["delete"];

    $.each($("input[name='id']:checked"), function() {

        favoriteDelete.push($(this).val());

    });



    /*var favoriteEmail = ["email"];

      $.each($("input[name='id']:checked"), function(){   

        favoriteEmail.push($(this).val());

    });*/

    var ChackedValuesDelete = favoriteDelete.join(", ");

    // var ChackedValuesEmail = favoriteEmail.join(", ");

    if (hasNumbers(ChackedValuesDelete)) {

        $('.checked_action').addClass('activeData');

    } else {

        $('.checked_action').removeClass('activeData');

    }

    // $('#sendEmail').val(ChackedValuesEmail);

    $('#deleteRows').val(ChackedValuesDelete);



});



$(document).ready(function() {

    $("#txtEditor").Editor();

});



$(document).on('change', '#checkedAction', function(e) {

    var deactivateids = this.value;

    var arr = deactivateids.split(",");

    var fst = arr.splice(0, 1).join("");

    var rest = arr.join(",");

    if (fst == "delete") {

        var toBeDelete = 'deleteThis=' + rest;

        var answer = confirm("Are you sure you want to delete record!");

        ajax.url = window.baseUrl + 'analysis/deleterfq';

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

        }

        // else {

        //     window.location.reload();

        // } 

    }

    if (fst == "email") {

        var toBeDelete = 'getEmail=' + rest;

        ajax.url = window.baseUrl + 'analysis/getEmailIds';



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



});



//function Freez() {

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





//}



function hasNumbers(t) {

    return /\d/.test(t);

}



function getItemList(val) {

    dataString = 'bw_id=' + val;

    // console.log(dataString)

    $.ajax({

        url: "analysis/getItemData/" + val,

        method: "POST",

        data: dataString,

        contentType: false,

        cache: false,

        processData: false,

        success: function(data) {

            console.log(data);

            $('#replaceItemForm').html(data);

            // $('#item_header').html(data['header']);

        }

    });

}



$(document).on('click', '#deleteButton', function(e) {

    // alert($('#fk_b_id').val());

    fk_b_id = $('#fk_b_id').val();

    var item_id = [];

    $.each($("input[name='id']:checked"), function() {

        item_id.push($(this).val());

    });



    item_list = item_id.join(",");

    if (item_list != '') {

        var answer = confirm("Are you sure you want to delete record!");

        ajax.url = window.baseUrl + 'analysis/deleteitem';

        if (answer) {

            $.ajax({

                type: "POST",

                url: ajax.url,

                data: { 'item_id': item_list },

                success: function(data) {

                    if (data == 'success') {

                        // alert(data);

                        msg = "<div class='alert alert-success'><strong>Success!</strong> RFQ Item(s) Deleted Successfully! </div>";

                        $('#validation_errors_delete').html(msg);

                        datastring = { fk_b_id: fk_b_id };

                        table.rfqPopupTable(datastring);

                        // window.location.reload();                

                    }

                },

                error: function() { alert("Error Deleting User."); }

            });

        }

    } else {

        alert('Please select atleast one record to delete !')

    }



});



function printDiv() {

    var printContents = document.getElementById('printdiv').innerHTML;

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

}



function closeSaveFilter() {

    $('#mySaveFilterModal').modal('hide');

    ajax.url = 'analysis/getSavedFilterDropdown';

    dataString = 'rfq=rfq';

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

        url: "analysis/importData/" + rfq_id,

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

            $('#validation_errors_upload_tab').html(newData.message);

            // $('#importExcel').prop('disabled',false);

            // if (newData.code == 200) {

            //     window.location.reload();

            // }

        }

    });

}



function downloadItem(rfq_id) {

    var res = confirm("Do You Want To Export All Items Data Into Excel ?");

    if (res) {

        //var columnFields = $('input#columnFields').val();

        var dataString = 'b_id=' + rfq_id;

        $.ajax({

            method: "POST",

            url: "analysis/createItemExcel",

            data: dataString,

            cache: false,

            success: function(html) {

                //console.log(html);

                var file = html

                // window.location.href = file;

            }

        });

    }

}



function exportTableToExcelAnalysis(rfq_id) {

    //var columnFields = $('input#columnFields').val();

    var dataString = 'fk_b_id=' + rfq_id;

    $.ajax({

        method: "POST",

        url: "analysis/createItemExcelAnalysis",

        data: dataString,

        cache: false,

        success: function(html) {

            //console.log(html);

            // var file = html

            // window.location.href = file;

        }

    });



}



function AddUpdateItem() {

    // var name = document.getElementById("add_photo").files[0].name;

    var form_data = new FormData();

    // var ext = name.split('.').pop().toLowerCase();

    // if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {

    //     $('.excel-upload-response').html('Invalid Excel File');

    //     return false;

    // }

    // if (name == '' || name == 'undefined') {

    //     $('.excel-upload-response').html('Please Select File First.');

    //     return false;

    // }

    var room_type = $("#add_room_type").val();

    var add_id_code = $("#add_id_code").val();

    var add_item_type = $("#add_item_name").val();

    var add_item_name = $("#add_item_type").val();

    var add_width = $("#add_width").val();

    var depth = $("#add_depth").val();

    var height = $("#add_material").val();

    var add_short_height = $("#add_short_height").val();

    var add_technical_description = $("#add_technical_description").val();

    var add_quantity = $("#add_quantity").val();

    var add_fabric_quantity = $("#add_fabric_quantity").val();

    var add_leather_quantity = $("#add_leather_quantity").val();

    var cbm = $("#add_percentage_units").val();

    var note = $("#add_note").val();

    var fk_b_id = $("#fk_b_id").val();

    var bw_id = $("#bw_id").val();



    var rfq_id = $('#fk_b_id').val();

    form_data.append("photo", document.getElementById('add_photo').files[0]);

    form_data.append("room_type", room_type);

    form_data.append("id_code", add_id_code);

    form_data.append("item_type", add_item_type);

    form_data.append("item_name", add_item_name);

    form_data.append("width", add_width);

    form_data.append("depth", depth);

    form_data.append("height", height);

    form_data.append("short_height", add_short_height);

    form_data.append("technical_description", add_technical_description);

    form_data.append("quantity", add_quantity);

    form_data.append("fabric_quantity", add_fabric_quantity);

    form_data.append("leather_quantity", add_leather_quantity);

    form_data.append("cbm", cbm);

    form_data.append("note", note);

    form_data.append("fk_b_id", fk_b_id);

    form_data.append("bw_id", bw_id);

    //console.log(document.getElementById('customFile').files[0]);

    $.ajax({

        url: "analysis/create/worksheet",

        method: "POST",

        data: form_data,

        contentType: false,

        cache: false,

        processData: false,

        // beforeSend: function () {

        //         $('#importExcel').html("Excel Uploading...");

        //         $('#importExcel').prop('disabled',true);

        // },

        success: function(data) {

            console.log(data);

            var newData = JSON.parse(data);

            $('#itemSuccessMessage').html(newData.message);

            $('#itemSuccessMessageUpdate').html(newData.message);

            if (newData.saveNew == 'saveNew') {

                $("#add_room_type").val('');

                $("#add_id_code").val('');

                $("#add_item_type").val('');

                $("#add_item_name").val('');

                $("#add_width").val('');

                $("#depth").val('');

                $("#add_material").val('');

                $("#add_short_height").val('');

                $("#add_technical_description").val('');

                $("#add_quantity").val('');

                $("#add_fabric_quantity").val('');

                $("#add_leather_quantity").val('');

                $("#add_percentage_units").val('');

                $("#add_note").val('');

            }

            // if (newData.code == 200) {

            //     window.location.reload();

            // }

        }

    });

}



function markUpCheck() {

    var radioValue = $("input[name='markuptypeCheck']:checked").val();

    if (radioValue == 'fixed') {

        $(".fixedInbox").css({ visibility: "visible" });

        $("#fixedInputBox_ex_factory").attr("disabled", false);

        $("#fixedInputBox_fabric").attr("disabled", false);

        $("#fixedInputBox_leather").attr("disabled", false);

        $("#markup_type").val(radioValue);

    } else {

        $(".fixedInbox").css({ visibility: "hidden" });

        $("#fixedInputBox_ex_factory").attr("disabled", true);

        $("#fixedInputBox_fabric").attr("disabled", true);

        $("#fixedInputBox_leather").attr("disabled", true);

        $("#markup_type").val(radioValue);

    }

}



function getUnitPriceValue(q, up, mup, total) {

    var unit_price = $("#" + up).val();

    if (mup == 0) {

        var markup = 0;

    } else {

        markup = $("#" + mup).val();

    }

    totalprice = q * unit_price;

    totalmp = (markup / 100) * totalprice;

    finalamt = totalmp + + +totalprice;

    $("#" + total).val(finalamt);

}








function sendPropsal(id) {

    r = confirm("Are you sure?");

    if (r == true) {

        window.location.href = window.baseUrl + 'analysis/sendProposal/' + id;

    }

}

$(document).on('click', '#final_markup_apply', function() {

    if ($(this).prop("checked") == true) {

        var final_markup = $(document).find('#final_markup').val();
        // alert(final_markup);
        $('.markup_price_data').val(final_markup);
        // document.querySelector("form[name='analysis'] > input.markup_price_data").value = final_markup;
        var ary = [];
        $('#bid-analysis tr').each(function(a, b) {
            var rateUSD = $('.rateUSD', b).text();
            var converter = $('.convertionRate', b).text();
            var rateAED = $('.rateAED', b).text();
            var quantity = $('.quantity', b).text();

            amount = rateUSD * converter * quantity;
            markupAmount = (final_markup / 100) * amount;
            totalAmount = amount + markupAmount;
            var totalAmount = $('.totalAmount', b).text(totalAmount);

            ary.push({ totalAmount: totalAmount });

        });

    }

});

function markupCal(markup, rate, exchange, quantity, b_id, el) {
    amount = rate * exchange * quantity;
    markupAmount = (markup / 100) * amount;
    totalAmount = amount + markupAmount;
    $("#total_" + b_id).html(totalAmount);
    // console.log(el);
    $(el).attr("value", markup);
}

function exportTableToExcel(tableID, filename = '') {
    // debugger;
    var downloadLink;

    var dataType = 'application/vnd.ms-excel';

    var tableSelect = document.getElementById(tableID);

    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    console.log(tableHTML);

    filename = filename ? filename + '.xls' : 'excel_data.xls';

    downloadLink = document.createElement("a");
    console.log(downloadLink);

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {

        var blob = new Blob(['\ufeff', tableHTML], {

            type: dataType

        });

        navigator.msSaveOrOpenBlob(blob, filename);

    } else {

        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        console.log(downloadLink.href);

        downloadLink.download = filename;

        downloadLink.click();

    }

}



function rebiding(id) {
    //debugger;
    r = confirm("Are you sure?");

    if (r == true) {

        //console.log(window.baseUrl + 'analysis/bidApply/' + id);
        window.location.href = window.baseUrl + 'analysis/bidApply/' + id;
    }

}