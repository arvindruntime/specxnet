<style>
  .pastDue {
    background-color: red !important;
  }

  .RNR {
    background-color: #1f2eae96 !important;
  }

  .not_reachable {
    background-color: #4050d396 !important;
  }

  .saveAsDraft {
    background-color: #5d9d9db8 !important;
  }

  .schedule {
    background-color: #dfcb60 !important;
  }

  .postpone {
    background-color: #b8a124 !important;
  }

  .invalid_no {
    background-color: #7681db !important;
  }

  .pending {
    background-color: #763d3d !important;
  }

  .taskopen {
    background-color: #d94c4c !important;
  }

  .taskclose {
    background-color: #9d4d4da8 !important;
  }

  .sendLater {
    background-color: #396c6cd6 !important;
  }
</style>
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <!-- BEGIN: HEADER -->
  <?php echo $this->page->getPage('layout/header'); ?>
  <!-- END: HEADER -->    
</div>
<!-- end:: Page -->
<?php 
    $pageMenuArray = HEADER_ARRAY;
?>
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
   <!-- BEGIN: Left Aside -->
   <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
   <!-- END: Left Aside -->             
   <div class="m-grid__item m-grid__item--fluid m-wrapper">
      <!-- BEGIN: Subheader -->
      <?php echo $this->page->getPage('layout/body/body_header'); ?>
      <!-- END: Subheader -->         
      <div class="m-content">
         <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">
            <div class="m-portlet__head box-center1" align="center">
               <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                     <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >
                        Activity Calendar
                     </h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group m-form__group row">
            <?php //echo $this->page->getPage('layout/body/body_action'); ?> 
         </div>
         <div style="margin-bottom: 0.5rem;">
            <div class="d-flex align-items-center">
               <div class="mr-auto margin_left">
               </div>
            </div>
         </div>

         <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet m-portlet--tabs">
               <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <?php echo $this->page->getPage('layout/body/presale_tabs'); ?>
                        </div>
                </div>

                <div class="calendar-color">
                  <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>">
                  <button class="btn btn-primary"></button><span style="margin-left: 12px; font-weight: bold;">Phone Activity</span> 
                  <button class="btn btn-warning" style="margin-left: 18px; background-color: teal; border-color: teal;"></button><span style="margin-left: 12px; font-weight: bold;">Email Activity</span>
                  <button class="btn btn-danger" style="margin-left: 18px; background-color: gold; border-color: gold;"></button><span style="margin-left: 12px; font-weight: bold;">Schedule Meeting</span>
                  <button class="btn btn-success" style="margin-left: 18px; background-color: brown; border-color: brown"></button><span style="margin-left: 12px; font-weight: bold;">Create Task Activity</span>
                  <button class="btn btn-success" style="margin-left: 18px;"></button><span style="margin-left: 12px; font-weight: bold;">Completed Activity</span>
                  <button class="btn btn-success" style="margin-left: 18px; background-color: red; border-color: red"></button><span style="margin-left: 12px; font-weight: bold;">Past Due Activity</span>
                </div>
                  
                
               <div class="m-portlet__body3" style="margin-top: 16px;">
                  <div class="col-md-12">
                    <div class="m-portlet" id="m_portlet">
                      <div class="m-portlet__body">
                        <div id="m_calendar"></div>
                        <!-- <div id="calendar"></div> -->
                      </div>
                    </div>
                  </div>
               </div>
            </div>
            <!--end: Datatable -->
         </div>
      </div>
   </div>
