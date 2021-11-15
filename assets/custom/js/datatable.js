var table = {

    tableClass: 'datatable',

    selector: '#',

    method: 'post',

    data: [],

    dataType: 'json',

    url: '',

    processing: true,

    serverSide: true,

    ordering: 'isSorted',

    footer: true,

    searching: false,

    lengthChange: true,

    lengthMenu: [
        [10, 50, 100, 100000],
        [10, 50, 100, "All"]
    ],

    datatable: null,

    columns: [],

    columnDefs: [],

    order: [],

    fixedColumns: null,

    footerCallback: null,

    // fixedColumns: {

    //            leftColumns: 3,

    //            rightColumns: right

    //        },

    scrollX: true,

    scrollCollapse: true,

    dom: "Bfrtip",

    init: function(param = null) {

    },

    createDataTable: function() {

        var selector = table.selector + table.tableClass;

        table.datatable = $(selector).dataTable({

            "columnDefs": table.columnDefs,

            "footerCallback": table.footerCallback,

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "footer": table.footer,

            "order": table.order,

            "columns": table.columns,

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "ajax": table.url,

            "fixedColumns": table.fixedColumns,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            //"dom": this.dom,

        });

    },

    destroyDataTable: function() {

        table.datatable.fnDestroy();

    },

    updateDataTable: function() {

        table.destroyDataTable();

        table.createDataTable();

    },

    updateColumn: function(updatedColumns) {

        for (i = 0; i < updatedColumns.length; i++) {

            table.columns[updatedColumns[i]].visible = false;

        }

    },

    addFreezColumn(left = 0, right = 0) {

        table.fixedColumns = {

            leftColumns: left,

            rightColumns: right

        }

    },

    proposalPopupTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#itemTable').dataTable({

            // "columnDefs": [

            //     {

            //         render: function(data, type, row) {

            //             return '<a href="#" id="addButton" data-url="' + window.baseUrl + 'prop/form/' + row.fk_pid + '/' + row.pw_id + '" data-toggle="modal" data-target="#addmodal" data-id="' + row.pw_id + '" onclick="getItemList(' + row.pw_id + ')">' + data + '</a>';

            //         },

            //         targets: 0,

            //     },

            // ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "footer": table.footer,

            "order": table.order,

            "columns": [

                // {data:'pw_id',title: 'Sr No.'},

                { data: 'item_name', title: 'Item' },

                { data: 'id_code', title: 'Item Code' },

                { data: 'item_type', title: 'Item Type' },

                { data: 'quantity', title: 'Quantity' },
                { data: 'markup', title: 'Markup in %' },
                { data: 'rate_USD', title: 'Rate in USD' },
                { data: 'exchange_rate', title: 'Exchange Rate' },
                { data: 'rate_AED', title: 'Rate in AED' },
                { data: 'total_amount', title: 'Total Amount' },
                { data: 'supplier_id', title: 'Supplier' },

                // { data: 'ex_factory_unit_price', title: 'Ex Factory Price' },

                // { data: 'ex_factory_mark_up_amt', title: 'Mark Up Amount (Ex Factory)' },

                // { data: 'ex_factory_total_markup', title: 'Total Markup (Ex Factory)' },

                // { data: 'total_price_ex_factory', title: 'Unit Total Price (Ex Factory)' },

                // { data: 'fabric_quantity', title: 'Fabric Quantity' },

                // { data: 'fabric_price', title: 'Fabric Price' },

                // { data: 'fabric_mark_up_amt', title: 'Mark Up Amount (Fabric)' },

                // { data: 'fabrics_total_markup', title: 'Total Markup (Fabric)' },

                // { data: 'unit_total_price_fabric', title: 'Unit Total Price (Fabric)' },

                // { data: 'leather_quantity', title: 'Leather Quantity' },

                // { data: 'leather_price', title: 'Leather Price' },

                // { data: 'leather_mark_up_amt', title: 'Mark Up Amount (Leather)' },

                // { data: 'leather_total_markup', title: 'Total Markup (Leather)' },

                // { data: 'unit_total_price_leather', title: 'Unit Total Price (Leather)' },

                { data: 'unit_price_fob', title: 'Unit Price FOB' },

                { data: 'unit_price_cif', title: 'Unit Price CIF' },

                { data: 'total_price_fob', title: 'Total Price FOB' },

                { data: 'total_price_cif', title: 'Total Price CIF' }

            ],

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "ajax": {

                url: window.baseUrl + "Proposal/table/getItemList",

                data: data,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //   	"scrollX": table.scrollX,

            //   	"scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    },

    leadproposalPopupTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#proposalTable').dataTable({

            "columnDefs": [

                {

                    render: function(data, type, row) {

                        return '<a href="#" onclick="getItems(' + row.p_id + ')">' + row.status + '</a>';

                    },

                    targets: 0,

                },

            ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "footer": table.footer,

            "order": table.order,

            "columns": [

                // {data:'pw_id',title: 'Sr No.'},

                { data: 'status', title: 'Proposal Status' },

                { data: 'title', title: 'Opportunity Title' },

                { data: 'sales_people', title: 'Customer Contact' },

                { data: 'approval_deadline', title: 'Approval Deadline' },

                { data: 'total_price_ex_factory', title: 'Total Price(Ex Factory)' },

                { data: 'total_price_fabric', title: 'Total Price(Fabric)' },

                { data: 'total_price_leather', title: 'Total Price(Leather)' },

                { data: 'total_fob', title: 'Total Price(FOB)' },

                { data: 'total_cif', title: 'Total Price(CIF)' }

            ],

            "searching": table.searching,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "ajax": {

                url: window.baseUrl + "proposal/table/getProposal",

                data: data.lead_opportunity_id,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //    "scrollX": table.scrollX,

            //    "scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    },

    rfqPopupTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#itemTable').dataTable({

            "columnDefs": [

                {

                    "render": function(data, type, row) {

                        return '<input name="id" value="' + row.bw_id + '" id="itemselect" class="itemcheckBoxClass" type="checkbox">';

                    },

                    "targets": 0,

                    "orderable": false

                }, {

                    render: function(data, type, row) {

                        return '<a href="#" id="addButton" data-url="' + window.baseUrl + 'rf/form/' + row.fk_b_id + '/' + row.bw_id + '" +data-toggle="modal" data-target="#addmodal" data-id="' + row.bw_id + '" onclick="getItemList(' + row.bw_id + ')">' + data + '</a><input type="hidden" value="' + row.bw_id + '" id="item_id">';

                    },

                    "targets": 1,

                }, {

                    render: function(data, type, row) {

                        // console.log(row);

                        // return '<img name="item_img" style="width:40px;" src="'+window.baseUrl+'upload/addItemImages/'+row.photo+'">';

                        if (row.photo) {

                            return '<div class="zoom"><img height="80" width="80" id="1" data-toggle="modal" name="item_img" data-target="#myModal" src="' + window.baseUrl + 'upload/addItemImages/' + row.photo + '" /></div>';

                        } else

                        {

                            return "N/A";

                        }

                    },

                    "targets": 4,

                },

            ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "footer": table.footer,

            "order": table.order,



            "columns": [

                { data: 'bw_id', title: '<input name="select_all" type="checkbox" id="itemckbCheckAll">' },

                { data: 'item_name', title: 'Item' },

                { data: 'id_code', title: 'Item Code' },

                { data: 'item_type', title: 'Item Type' },

                { data: 'photo', title: 'Photo' },

                { data: 'width', title: 'Width(meter)' },

                { data: 'depth', title: 'Depth(meter)' },

                { data: 'height', title: 'Height(meter)' },

                { data: 'short_height', title: 'Short Height' },

                { data: 'technical_description', title: 'Technical Description' },

                { data: 'quantity', title: 'Quantity' },

                { data: 'fabric_quantity', title: 'Fabric Quantity (meter)' },

                { data: 'leather_quantity', title: 'Leather Quantity (meter)' },

                { data: 'cbm', title: 'CBM' },

                { data: 'note', title: 'Note' }

            ],

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "ajax": {

                url: window.baseUrl + "rfq/table/getItemList",

                data: data,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //   	"scrollX": table.scrollX,

            //   	"scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    },

    activityPopupTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#activityTable').dataTable({

            "columnDefs": [

                {

                    "render": function(data, type, row) {

                        return '<input name="id" value="' + row.lead_activity_id + '" id="activityselect" class="activitycheckBoxClass" type="checkbox">';

                    },

                    "targets": 0,

                    "orderable": false

                },

            ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "footer": table.footer,

            "order": table.order,



            "columns": [

                { data: 'lead_activity_id', title: '<input name="select_all" type="checkbox" id="activityckbCheckAll">' },

                { data: 'status', title: 'Status' },

                { data: 'activity_type', title: 'Type' },

                { data: 'opportunity_title', title: 'Opportunity Title' },

                { data: 'fullName', title: 'Assigned User' },

                { data: 'activity_date', title: 'Activity Date' },

                { data: 'description', title: 'Activity Notes' },

                { data: 'email', title: 'Email' },

                { data: 'phone', title: 'Phone' }

            ],

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "ajax": {

                url: window.baseUrl + "activity/table/getActivities",

                data: data,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //    "scrollX": table.scrollX,

            //    "scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    },

    activityFilesTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#activityFilesTable').dataTable({

            "columnDefs": [

                //     {

                //     "render": function ( data, type, row ) {

                //         return '<input name="id" value="'+row.lam_id+'" id="activityselect" class="activitycheckBoxClass" type="checkbox">';

                //     },

                //     "targets": 0,

                //     "orderable": false

                // },

            ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "footer": table.footer,

            "order": table.order,



            "columns": [

                // {data:'lam_id',title: '<input name="select_all" type="checkbox" id="activityckbCheckAll">'},

                { data: 'activity_type', title: 'Type' },

                { data: 'to_id', title: 'Sent To' },

                { data: 'sent_from', title: 'Sent From' },

                { data: 'sub', title: 'Subject' },

                { data: 'msg', title: 'Message' },

                { data: 'attachment', title: 'Attachment' },

                { data: 'created_on', title: 'Sent Date' }

            ],

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "ajax": {

                url: window.baseUrl + "activity/get/files",

                data: data.lead_opportunity_id,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //    "scrollX": table.scrollX,

            //    "scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    },

    rfqUpload: function(url) {



        editor = new $.fn.dataTable.Editor({

            ajax: "../php/staff.php",

            table: ".self-edit-form",

            fields: [{

                    label: "Name:",

                    name: "name"

                }, {

                    label: "Address:",

                    name: "address"

                }

            ]

        });



        $('.self-edit-form').on('click', 'tbody td:not(:first-child)', function(e) {

            editor.inline(this);

        });





        $('.self-edit-form').dataTable({

            // "columnDefs" : table.columnDefs,

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "footer": table.footer,

            "order": table.order,

            "columns": [

                { data: 'name', title: 'name' },

                { data: 'address', title: 'address' },

            ],

            "searching": table.searching,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "ajax": url,

            // "fixedColumns": table.fixedColumns,

            // "scrollX": table.scrollX,

            // "scrollCollapse" : table.scrollCollapse,

            //"dom": this.dom,

            dom: "Bfrtip",

        });

    },

    usersJobTable(data) {

        if (table.propDataTable !== undefined) {

            table.propDataTable.fnDestroy();

        }

        table.propDataTable = $(document).find('#jobTable').dataTable({

            "columnDefs": [

                {

                    "render": function(data, type, row) {

                        return '<input name="id" value="' + data + '" class="checkBoxClass" type="checkbox">';

                    },

                    "targets": 0,

                    "orderable": false

                },

            ],

            "processing": table.processing,

            "serverSide": table.serverSide,

            "ordering": table.ordering,

            "footer": table.footer,

            "order": table.order,

            "columns": [

                // {data:'pw_id',title: 'Sr No.'},

                { data: 'id', title: '<input name="select_all" type="checkbox" id="ckbCheckAll">' },

                { data: 'status', title: 'Status' },

                { data: 'project_name', title: 'Project Name' },

                { data: 'type', title: 'Type' },

                { data: 'created_by', title: 'Created By' },

                { data: 'created_at', title: 'Created At' }

            ],

            "searching": table.searching,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "lengthChange": table.lengthChange,

            "lengthMenu": table.lengthMenu,

            "scrollX": table.scrollX,

            "scrollCollapse": table.scrollCollapse,

            "ajax": {

                url: window.baseUrl + "job/get/jobs",

                data: data.user_id,

                type: "POST"

            }

            // "fixedColumns": table.fixedColumns,

            //    "scrollX": table.scrollX,

            //    "scrollCollapse" : table.scrollCollapse,

            // "dom": this.dom,

        });

    }

}
