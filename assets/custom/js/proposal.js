$(document).ready(function() {

    table.url = window.baseUrl + 'proposal/get/list/' + window.customeFilter;

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
                    if (row.status == 'Approved') {

                        return '<a href="#" class="edit-proposal" data-url="' + window.baseUrl + 'prop/form/approve/' + row.p_id + '" data-toggle="modal" data-target="#modal" data-id="' + row.p_id + '">' + data + '</a>';

                    } else {

                        return '<a href="#" class="edit-proposal" data-url="' + window.baseUrl + 'prop/form/' + row.p_id + '" data-toggle="modal" data-target="#modal" data-id="' + row.p_id + '">' + data + '</a>';

                    }

                },

                "targets": 1

            }

        ];

    table.createDataTable();

    $(document).on('click', '.edit-proposal', function() {

        thisObj = $(this);

        dataId = thisObj.data('id');

        var url = thisObj.data('url');

        ajax.init();

        ajax.method = 'get';

        ajax.url = url;

        ajax.ajaxCall(ajax.displayFormProposal);

    });



});


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


$(document).on('click', '#approveProposal', function(e) {
    var fk_pid = $("#fk_pid").val();
    check = confirm("Are you sure, you want Approve ?");

    if (check) {
        $("#commentStatus").val('Approved');
        $('#comment-modal').modal('show');
    }

});



$(document).on('click', '#declineProposal', function(e) {
    check = confirm("Are you sure, you want to Decline ?");

    if (check) {
        $("#commentStatus").val('Declined');
        $('#comment-modal').modal('show');
    }

});



$(document).on('click', '#releasePO', function(e) {


    check = confirm("Are you sure, you want to Release PO for this Proposal ?");

    if (check) {

        min = 1000;
        max = 500000;
        min = Math.ceil(min);
        max = Math.floor(max);
        const num = Math.floor(Math.random() * (max - min + 1)) + min;
        po_no = num.toString().padStart(6, "0");
        $("#commentRecordStatus").val('Released PO');
        $("#record_label").text('Purchase Order(PO) No.');
        $("#record_no").val(po_no);
        $('#recordNo-modal').modal('show');

    } else {

        return false;

    }

});



$(document).on('click', '#releaseInvoice', function(e) {

    check = confirm("Are you sure, you want to Release Invoice for this Proposal ?");

    if (check) {

        min = 1000;
        max = 500000;
        min = Math.ceil(min);
        max = Math.floor(max);
        const num = Math.floor(Math.random() * (max - min + 1)) + min;
        invoice_no = num.toString().padStart(6, "0");
        $("#commentRecordStatus").val('Released Invoice');
        $("#record_label").text('Invoice No.');
        $("#record_no").val(invoice_no);
        $('#recordNo-modal').modal('show');

    } else {

        return false;

    }

});

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

        url: window.baseUrl + "Proposal/get/leadOpportunity",

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

    }

    if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }



    $('#quantity_alert').html('');

    $('#unit_cost_alert').html('');

    $("#add_ex_factory_total_markup").attr("readonly", false);

    $('#unit_price_markup1').val(val);

    // $('#add_ex_factory_mark_up_amt').val('');

    // $('#add_ex_factory_total_markup').val('');

    // $('#add_total_price_ex_factory').val('');

});



