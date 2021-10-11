<!DOCTYPE html>
<html lang="en" >
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="description" content="User profile example page">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!--begin::Global Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/demo/default/base/style-2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/demo/default/media/img/logo/SpecXReef_Logo.ico" />
    <style type="text/css">
    div.dataTables_wrapper {
        margin: 0 auto;
    }
    </style>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Bar Chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/charts/barchart/style.css">
    <!-- Pie Chart -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/charts/piechart/style.css"> -->
    <style type="text/css">
    .graph-wrapper {
        width: 100%;
        max-width: 750px;
        margin: 0 auto;
    }
    </style>
    <script src="<?php echo base_url();?>assets/push_notification/notification.js"></script>
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        <?php echo $this->page->getPage('layout/header'); ?>
        <!-- END: Header -->
        <div class="m-subheader displaynone" style="padding-top: 80px !important;background-color: #ffff;">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <!-- <a class="m-subheader_title m-subheader_title--separator" href="#"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" style="width: 300px; height: 75px;" class="img-responsive"></a>           -->
                </div>
            </div>
        </div>

        <!-- begin::Body -->

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body" style="padding-top: 0px !important;">
            <!-- BEGIN: Left Aside -->
            <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="m-content" style="background-color: #ffff;height: 123%;">
                    <div class="row" style="height: 39% !important;">
                        <div class="col-xl-5 col-lg-5" style="padding-right: 0;overflow-x: scroll;">
                            <div class="graph" style="width: 580px !important;">
                                <div class="title" style="font-size: 21px !important;"><b>Leads Created / Client Created</b>
                                    <select name="lead_created" id="lead_created" class="form-control m-input pages_titleType" style="margin-top: 11px;height: 30px !important" onchange="getLeadCount(this.value)">
                                        <option value="all">All</option>
                                        <option value="today" <?php if (isset($leadCount_parameter) && $leadCount_parameter == 'today') {echo 'selected';}?>>Today</option>
                                        <option value="yesterday" <?php if (isset($leadCount_parameter) && $leadCount_parameter == 'yesterday') {echo 'selected';}?>>Yesterday</option>
                                        <option value="this_week" <?php if (isset($leadCount_parameter) && $leadCount_parameter == 'this_week') {echo 'selected';}?>>This Week</option>
                                        <option value="this_month" <?php if (isset($leadCount_parameter) && $leadCount_parameter == 'this_month') {echo 'selected';}?>>This Month</option>
                                    </select>
                                    <input type="hidden" name="lead_created_value" id="lead_created_value" value="<?php echo isset($leadCount_parameter)?$leadCount_parameter:'all'; ?>">
                                </div>
                                <?php
                                foreach ($leadCount as $leadCountkey => $leadCountValue) {
                                    $hght = ($leadCountValue['lead_count']/1000)*100;
                                    ?>
                                    <div class="bar" style="height:<?php echo $hght*2;?>px;">
                                        <div class="val_label"><?php echo $leadCountValue['lead_count'];?></div>
                                    </div>
                                <?php } ?>
                                <div class="vlabels_container">
                                    <div class="vlabel">0</div>
                                    <div class="vlabel">200</div>
                                    <div class="vlabel">400</div>
                                    <div class="vlabel">600</div>
                                    <div class="vlabel">800</div>
                                    <div class="vlabel">1000</div>
                                </div>
                                <?php
                                foreach ($leadCount as $leadCountkey => $leadCountValue) { ?>
                                    <div class="hlabel"><a href="#" onclick="getLeadOpportunities(<?php echo $leadCountValue['user_id'];?>)"><?php echo $leadCountValue['full_name'];?></a></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class='graph-wrapper'>
                                <span style="padding-left: 234px;"><b style="font-size: 20px;">Lead Created Vs Lead Completed</b> <select name="lead_created" id="lead_created" style="margin-left: 20px;height: 30px !important" onchange="getLeadCompletedCount(this.value)">
                                    <?php $current_yr=date("Y");
                                    for($yr=$current_yr; $yr>=$current_yr-10; $yr--){ ?>
                                        <option value="<?php echo $yr; ?>" <?php if (isset($comparison_parameter) && $comparison_parameter == $yr) {echo 'selected';}?>><?php echo $yr; ?></option>
                                    <?php } ?>
                                </select></span>
                                <div class='graph' id='pushups' style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <!------------ First Row Ends ---------------->
                    <div class="row pad-top-25 m-r-0" style="<?php if (isset($noData)) { ?>margin-top: 65px;<?php }?>">
                        <div class="col-xl-5 col-lg-5" style="padding-right: 0;">

                            <div style="font-size: 21px;text-align: center;margin-bottom: 12px;">Activity Performed</div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-6 col-md-6 col-sm-12">

                                    <select id="conatctTypeUsr" name="lead_time" id="lead_time" class="form-control m-input pages_titleType" style="height: 30px !important" onchange="activity_performed_time(this.value)">

                                        <option value="all">All Time</option>

                                        <option value="today" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'today') {echo 'selected';}?>>Today</option>

                                        <option value="yesterday" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'yesterday') {echo 'selected';}?>>Yesterday</option>

                                        <option value="this_week" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'this_week') {echo 'selected';}?>>This Week</option>

                                        <option value="this_month" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'this_month') {echo 'selected';}?>>This Month</option>

                                    </select>

                                    <input type="hidden" id="lead_time_value" value="<?php echo isset($activityUser_parameter)?$activityUser_parameter:'all'; ?>">

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">

                                    <select id="conatctTypeUsr" name="lead_by" id="lead_by" class="form-control m-input pages_titleType" style="height: 30px !important" onchange="activity_performed_by(this.value)">

                                        <option value="all">All User</option>

                                        <?php

                                        foreach ($salesPerson as $salesPersonkey => $salesPersonvalue) { ?>

                                            <option value="<?php echo $salesPersonvalue['sales_people_id']?>" <?php if (isset($activityUser_parameter) && $activityUser_parameter == $salesPersonvalue['sales_people_id']) {echo 'selected';}?>><?php echo $salesPersonvalue['full_name']?></option>

                                        <?php    }

                                        ?>

                                    </select>

                                    <input type="hidden" id="lead_by_value" value="<?php echo isset($activityUser_parameter)?$activityUser_parameter:'all'; ?>">

                                </div>

                            </div>

                            <?php

                            if (isset($noData)) {

                                echo $noData;

                            } else {

                                ?>

                                <div id="piechart"></div>

                            <?php }?>

                        </div>

                        <!-- <div class="col-xl-8 col-lg-8" style="padding-left: 170px;">

                        <div class="graph" style="width: 79% !important;">

                        <div class="title" style="font-size: 21px !important;">Clients Created

                        <select name="client_created" id="client_created" class="form-control m-input pages_titleType" style="height: 30px !important" onchange="getClientCount(this.value)">

                        <option value="all">All</option>

                        <option value="today" <?php if (isset($clientCount_parameter) && $clientCount_parameter == 'today') {echo 'selected';}?>>Today</option>

                        <option value="yesterday" <?php if (isset($clientCount_parameter) && $clientCount_parameter == 'yesterday') {echo 'selected';}?>>Yesterday</option>

                        <option value="this_week" <?php if (isset($clientCount_parameter) && $clientCount_parameter == 'this_week') {echo 'selected';}?>>This Week</option>

                        <option value="this_month" <?php if (isset($clientCount_parameter) && $clientCount_parameter == 'this_month') {echo 'selected';}?>>This Month</option>

                    </select>

                    <input type="hidden" name="client_created_value" id="client_created_value" value="<?php echo isset($clientCount_parameter)?$clientCount_parameter:'all'; ?>">

                </div>

                <?php

                foreach ($clientCount as $leadCountkey => $leadCountValue) {

                $hght = ($leadCountValue['client_count']/2500)*100;

                ?>

                <div class="bar" style="height:<?php echo $hght*2;?>px;">

                <div class="val_label"><?php echo $leadCountValue['client_count'];?></div>

            </div>

        <?php }?>

        <div class="vlabels_container">

        <div class="vlabel">0</div>

        <div class="vlabel">500</div>

        <div class="vlabel">1000</div>

        <div class="vlabel">1500</div>

        <div class="vlabel">2000</div>

        <div class="vlabel">2500</div>

    </div>

    <?php

    foreach ($clientCount as $leadCountkey => $leadCountValue) { ?>



    <div class="hlabel"><a href="#" onclick="getClientData(<?php echo $leadCountValue['user_id'];?>)"><?php echo $leadCountValue['full_name'];?></a></div>

<?php }?>