</div>
                   
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
  <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<div class="modal fade show" id="select_existing" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setActivityTitle">Update Activity</h5>
                    <button type="button" class="close" onclick="location.reload();">
                    <span aria-hidden="true" class="la la-remove"></span>
                    </button>
                </div>

                <div class="modal-body" style="overflow-y: scroll; height: 620px;">             
                    <!-- <div class"row"> -->
                        <form action="<?php echo base_url().'activity/calendar/leadactivity/'?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
                           <div class="form-group m-form__group row m--margin-top-20 mob-no-pad">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h4 id="oppTitle">
                                      <input type="text" list="datalist" class="form-control m-input" placeholder="Select Lead Opportunity" name="opportunity_title"  value="" required>
                                      <datalist id="datalist"> 
                                          <?php
                                              foreach ($lead_opportunity as $key => $value) {
                                          ?>
                                          <option value="<?php echo $value['opportunity_title'].'-'.$value['full_name'];?>"></option>
                                          <?php }?>
                                        
                                      <!-- This data list will be edited through javascript     -->
                                      </datalist>
                                    </h4>
                                    <input type="hidden" name="fk_lead_opportunity_id" id="fk_lead_opportunity_id" value="<?php echo isset($value['fk_lead_opportunity_id'])?$value['fk_lead_opportunity_id']:''; ?>">
                                    <div class="modal-body" style="min-height: 100% !important; height: 100% !important;">
                                        <div id="leadDetails" style="display: none;"></div>
                                            <div class="m-portlet m-portlet--tabs" style="padding: 10px;">
                                                <div class="m-portlet__body margin-top2" style="padding: 12px 0 !important" >
                                                    <div class="tab-content" id="replaceLeadActivity" style="padding: 12px 0 !important">
                                                        <div class="tab-pane active show" id="m_portlet_base_demo_8_tab_content" role="tabpanel" style="padding: 12px 0 !important">
                                                            <div class="form-group m-form__group row m--margin-top-20">
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="street_address"><span style="color:red;">* </span>Type</label>    
                                                                    <select class="form-control" name="activity_typeUpdate" id="activity_typeUpdate" style="height: 38px !important" required>
                                                                        <option value=""> -- Please Select --</option>
                                                                        <?php
                                                                        foreach ($activityType as $key => $activityTypeValue) { ?>
                                                                            <option value="<?php echo $activityTypeValue['activity_type']?>" <?php if (isset($activity_type) && $activity_type == $activityTypeValue['activity_type']) { echo "selected";} else if(!isset($activity_type) && $activityTypeValue['activity_type'] == 'Phone Call') {echo "selected";}?> ><?php echo $activityTypeValue['activity_type'];?></option>
                                                                        <?php }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="street_address"><span style="color:red;">* </span>Initiated By</label>    
                                                                    <select class="form-control" name="initiated_byUpdate" id="initiated_byUpdate" style="height: 38px !important" required>
                                                                        <option value="">-- Please Select --</option>
                                                                        <?php
                                                                            if (isset($salesPerson)) {
                                                                                foreach ($salesPerson as $Salesperson) { ?>
                                                                                <option value="<?php echo $Salesperson['user_id'];?>" <?php if (isset($initiated_by) && $initiated_by == $Salesperson['user_id']) { echo "selected";} else if ($Salesperson['user_id'] == $this->session->userdata('user_id')) { echo "selected"; }?> > <?php echo $Salesperson['name'];?></option>
                                                                                    
                                                                    <?php   }} else {
                                                                        ?>
                                                                        <option value="0">Other</option>
                                                                    <?php }?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                                    <label for="street_address"><span style="color:red;">* </span>Assigned To</label>    
                                                                    <select class="form-control" name="assigned_by" id="assigned_byUpdate" style="height: 38px !important" required>
                                                                        <option value="">-- Please Select --</option>
                                                                        <?php 
                                                                            if (isset($salesPerson)) {
                                                                                foreach ($salesPerson as $Salesperson) { ?>
                                                                                <option value="<?php echo $Salesperson['user_id'];?>" <?php if (isset($assigned_by) && $assigned_by == $Salesperson['user_id']) { echo "selected";}  else if ($Salesperson['user_id'] == $this->session->userdata('user_id')) { echo "selected"; }?> > <?php echo $Salesperson['name'];?></option>
                                                                                    
                                                                    <?php   } } else {
                                                                        ?>
                                                                        <option value="0">Other</option>
                                                                    <?php }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group m-form__group row m--margin-top-20">
                                                                <div class="col-lg-5 col-md-4 col-sm-12">
                                                                    <label for="street_address"><span style="color:red;">* </span>Start Date & Time</label>    
                                                                    <?php
                                                                     //if(isset($value['activity_date']) ) {
                                                                    date_default_timezone_set('Asia/Kolkata');
                                                                    $currentDate = date('Y-m-d').'T'.date('H:i');
                                                                    $afterTime = date('Y-m-d', strtotime("+10 minutes")).'T'.date('H:i', strtotime("+10 minutes"))
                                                                    ?>
                                                                        <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" id="datepickerUpdte" type="datetime-local" name="activity_start_datetime" placeholder="eg: 23-Oct-2019" value="<?php echo isset($activity_start_datetime)?$activity_start_datetime:$currentDate; ?>" required>

                                                                    <?php //} else { ?>

                                                                        <!-- <input class="form-control m-input datepicker" style="width: 100%;" id="m_datepicker_4_2" type="text" name="activity_date" placeholder="eg: 23-Oct-2019" required> -->

                                                                    <?php //} ?>
                                                                </div>

                                                                <div class="col-lg-5 col-md-4 col-sm-12">
                                                                    <label for="street_address"><span style="color:red;">* </span>End Date & Time</label>    
                                                                    <?php
                                                                     //if(isset($value['activity_date']) ) {
                                                                    ?>
                                                                        <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" placeholder="eg: 23-Oct-2019" style="width: 100%;" id="datepicker" type="datetime-local" name="activity_end_datetime" value="<?php echo isset($activity_end_datetime)?$activity_end_datetime:$afterTime; ?>" required>

                                                                    <?php //} else { ?>

                                                                        <!-- <input class="form-control m-input datepicker" placeholder="eg: 23-Oct-2019" style="width: 100%;" id="m_datepicker_4_3" type="text" name="activity_date" required> -->

                                                                    <?php //} ?>
                                                                </div>

                                                            </div>

                                                            <div class="form-group m-form__group row m--margin-top-20">

                                                                <div class="col-lg-4 col-md-4 col-sm-12" id="activityStatus">
                                                                    <label for="street_address">Activity Status</label>
                                                                    <!-- <select class="form-control" id="activity_status"  name="status" style="height: 30px !important">
                                                                        <option value="">--Select Status--</option>
                                                                    <?php if (isset($phone_activity_status)) { 
                                                                        foreach ($phone_activity_status as $key => $activity_status_value) { ?>
                                                                            <option value="<?php echo $activity_status_value['status']?>" <?php if (isset($las) && $las ==$activity_status_value['status']) { echo "selected";}?>><?php echo $activity_status_value['status'];?></option>
                                                                       <?php }
                                                                        } else { ?>
                                                                        <option value="">--Select Status--</option>
                                                                    <?php }?> 
                                                                    </select> -->
                                                                    
                                                                    <select class="form-control" id="activity_status"  name="status" style="height: 30px !important" required>
                                                                        <option value="">--Select Status--</option>
                                                                    <?php  foreach ($get_activity_status as $key => $activity_status_value) {
                                                                            ?>
                                                                            <option value="<?php echo $activity_status_value['status']?>" <?php if (isset($las) && $las == $activity_status_value['status']) { echo "selected";}?>><?php echo $activity_status_value['status'];?></option>
                                                                        <?php }?>
                                                                     
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-5 col-md-5 col-sm-12" style="padding-top: 30px;">
                                                                    <input type="checkbox" id="checkFollowUp"> Do You Want To Add Follow Up ?
                                                                </div>

                                                                <div class="col-lg-5 col-md-5 col-sm-12" id="showFollowup" style="display: none; margin-top: 10px">
                                                                    <label for="street_address">Follow up Date & Time</label>
                                                                    <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" id="follow_up_datetime" name="follow_up_datetime" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">
                                                                </div>

                                                                <div class="col-lg-3 col-md-3 col-sm-12" id="showReminder"  style="display: none; margin-top: 10px">
                                                                    <label for="street_address">Reminder</label>    
                                                                    <select class="form-control"  name="reminder" id="reminderUpdate" style="height: 30px !important">
                                                                        <option value="">None</option>
                                                                        <option value="1 min" <?php if (isset($reminder) && $reminder =='1 min') { echo "selected";}?>>1 Min Before</option>
                                                                        <option value="2 min" <?php if (isset($reminder) && $reminder =='2 min') { echo "selected";}?>>2 Mins Before</option>
                                                                        <option value="5 min" <?php if (isset($reminder) && $reminder =='5 min') { echo "selected";}?>>5 Mins Before</option>
                                                                        <option value="1 Day" <?php if (isset($reminder) && $reminder =='1 Day') { echo "selected";}?>>1 Day Before</option>
                                                                        <option value="2 Day" <?php if (isset($reminder) && $reminder =='2 Day') { echo "selected";}?>>2 Days Before</option>
                                                                        <option value="5 Day" <?php if (isset($reminder) && $reminder =='5 Day') { echo "selected";}?>>5 Days Before</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-4 col-md-4 col-sm-12" id="drafttime" disabled style="display: none; margin-top: 10px">
                                                                    <label for="street_address">Email Draft Time</label>
                                                                    <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" id="email_draft_time" name="email_draft_time" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="form-group m-form__group row m--margin-top-20">
                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <label for="street_address" id="title"><span style="color:red;">* </span>Add Note</label>
                                                                    <input class="form-control m-input" type="text" id="activity_title" name="activity_title" value="<?php echo isset($activity_title)?$activity_title:''; ?>" required>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-sm-12" id="descriptionField" style="margin-top: 10px;display: none">
                                                                    <label for="street_address">Description</label>
                                                                    <textarea class="form-control m-input" name="description" id="description" placeholder="" rows="3" style="height:150px!important"><?php echo isset($description)?$description:''; ?></textarea>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-sm-12" id="attachment" style="display: none">
                                                                    <label for="street_address">Attachments 
                                                                        <?php
                                                                        if (isset($value['activity_attachement_name']) && $value['activity_attachement_name'] !='') { ?>
                                                                            <a href="<?php echo base_url().'upload/leadActivityFiles/'.$value['activity_attachement_name'];?>" id="deleteFile"  target="_blank">( View )</a>
                                                                            <i class="fa fa-trash" style="margin-left: 15px; color: #e12626;" onclick="deleteFile(<?php echo $value['lead_activity_id']; ?>)"></i>
                                                                        <?php }?>
                                                                        </label>
                                                                    <input class="form-control m-input" type="file" name="activity_attachment">
                                                                </div>

                                                                <!-- <div class="col-lg-12 col-md-12 col-sm-12" id="checkSendEmail" style="display: none;margin-top: 15px;">
                                                                    <input id="checkSendEmail" type="checkbox" name="checkComposeEmail"> Check if you want to send email now
                                                                </div> -->
                                                            </div>

                                                            <input type="hidden" name="lead_opportunity_idUpdate" id="lead_opportunity_idUpdate" value="">
                                                        </div>
                                                        <div class="tab-pane margin-top2" id="m_portlet_base_demo_9_tab_content" role="tabpanel">
                                                            <div class="col-md-12">
                                                                <div class="inbox-body">
                                                                    <div class="inbox-content" style="">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <label class="control-label">Attachments:</label>
                                                                                        <!-- <button type="file" class="btn btn-secondary m-btn" style="font-family: sans-serif, Arial; margin-left: 20px">Add</button> -->
                                                                                        
                                                                                          <input type="file" name="activity_mail" id="activity_mail"/>
                                                                                        
                                                                                        <!-- <button type="button" class="btn btn-secondary m-btn" style="font-family: sans-serif, Arial;">Save &amp; Create New Doc</button> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">To:</label>
                                                                                <div class="controls">
                                                                                    <label name='toEmail' id="toEmail"><input type="text" class="form-control" name="to" value="<?php echo isset($value['email'])?$value['email']:'---'; ?>" readonly></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Subject:</label>
                                                                                <div class="controls">
                                                                                    <input type="text" class="form-control" name="subject">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Message:</label>
                                                                                <div class="controls">
                                                                                    <textarea id="eg-textarea" class="form-control" name='message' style="height: 75px !important;"></textarea> 
                                                                                </div>
                                                                            </div>
                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                </div>
                                                <input type="hidden" name="leadactivityCalender" value="leadactivityCalender">
                                                <input type="hidden" name="leadActivityUpdateId" id="leadActivityUpdateId" value="">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 15px;padding-left: 27px;">
                                                        <div id="user_type"></div>
                                                        <?php
                                                            if (isset($lead_activity_id)) {
                                                        ?>
                                                        <input type="hidden" name="leadActivityUpdateId" value="<?php echo $lead_activity_id;?>">
                                                    <?php }?>
                                                        <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Submit</button>
                                                        
                                                        <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-3 col-md-3 col-sm-12">
                                    <h3>Customer Info</h3>
                                    <label>
                                        <b>Name: </b><span id="attachFullname"><?php echo isset($value['full_name'])?$value['full_name']:'---'; ?></span>
                                        <input type="hidden" name="userName" value="<?php echo isset($value['full_name'])?$value['full_name']:'---'; ?>">
                                    </label><br/>
                                    <label>
                                        <b>Company: </b><span id="attachCompany"><?php echo isset($value['company_name'])?$value['company_name']:'---'; ?></span>
                                    </label><br/>
                                    <label>
                                        <b>Designation: </b><span id="attachDesignation"><?php echo isset($value['designation'])?$value['designation']:'---'; ?></span>
                                    </label><br/>
                                    <label>
                                        <b>Phone: </b><span id="attachPhone"><?php echo isset($value['phone'])?$value['phone']:'---'; ?></span>
                                    </label>
                                    <label>
                                        <b>Email: </b><span id="attachEmail"><?php echo isset($value['email'])?$value['email']:'---'; ?></span>
                                        <input type="hidden" name="userEmail" value="<?php echo isset($value['email'])?$value['email']:'---'; ?>">
                                    </label>
                                    <br/>
                                    <label> ------------------</label>  
                                    <br/>

                                    <label for="street_address"> <b>Activity History</b></label><br/><br/>
                                    <?php
                                    if (isset($activityListHistory)) {
                                    ?>
                                    <?php

                                        foreach ($activityListHistory as $key => $activityList) { ?>
                                            <label>
                                               <b>Type: </b> <span><?php echo isset($activityList['activity_type'])?$activityList['activity_type']:''; ?></span>
                                            </label>
                                            <br/>
                                            <label>
                                               <b>Activity Date: </b> <span><?php echo isset($activityList['activity_start_datetime'])?date('d-M-Y h:i A', strtotime($activityList['activity_start_datetime'])):''; ?></span>
                                            </label>
                                            <br/>
                                            <label>
                                               <b>Comment: </b> <span><?php echo isset($activityList['activity_title'])?$activityList['activity_title']:''; ?></span>
                                            </label>
                                            <br/>
                                            <label> ------------------</label>  
                                            <br/>
                                <?php }
                                 } else { ?>
                                    <span id="getHistory">
                                        
                                    </span>
                                <?php }?>
                                </div> -->
                            </div>
                            
                            
                        <!-- </div> -->
                        </div>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>

<script>
  
</script>