function getExFactoryTotalMarkup() {

    var unit_cost = $("#add_ex_factory_unit_price").val();

    var unit_cost_ex_markup = $("#add_ex_factory_mark_up_amt").val();

    var unit_cost_markup = $("#add_unit_price_markup").val();

    // alert(unit_cost);

    var quantity = $("#add_quantity").val();

    //alert(quantity);

    var unit_price_markup = $('#unit_price_markup1').val();

    //alert(unit_price_markup);

    if (unit_cost_markup && unit_cost_ex_markup) {

        if (quantity == '') {

            $('#quantity_alert').html('<b>First Add Quantity.</b>');

            $("#add_ex_factory_unit_price_alert").val('');

            $("#add_unit_price_markup").prop('selectedIndex', 0);

            return false;

        } else {

            $('#quantity_alert').html('');

        }



        if (unit_cost == '') {

            $('#quantity_alert').html('');

            $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

            $('#add_unit_price_markup').prop('selectedIndex', 0);

            return false;

        } else {

            $('#add_ex_factory_unit_price_alert').html('');

        }





        if (unit_price_markup == '%') {

            var amt = unit_cost * (unit_cost_ex_markup / 100);

        } else if (unit_price_markup == '$/unit') {

            var amt = quantity * unit_cost_ex_markup;

        } else if (unit_price_markup == 'Total Markup') {

            var amt = quantity * unit_cost + + +unit_cost_ex_markup;

        }



        var total_ex_factory = amt + +quantity * unit_cost;

        var ex_factory_markup = getAmountstructure(amt);

        var total_ex_factory_amt = getAmountstructure(total_ex_factory);

        //var owner_price = ;

        $("#add_ex_factory_total_markup").val(ex_factory_markup);

        $("#add_total_price_ex_factory").val(total_ex_factory_amt);

    }

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

    // $('#add_fabric_mark_up_amt').val('');

    // $('#add_fabrics_total_markup').val('');

    // $('#add_unit_total_price_fabric').val('');

});



function getFabricsTotalMarkup() {

    var unit_cost = $("#add_fabric_price").val();

    //alert(unit_cost);

    var quantity = $("#add_fabric_quantity").val();

    //alert(quantity);

    var unit_price_markup = $('#unit_price_markup2').val();

    var add_fabric_markup = $('#add_fabric_markup').val();

    var fabric_markup_amt = $('#add_fabric_mark_up_amt').val();

    //alert(unit_price_markup);

    if (add_fabric_markup && fabric_markup_amt) {

        if (quantity == '') {

            $('#add_fabric_quantity_alert').html('<b>First Add Quantity.</b>');

            $("#add_fabric_price_alert").val('');

            $("#add_fabric_markup").prop('selectedIndex', 0);

            return false;

        }

        if (unit_cost == '') {

            $('#add_fabric_quantity_alert').html('');

            $('#add_fabric_price_alert').html('<b>Add Unit Cost.</b>');

            $('#add_fabric_markup').prop('selectedIndex', 0);

            return false;

        }

        $('#add_fabric_quantity_alert').html('');

        $('#add_fabric_price_alert').html('');

        if (unit_price_markup == '%') {

            var amt = unit_cost * (fabric_markup_amt / 100);

        } else if (unit_price_markup == '$/unit') {

            var amt = quantity * fabric_markup_amt;

        } else if (unit_price_markup == 'Total Markup') {

            var amt = quantity * unit_cost + + +fabric_markup_amt;

        }

        var total_ex_factory = amt + +quantity * unit_cost;

        var ex_factory_markup = getAmountstructure(amt);

        var total_ex_factory_amt = getAmountstructure(total_ex_factory);

        //var owner_price = ;

        $("#add_fabrics_total_markup").val(ex_factory_markup);

        $("#add_unit_total_price_fabric").val(total_ex_factory_amt);

    }

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

    }

    if (unit_cost == '') {

        $('#add_leather_quantity_alert').html('');

        $('#add_leather_price_alert').html('<b>Add Leather Cost.</b>');

        $('#leather_markup').prop('selectedIndex', 0);

        return false;

    }



    $('#add_leather_quantity_alert').html('');

    $('#add_leather_price_alert').html('');

    $('#unit_price_markup3').val(val);

    // $('#add_leather_mark_up_amt').val('');

    // $('#add_leather_total_markup').val('');

    // $('#add_unit_total_price_leather').val('');

});