</div>

</div> -->
<div class="col-xl-7 col-lg-7" style="padding-right: 0;">

    <div style="font-size: 21px;text-align: center;margin-bottom: 12px;">Activities By Status</div>

    <div class="form-group m-form__group row m--margin-top-20 padtop3">

        <!-- <div class="col-lg-6 col-md-6 col-sm-12">

        <select id="conatctTypeUsr" name="lead_time" id="lead_time" class="form-control m-input pages_titleType" style="height: 30px !important" onchange="activity_performed_time(this.value)">

        <option value="all">All Time</option>

        <option value="today" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'today') {echo 'selected';}?>>Today</option>

        <option value="yesterday" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'yesterday') {echo 'selected';}?>>Yesterday</option>

        <option value="this_week" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'this_week') {echo 'selected';}?>>This Week</option>

        <option value="this_month" <?php if (isset($activityCount_parameter) && $activityCount_parameter == 'this_month') {echo 'selected';}?>>This Month</option>

    </select>

    <input type="hidden" id="lead_time_value" value="<?php echo isset($activityUser_parameter)?$activityUser_parameter:'all'; ?>">

</div> -->

<div class="col-lg-12 col-md-12 col-sm-12">

    <select id="conatctTypeUsr" name="activity_status" id="activity_status" class="form-control m-input pages_titleType" style="height: 30px !important" onchange="activity_status_by(this.value)">

        <option value="all">All User</option>

        <?php

        foreach ($salesPerson as $salesPersonkey => $salesPersonvalue) { ?>

            <option value="<?php echo $salesPersonvalue['sales_people_id']?>" <?php if (isset($activityStatusUser_parameter) && $activityStatusUser_parameter == $salesPersonvalue['sales_people_id']) {echo 'selected';}?>><?php echo $salesPersonvalue['full_name']?></option>

        <?php    }

        ?>

    </select>

    <input type="hidden" id="activity_status_value" value="<?php echo isset($activityStatusUser_parameter)?$activityStatusUser_parameter:'all'; ?>">

