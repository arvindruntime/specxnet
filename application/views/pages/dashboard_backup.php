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
        <link href="<?php echo base_url(); ?>media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/demo/default/media/img/logo/SpecXReef_Logo.ico" />
        <style type="text/css">
            div.dataTables_wrapper {
            margin: 0 auto;
            }   
        </style>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <?php echo $this->page->getPage('layout/header'); ?>
            <!-- END: Header -->
            <div class="m-subheader displaynone" style="padding-top: 80px !important;">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <a class="m-subheader_title m-subheader_title--separator" href="lead_opportunity.php"><img src="<?php echo base_url();?>assets/app/media/img/logos/HozpitalityLogo2.png" style="width: 300px; height: 75px;" class="img-responsive"></a>          
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body" style="padding-top: 0px !important;">
                <!-- BEGIN: Left Aside -->
                <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
                <!--<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">    
                    </div>-->
                <!-- END: Left Aside -->                            
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="m-content">
                        <div class="row">
                            <!-- <div class="col-xl-3 col-lg-4" style="padding-right: 0">
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Jobs Menu
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon" aria-describedby="tooltip_a8md9g7ukg"><i class="la la-angle-down"></i></a>    
                                                    <div class="m-tooltip m-tooltip--portlet tooltip bs-tooltip-top" role="tooltip" id="tooltip_a8md9g7ukg" aria-hidden="true" x-placement="top" style="position: absolute; will-change: transform; visibility: hidden; top: 0px; left: 0px; transform: translate3d(402px, -33px, 0px);">
                                                        <div class="tooltip-arrow arrow" style="left: 38px;"></div>
                                                        <div class="tooltip-inner">Collapse</div>
                                                    </div>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <i class="la la-plus" style="color:#FFF"></i>
                                                </li>
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group">
                                            <input type="text" class="form-control m-input">
                                        </div>
                                        <p>Title</p>
                                        <p>Company Name</p>
                                        <p>Company Add</p>
                                        <div>
                                            <hr>
                                        </div>
                                        <p><a href="#"  data-toggle="modal" data-target="#job_details_job_info_tab_modal">Job Title 1</a></p>
                                        <p>Job Title 2</p>
                                        <p>Job Title 3</p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-4 col-lg-4" style="padding-right: 0">
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Owner Activity
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <p><i class="m-menu__link-icon m-nav__link-icon la la-home big-icon-size"></i>&nbsp;Last Login: <b><?php echo $last_login['last_login'];?></b></p>
                                    </div>
                                </div>
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Warranty Alerts
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <h5 align="center" style="font-size:16.9px">Updated in Last Year</h5>
                                        <p>New Owner Claims:</p>
                                        <p>Reschedule request:</p>
                                        <p>Feedback Needing Rework:</p>
                                        <p>Ready For Next Phase</p>
                                    </div>
                                </div> -->
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Recent Documents
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <h5 align="center" style="font-size:16.9px">Added in the Last 7 Days</h5>
                                        <div class="row">
                                            <div class="col-7"><i class="fa fa-file-excel"></i>&nbsp;New Opportunity</div>
                                            <div class="col-5" align="right">10-05-2019</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Today's Schedule
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="m-input">
                                                    <select class="form-control" id="m_notify_state" style="height: 30px !important">
                                                        <option value="none">Hide items over 30 Days</option>
                                                        <option value="danger">Menu 1</option>
                                                        <option value="warning">Menu 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class"row">
                                            <table class="table table-striped- table-bordered table-hover table-checkable example">
                                                <thead>
                                                    <tr>
                                                        <th><strong>Item</strong></th>
                                                        <th><strong>Progress</strong></th>
                                                        <th><strong>Complete ?</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Schedule Item</a></td>
                                                        <td>Ended 14-05-2019</td>
                                                        <td><input type="checkbox"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Pending/Recent Change Order Activity
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <h5 align="center" style="font-size:16.9px">No changes order</h5>
                                    </div>
                                </div> -->
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Recent Bill/PO Activity
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col-12">
                                                <select class="form-control" id="m_notify_state" style="height: 30px !important">
                                                    <option value="none">Approved/Declined Updates</option>
                                                    <option value="danger">Menu 1</option>
                                                    <option value="warning">Menu 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h5 align="center" style="font-size:16.9px; padding-top:10px">No Bill/Purchase Order</h5>
                                    </div>
                                </div> -->
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Job Price Summary
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col-7">Contract Price</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;100000</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">Change Order</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;0.00</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">Selections</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;0.00</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">Job Running Total:</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;1000000</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">Less Payments Received</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;0.00</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7">Remaining Balance:</div>
                                            <div class="col-5" align="right"><i class="fa fa-dollar-sign"></i> &nbsp;1000000</div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Lead Activities For <?php echo $this->session->userdata('user_name');?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                                <!-- <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#">
                                                View Activity</button> -->
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="m-input">
                                                    <select class="form-control" id="m_notify_state" style="height: 30px !important" onchange="getActivities(this.value)">
                                                        <option value="today">Today</option>
                                                        <option value="tomorrow" <?php if (isset($activityParameter) && $activityParameter =='tomorrow') { echo 'selected';}?>>Tomorrow</option>
                                                        <option value="this_week" <?php if (isset($activityParameter) && $activityParameter =='this_week') { echo 'selected';}?>>This Week</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <table class="table table-striped- table-bordered table-hover table-checkable example">
                                                <thead>
                                                    <tr>
                                                        <th><input name="select_all" value="1" type="checkbox"></th>
                                                        <th>Status</th>
                                                        <th>Type</th>
                                                        <th>Activity Date</th>
                                                        <th>Customer Details</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($activities as $activitieskey => $activitiesvalue) {
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $activitiesvalue['status'];?></td>
                                                        <td><?php echo $activitiesvalue['activity_type'];?></td>
                                                        <td><?php echo date('d-M-Y h:i A', strtotime($activitiesvalue['activity_start_datetime']));?></td>
                                                        <td><?php echo $activitiesvalue['client_name'];?></td>
                                                        <td><?php echo $activitiesvalue['email'];?></td>
                                                        <td><?php echo $activitiesvalue['phone'];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    To-Do's For Ashish
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                                <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#">
                                                New To-Do</button>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="m-input">
                                                    <select class="form-control" id="m_notify_state" style="height: 30px !important">
                                                        <option value="none">Hide To-Do over 30 Days</option>
                                                        <option value="danger">Menu 1</option>
                                                        <option value="warning">Menu 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class"row">
                                            <table class="table table-striped- table-bordered table-hover table-checkable" id="example6">
                                                <thead>
                                                    <tr>
                                                        <th><input name="select_all" value="1" type="checkbox"></th>
                                                        <th>Title</th>
                                                        <th>Priority</th>
                                                        <th>Due</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td>This is Test</a></td>
                                                        <td>High</td>
                                                        <td>Sun May 12</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>This is Test</a></td>
                                                        <td>High</td>
                                                        <td>Sun May 12</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Bid Package
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="m-input">
                                                    <select class="form-control" id="m_notify_state" style="height: 30px !important">
                                                        <option value="none">Ending within 7 Days</option>
                                                        <option value="danger">Menu 1</option>
                                                        <option value="warning">Menu 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top:1rem">No Bid Packages</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Most Recently Daily Logs
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                                <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#">
                                                New Daily Log</button>
                                            </div>
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top:1rem">No Daily Logs</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Recent Photos 
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body" style="padding-top:0">
                                        <div class="form-group m-form__group row">
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top: 5px">Added in the last year</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="images/ashish.png" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Recent Videos 
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body" style="padding-top:0">
                                        <div class="form-group m-form__group row">
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top: 5px">Added in the last year</h5>
                                                <h5 align="center" style="font-size:16.9px; padding-top: 15px">No Videos</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Most Recently Daily Logs
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                                <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#">
                                                New Message</button>
                                                <span>(0) New Message</span>
                                            </div>
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top:1rem">No Messages</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet m-portlet--accent m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_1">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    RFIs
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="m-portlet__head-tools">
                                            <ul class="m-portlet__nav">
                                                <li class="m-portlet__nav-item">
                                                    <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-close"></i></a>   
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-6 col-md-6 col-sm-122 lead-bottommargin new-activity">
                                                <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#">
                                                New RFI
                                                </button>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="m-input">
                                                    <select class="form-control" id="m_notify_state" style="height: 30px !important">
                                                        <option value="none">Waiting for Your Response </option>
                                                        <option value="danger">Menu 1</option>
                                                        <option value="warning">Menu 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5 align="center" style="font-size:16.9px; padding-top:1rem">No RFIs</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
        <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/ion-range-slider.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
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
        </script>
        <!--end::Global Theme Bundle -->
    </body>
</html>