function getLeatherTotalMarkup() {

    var unit_cost = $("#add_leather_quantity").val();

    // alert(unit_cost);

    var quantity = $("#add_leather_price").val();

    var leather_markup = $("#leather_markup").val();

    var add_leather_mark_up_amt = $("#add_leather_mark_up_amt").val();

    // alert(quantity);

    var unit_price_markup = $('#unit_price_markup3').val();

    // alert(unit_price_markup);

    if (leather_markup && add_leather_mark_up_amt) {

        if (quantity == '') {

            $('#add_leather_quantity_alert').html('<b>First Add Quantity.</b>');

            $("#add_leather_price_alert").val('');

            $("#leather_markup").prop('selectedIndex', 0);

            return false;

        } else { $('#add_leather_quantity_alert').html(''); }

        if (unit_cost == '') {

            $('#add_leather_quantity_alert').html('');

            $('#add_leather_price_alert').html('<b>Add Unit Cost.</b>');

            $('#leather_markup').prop('selectedIndex', 0);

            return false;

        } else {

            $('#add_leather_price_alert').html('');

        }



        if (unit_price_markup == '%') {

            var amt = unit_cost * (add_leather_mark_up_amt / 100);

        } else if (unit_price_markup == '$/unit') {

            var amt = quantity * add_leather_mark_up_amt;

        } else if (unit_price_markup == 'Total Markup') {

            var amt = quantity * unit_cost + + +add_leather_mark_up_amt;

        }

        var total_ex_factory = amt + +quantity * unit_cost;

        var ex_factory_markup = getAmountstructure(amt);

        var total_ex_factory_amt = getAmountstructure(total_ex_factory);

        //var owner_price = ;

        $("#add_leather_total_markup").val(ex_factory_markup);

        $("#add_unit_total_price_leather").val(total_ex_factory_amt);

    }

}

//----- Leather Markup End-------------------------------



//------Total Price FOB-----------------------

function getFOB(val) {

    var unit_cost = $("#ex_factory_unit_price").val();

    var quantity = $("#add_quantity").val();

    var total_price_ex_factory = $('#add_total_price_ex_factory').val();

    total_price_ex_factory = total_price_ex_factory.replace(",", "");

    if (quantity == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Quantity.</b>');

        $('#add_unit_price_fob_alert').html('<b>Add Quantity in Ex Factory Section.</b>');

        $('#quantity_alert').focus();

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }

    if (unit_cost == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('<b>Add Unit Cost.</b>');

        $('#add_unit_price_fob_alert').html('<b>Add Unit Price in Ex Factory Section.</b>');

        $('#add_ex_factory_unit_price').focus();

        $('#add_unit_price_markup').prop('selectedIndex', 0);

        return false;

    }

    if (total_price_ex_factory == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('');

        $('#add_unit_price_fob_alert').html('<b>Need To Set Total Price Ex Factory.</b>');

        $('#total_price_ex_factory_alert').html('<b>Required to get Total FOB.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

    }

    $('#quantity_alert').html('');

    $('#add_ex_factory_unit_price_alert').html('');

    $('#total_price_ex_factory_alert').html('');

    $('#add_unit_price_fob_alert').html('');



    var fob = (val * quantity) + + +total_price_ex_factory;

    //var owner_price = ;

    fob = getAmountstructure(fob);

    $("#add_total_price_fob").val(fob);

}

//------Total Price FOB End-------------------



//------Total Price CIF-----------------------

function getCIF(val) {

    var unit_cost = $("#ex_factory_unit_price").val();

    var quantity = $("#add_quantity").val();

    var total_price_ex_factory = $('#add_total_price_ex_factory').val();

    total_price_ex_factory = total_price_ex_factory.replace(",", "");



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

    } else if (total_price_ex_factory == '') {

        $('#quantity_alert').html('');

        $('#add_ex_factory_unit_price_alert').html('');

        $('#total_price_ex_factory_alert').html('<b>Required to get Total CIF.</b>');

        $('#add_unit_price_cif_alert').html('<b>Need To Set Total Price Ex Factory.</b>');

        $('#add_unit_price_markup').prop('selectedIndex', 0);

    }

    $('#quantity_alert').html('');

    $('#add_ex_factory_unit_price_alert').html('');

    $('#total_price_ex_factory_alert').html('');

    $('#add_unit_price_cif_alert').html('');

    //alert(val);alert(quantity);

    var CIF = (val * quantity) + + +total_price_ex_factory;

    CIF = getAmountstructure(CIF);

    //var owner_price = ;

    $("#add_total_price_cif").val(CIF);

}

//------Total Price CIF End-------------------





// $(document).on('click', '#addButton', function(e) { 

//     $('#addModal').modal("show");