</div>

</div>

<?php

if (isset($activity_status_Data)) {

    echo $activity_status_Data;

} else {

    ?>

    <div id="piechart2"></div>

<?php }?>

</div>

</div>





<div class="row">



</div>

</div>

</div>

</div>

</div>

<!-- end:: Body -->

</div>

<!-- end:: Page -->

<!-- begin::Quick Sidebar -->

<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->

<div id="m_scroll_top" class="m-scroll-top">

    <i class="la la-arrow-up"></i>

</div>

<!-- end::Scroll Top -->            <!-- begin::Quick Nav -->

<!-- begin::Quick Nav -->

<!--begin::Global Theme Bundle -->

<script src="<?php echo base_url(); ?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/demo/default/custom/components/portlets/tools.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>media/js/jquery.dataTables.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/ion-range-slider.js" type="text/javascript"></script> -->

<!-- <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script> -->

<!-- <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script> -->

<script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/form-repeater.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/location_path.js"></script>





<script type="text/javascript">

function updateDataTableSelectAllCtrl(table){

    var $table             = table.table().node();

    var $chkbox_all        = $('tbody input[type="checkbox"]', $table);

    var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);

    var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);



    // If none of the checkboxes are checked

    if($chkbox_checked.length === 0){

        chkbox_select_all.checked = false;

        if('indeterminate' in chkbox_select_all){

            chkbox_select_all.indeterminate = false;

        }



        // If all of the checkboxes are checked

    } else if ($chkbox_checked.length === $chkbox_all.length){

        chkbox_select_all.checked = true;

        if('indeterminate' in chkbox_select_all){

            chkbox_select_all.indeterminate = false;

        }



        // If some of the checkboxes are checked

    } else {

        chkbox_select_all.checked = true;

        if('indeterminate' in chkbox_select_all){

            chkbox_select_all.indeterminate = true;

        }

    }

}