//     $("#addModal").addClass("show");

//     $('#addModal').show();

// });



// $(document).on('click', '#importButton', function(e) {

//     $('#import_excel_modal').modal("show");

//     $("#import_excel_modal").addClass("show");

//     $('#import_excel_modal').show();

// });



// $(document).on('click touch', function(event) {

//     if (!$(event.target).parents().addBack().is('#trigger')) {

//         $('#addModal').hide();

//     }

// });





// $(document).on('click', '#closeImportButton', function(e) {

//     $('#import_excel_modal').modal("hide");

//     $("#import_excel_modal").removeClass("show");

//     $('#import_excel_modal').hide();

//     var fk_pid = $("#fk_pid").val();

//     datastring = {fk_pid : fk_pid};

//     table.proposalPopupTable(datastring);



// });



$(document).on('click', '#closeItemButton', function(e) {

    $('#addModal').modal("hide");

    $("#addModal").removeClass("show");

    $('#addModal').hide();

    var fk_pid = $("#fk_pid").val();

    //datastring = {fk_pid : fk_pid};

    //table.proposalPopupTable(datastring);

    location.reload();

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







$(document).on('click', '#saveMyFilter', function(e) {

    e.preventDefault();

    var filter_name = $("#filter_name").val();

    var status = $("#status").val();

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

            url: window.baseUrl + "proposal/filter/add",

            data: dataString,

            cache: false,

            success: function(html) {

                var newData = JSON.parse(data);

                //if (newData.code == '200') {

                $('#validation_errors_proposal').html(newData.message);

                //window.location.reload();

                //} else {

                //     $('#validation_errors_proposal').html(newData.message);

                // }

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

        url: window.baseUrl + "proposal/createGrid",

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

            url: window.baseUrl + "proposal/filter/get",

            data: dataString,

            cache: false,

            success: function(html) {

                $('#replaceFilter').html(html);

            }

        });

    });

});



//---- To Import Excel Data-----------------------

// $(document).ready(function () {

//     $('#excelUpload').on('submit',function(e){

//         e.preventDefault();

//         var name = document.getElementById("customFile").files[0].name;

//         var form_data = new FormData();

//         var ext = name.split('.').pop().toLowerCase();

//         if (jQuery.inArray(ext, ['xls', 'xlsx', 'csv']) == -1) {

//             $('.excel-upload-response').html('Invalid Excel File');

//             return false;

//         }

//         if (name == '' || name == 'undefined') {

//             $('.excel-upload-response').html('Please Select File First.');

//             return false;

//         }

//         form_data.append("file", document.getElementById('customFile').files[0]);

//         $.ajax({

//             url: "proposal/importData",

//             method: "POST",

//             data: form_data,

//             contentType: false,

//             cache: false,

//             processData: false,

//             beforeSend: function () {

//                 $('#importExcel').html("Excel Uploading...");

//             },

//             success: function (data) {

//                 window.location.reload(); 

//                 var newData = JSON.parse(data);

//                 $('#importExcel').html("Upload");

//                 if (newData.code == 200) {

//                    $('.#importMsg').html(newData.message);

//                      window.location.reload(); 

//                 } else {

//                    $('.#importMsg').html(newData.message); 

//                 }

//             }

//         });

//     });

// });



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

                var dataString = 'proposal=' + window.moduleType + '&proposal_id=' + rest;

                $.ajax({

                    method: "POST",

                    url: "proposal/createExcel",

                    data: dataString,

                    cache: false,

                    success: function(html) {

                        //console.log(html);

                        var file = html

                        window.location.href = file;

                    }

                });

            }

        } else {

            alert("Please select atleast 1 record !");

        }

    });

});





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

        $("#checkedAction").prop("disabled", false);

        $('.checked_action').addClass('activeData');

    } else {

        $('.checked_action').removeClass('activeData');

        $("#checkedAction").prop("disabled", true);

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

        $('.checked_action').removeClass('activeData');

        $("#checkedAction").prop("disabled", true);

    }

    $('#sendEmail').val(ChackedValuesEmail);

    $('#deleteRows').val(ChackedValuesDelete);



});



// $(document).ready(function() {