$(document).ready(function (){

    // Array holding selected row IDs

    var rows_selected = [];

    var table = $('.example').DataTable({

        'scrollX':true,

        'responsive':true,

        "dom": '<t><ilfp>',

        "searching": false,

        'columnDefs': [{

            'targets': 0,

            'searchable':false,

            'orderable':false,

            'width':'1%',

            'className': 'dt-body-center',

            'render': function (data, type, full, meta){

                return '<input type="checkbox">';

            }

        }],

        'order': [1, 'asc'],

        paginate: {

            next: '&#8594;', // or '?'

            previous: '&#8592;' // or '?'

        },

        'rowCallback': function(row, data, dataIndex){

            // Get row ID

            var rowId = data[0];



            // If row ID is in the list of selected row IDs

            if($.inArray(rowId, rows_selected) !== -1){

                $(row).find('input[type="checkbox"]').prop('checked', true);

                $(row).addClass('selected');

            }

        }

    });



    // Handle click on checkbox

    $('.example tbody').on('click', 'input[type="checkbox"]', function(e){

        var $row = $(this).closest('tr');



        // Get row data

        var data = table.row($row).data();



        // Get row ID

        var rowId = data[0];



        // Determine whether row ID is in the list of selected row IDs

        var index = $.inArray(rowId, rows_selected);



        // If checkbox is checked and row ID is not in list of selected row IDs

        if(this.checked && index === -1){

            rows_selected.push(rowId);



            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs

        } else if (!this.checked && index !== -1){

            rows_selected.splice(index, 1);

        }



        if(this.checked){

            $row.addClass('selected');

        } else {

            $row.removeClass('selected');

        }



        // Update state of "Select all" control

        updateDataTableSelectAllCtrl(table);



        // Prevent click event from propagating to parent

        e.stopPropagation();

    });



    // Handle click on table cells with checkboxes

    $('.example').on('click', 'tbody td, thead th:first-child', function(e){

        $(this).parent().find('input[type="checkbox"]').trigger('click');

    });



    // Handle click on "Select all" control

    $('thead input[name="select_all"]', table.table().container()).on('click', function(e){

        if(this.checked){

            $('.example tbody input[type="checkbox"]:not(:checked)').trigger('click');

        } else {

            $('.example tbody input[type="checkbox"]:checked').trigger('click');

        }



        // Prevent click event from propagating to parent

        e.stopPropagation();

    });



    // Handle table draw event

    table.on('draw', function(){

        // Update state of "Select all" control

        updateDataTableSelectAllCtrl(table);

    });



    // Handle form submission event

    $('#frm-example').on('submit', function(e){

        var form = this;



        // Iterate over all selected checkboxes

        $.each(rows_selected, function(index, rowId){

            // Create a hidden element

            $(form).append(

                $('<input>')

                .attr('type', 'hidden')

                .attr('name', 'id[]')

                .val(rowId)

            );

        });



        // FOR DEMONSTRATION ONLY



        // Output form data to a console

        $('#example-console').text($(form).serialize());

        console.log("Form submission", $(form).serialize());



        // Remove added elements

        $('input[name="id\[\]"]', form).remove();



        // Prevent actual form submission

        e.preventDefault();

    });

});

//=============================Modules related JS============================

function getActivities(val) {

    var url= "<?php echo base_url()?>"+'dashboard/get/activities/'+val;

    window.location = url;

    //window.location.reload('<?php echo base_url()?>'+'activities/'+val)

}



function getLeadCount(val) {

    //document.getElementById("lead_created_value").value = val;

    if (val == 'all') {

        var url= "<?php echo base_url()?>"+'dashboard/index';

    } else {

        var url= "<?php echo base_url()?>"+'dashboard/get/lead/'+val;

    }

    window.location = url;

    //window.location.reload('<?php echo base_url()?>'+'activities/'+val)

}



function activity_performed_time(val) {

    document.getElementById("lead_time_value").value = val;

    var lead_by = document.getElementById("lead_by_value").value;

    var url= "<?php echo base_url()?>"+'dashboard/get/activity/'+val+'/'+lead_by;

    window.location = url;

}