//     $("#txtEditor").Editor();

// });



$(document).on('change', '#checkedAction', function(e) {

    var deactivateids = this.value;

    var arr = deactivateids.split(",");

    var fst = arr.splice(0, 1).join("");

    var rest = arr.join(",");

    if (fst == "delete") {

        var toBeDelete = 'deleteThis=' + rest;

        var answer = confirm("Are you sure you want to delete record!");

        ajax.url = window.baseUrl + 'proposal/deleteproposal';

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

        ajax.url = window.baseUrl + 'proposal/getEmailIds';



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

    dataString = 'pw_id=' + val;

    //console.log(dataString)

    $.ajax({

        url: "proposal/getItemData/" + val,

        method: "POST",

        data: dataString,

        contentType: false,

        cache: false,

        processData: false,

        success: function(data) {

            $('#replaceItemForm').html(data);

        }

    });

}



function printDiv() {

    var printContents = document.getElementById('printdiv').innerHTML;

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

}



$(document).on('change', '#lead_opportunity_id', function(e) {

    var val = $('#lead_opportunity_id option:selected').val();

    var dataString = 'lead_opportunity_id=' + val;



    $.ajax({

        type: "POST",

        url: window.baseUrl + "proposal/get/company",

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



function closeSaveFilter() {

    $('#mySaveFilterModal').modal('hide');

    ajax.url = 'proposal/getSavedFilterDropdown';

    dataString = 'proposal=proposal';

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



function AddUpdateItem() {



    var form_data = new FormData();



    var room_type = $("#add_room_type").val();

    var add_id_code = $("#add_id_code").val();

    var add_item_type = $("#add_item_type").val();

    var add_item_name = $("#add_item_name_test").val();

    var add_width = $("#add_width").val();

    var depth = $("#add_depth").val();

    var height = $("#add_material").val();

    var add_short_height = $("#add_short_height").val();

    var add_technical_description = $("#add_technical_description").val();

    var add_quantity = $("#add_quantity").val();

    var add_ex_factory_unit_price = $("#add_ex_factory_unit_price").val();

    var unit_price_markup1 = $("#unit_price_markup1").val();

    var add_ex_factory_mark_up_amt = $("#add_ex_factory_mark_up_amt").val();

    var add_ex_factory_total_markup = $("#add_ex_factory_total_markup").val();

    var add_total_price_ex_factory = $("#add_total_price_ex_factory").val();

    var add_fabric_quantity = $("#add_fabric_quantity").val();

    var add_fabric_price = $("#add_fabric_price").val();

    var unit_price_markup2 = $("#unit_price_markup2").val();

    var add_fabric_mark_up_amt = $("#add_fabric_mark_up_amt").val();

    var add_fabrics_total_markup = $("#add_fabrics_total_markup").val();

    var add_unit_total_price_fabric = $("#add_unit_total_price_fabric").val();

    var add_leather_quantity = $("#add_leather_quantity").val();

    var add_leather_price = $("#add_leather_price").val();

    var unit_price_markup3 = $("#unit_price_markup3").val();

    var add_leather_mark_up_amt = $("#add_leather_mark_up_amt").val();

    var add_leather_total_markup = $("#add_leather_total_markup").val();

    var add_unit_total_price_leather = $("#add_unit_total_price_leather").val();

    var add_unit_price_fob = $("#add_unit_price_fob").val();

    var add_unit_price_cif = $("#add_unit_price_cif").val();

    var add_total_price_fob = $("#add_total_price_fob").val();

    var total_price_cif = $("#total_price_cif").val();

    var cbm = $("#add_percentage_units").val();

    var note = $("#add_note").val();

    var fk_pid = $("#fk_pid").val();

    var pw_id = $("#pw_id").val();



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

    form_data.append("ex_factory_unit_price", add_ex_factory_unit_price);

    form_data.append("unit_price_markup", unit_price_markup1);

    form_data.append("ex_factory_mark_up_amt", add_ex_factory_mark_up_amt);

    form_data.append("ex_factory_total_markup", add_ex_factory_total_markup);

    form_data.append("total_price_ex_factory", add_total_price_ex_factory);

    form_data.append("fabric_quantity", add_fabric_quantity);

    form_data.append("fabric_price", add_fabric_price);

    form_data.append("fabric_markup", unit_price_markup2);

    form_data.append("fabric_mark_up_amt", add_fabric_mark_up_amt);

    form_data.append("fabrics_total_markup", add_fabrics_total_markup);

    form_data.append("unit_total_price_fabric", add_unit_total_price_fabric);

    form_data.append("leather_quantity", add_leather_quantity);

    form_data.append("leather_price", add_leather_price);

    form_data.append("leather_markup", unit_price_markup3);

    form_data.append("leather_mark_up_amt", add_leather_mark_up_amt);

    form_data.append("leather_total_markup", add_leather_total_markup);

    form_data.append("unit_total_price_leather", add_unit_total_price_leather);

    form_data.append("unit_price_fob", add_unit_price_fob);

    form_data.append("unit_price_cif", add_unit_price_cif);

    form_data.append("total_price_fob", add_total_price_fob);

    form_data.append("total_price_cif", total_price_cif);

    form_data.append("cbm", cbm);

    form_data.append("note", note);

    form_data.append("fk_pid", fk_pid);

    form_data.append("pw_id", pw_id);



    //console.log(document.getElementById('customFile').files[0]);

    $.ajax({

        url: "proposal/addWorksheet",

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

                $("#add_ex_factory_unit_price").val('');

                $("#add_unit_price_markup").val('');

                $("#add_ex_factory_mark_up_amt").val('');

                $("#add_ex_factory_total_markup").val('');

                $("#add_total_price_ex_factory").val('');



                $("#add_fabric_quantity").val('');

                $("#add_fabric_price").val('');

                $("#add_fabric_markup").val('');

                $("#add_fabric_mark_up_amt").val('');

                $("#add_fabrics_total_markup").val('');

                $("#add_unit_total_price_fabric").val('');



                $("#add_leather_quantity").val('');

                $("#add_leather_price").val('');

                $("#leather_markup").val('');

                $("#add_leather_mark_up_amt").val('');

                $("#add_leather_total_markup").val('');

                $("#add_unit_total_price_leather").val('');



                $("#unit_price_fob").val('');

                $("#unit_price_cif").val('');

                $("#total_price_fob").val('');

                $("#total_price_cif").val('');



                $("#add_percentage_units").val('');

                $("#add_note").val('');

            }

            // if (newData.code == 200) {

            //     window.location.reload();

            // }

        }

    });

}





// Function to get input value.

function get_preview(b_id) {

    var fk_pid = $('#fk_pid').val();

    var dataString = 'p_id=' + fk_pid;

    $.ajax({

        url: "proposal/get_preview/" + fk_pid,

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

function get_remark(b_id) {

    var fk_pid = $('#fk_pid').val();

    // var dataString = 'p_id=' + fk_pid;
    datastring = 'fk_pid=' + fk_pid + '&status=Approved';
    $.ajax({
        type: "POST",
        url: window.baseUrl + "proposal/getComment/",
        data: datastring,
        dataType: "html",
        success: function(data) {
            var response = JSON.parse(data);
            // console.log(response);
            $("#m_portlet_base_demo_17_tab_content").html(response.html);
            // window.location.reload();
        },
        error: function() { alert("Error posting feed."); }
    });
    // $.ajax({

    //     url: "proposal/get_remark/" + fk_pid,

    //     method: "POST",

    //     data: dataString,

    //     contentType: false,

    //     cache: false,

    //     processData: false,

    //     success: function(data) {

    //         $('#printdiv').html(data);

    //     }

    // });

};



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

    var proposal_id = $('#fk_pid').val();

    form_data.append("uploadFile", document.getElementById('customFile').files[0]);

    //form_data.append("rfq_id", document.getElementById('rfq_id').value());

    //console.log(document.getElementById('customFile').files[0]);

    $.ajax({

        url: "proposal/importData/" + proposal_id,

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

            document.getElementById('customFile').files[0].reset();

            $('#importExcel').prop('disabled', false);

            // if (newData.code == 200) {

            //     window.location.reload();

            // }

        }

    });

}