function activity_performed_by(val) {

    document.getElementById("lead_by_value").value = val;

    var lead_time = document.getElementById("lead_time_value").value;

    var url= "<?php echo base_url()?>"+'dashboard/get/activity/'+lead_time+'/'+val;



    window.location = url;

}



function getClientCount(val) {

    if (val == 'all') {

        var url= "<?php echo base_url()?>"+'dashboard/index';

    } else {

        var url= "<?php echo base_url()?>"+'dashboard/get/client/'+val;

    }

    window.location = url;

    //window.location.reload('<?php echo base_url()?>'+'activities/'+val)

}



function getLeadCompletedCount(val) {

    var url= "<?php echo base_url()?>"+'dashboard/get/compare/'+val;

    window.location = url;

    //window.location.reload('<?php echo base_url()?>'+'activities/'+val)

}



function getLeadOpportunities(val) {

    var leadTime = document.getElementById("lead_created_value").value;

    var url= "<?php echo base_url()?>"+'lead/index/'+val+'/'+leadTime;

    window.location = url;

}



function getClientData(val) {

    var leadTime = document.getElementById("client_created_value").value;

    var url= "<?php echo base_url()?>"+'users/index/customer/'+val+'/'+leadTime;

    window.location = url;

}



function activity_status_by(val) {

    document.getElementById("lead_by_value").value = val;

    var lead_time = document.getElementById("lead_time_value").value;

    var url= "<?php echo base_url()?>"+'dashboard/get/activity/'+lead_time+'/'+val;



    window.location = url;

}



function activity_status_by(val) {

    document.getElementById("activity_status_value").value = val;

    var url= "<?php echo base_url()?>"+'dashboard/get/activityStatus/'+val;



    window.location = url;

}

</script>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<script type="text/javascript">

// Load google charts

google.charts.load('current', {'packages':['corechart']});

google.charts.setOnLoadCallback(drawChart);



google.charts.setOnLoadCallback(drawChart2);



// Draw the chart and set the chart values

function drawChart() {



    var a = [

        ['Task', 'Hours per Day'],

        ['Phone Call', <?php echo $activityCountList['phoneCall'];?>],

        ['Compose Email', <?php echo $activityCountList['composeEmail'];?>],

        ['Schedule Meeting', <?php echo $activityCountList['sMeeting'];?>],

        ['Create Task', <?php echo $activityCountList['cTask'];?>]

    ];



    var data = google.visualization.arrayToDataTable(a);



    // Optional; add a title and set the width and height of the chart

    var options = {'width':550, 'height':400, 'is3D': true,};



    // Display the chart inside the <div> element with id="piechart"

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);



}



function drawChart2() {



    var b = [

        ['Task', 'Hours per Day'],

        ['Not Complete', <?php echo $activityStatusCountList['not_complete'];?>],

        ['Past Due', <?php echo $activityStatusCountList['past_due'];?>],

        ['Complete', <?php echo $activityStatusCountList['pending'];?>],

        ['Pending', <?php echo $activityStatusCountList['complete'];?>]

    ];



    var data2 = google.visualization.arrayToDataTable(b);



    // Optional; add a title and set the width and height of the chart

    var options = {'width':550, 'height':400, 'is3D': true,};



    // Display the chart inside the <div> element with id="piechart"



    var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

    chart2.draw(data2, options);

}

</script>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js'></script>

<script>

new Morris.Line({

    // ID of the element in which to draw the chart.

    element: 'pushups',

    // Chart data records -- each entry in this array corresponds to a point on

    // the chart.

    data: <?php echo $leadCompanrison;?>,

    // The name of the data record attribute that contains x-values.

    xkey: 'day',

    parseTime: false,

    // A list of names of data record attributes that contain y-values.

    ykeys: ['completed','created'],

    // Labels for the ykeys -- will be displayed when you hover over the

    // chart.

    labels: ['Completed','Created'],

    lineColors: ['#373651','#E65A26']

});

</script>

<!--end::Global Theme Bundle -->

</body>

</html>
