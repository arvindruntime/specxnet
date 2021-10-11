<?php
$value = $Contact[0];

$newval = explode(',', $getLead[0]['user_info']);
foreach($newval as $val) {
    $val = explode('_', $val);
    if ($val[1] == 'Email') {
        $emailId[] = $val[0];
    } else if ($val[1] == 'Phone') {
        $phoneId[] = $val[0];
    }
}
?>
<div id="validation_errors"></div>
<form action="<?php echo base_url().'activity/create/leadactivity/'?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
<style type="text/css">
    .file-input > input[type="file"]{
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  opacity: 0;
  pointer-events: all;
  cursor: pointer;
  height: 100%;
  width: 100%;
  background: #80808091;
}</style>

        <div class="modal-content updateActivity" id="addLeadActivity">
            <div class="form-group m-form__group row m--margin-top-20" style="padding-left: 18px !important;">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <h4 id="oppTitle"><?php echo isset($getLead[0]['opportunity_title'])?$getLead[0]['opportunity_title']:''; ?></h4>
                    <input type="hidden" name="fk_lead_opportunity_id" id="fk_lead_opportunity_id" value="<?php echo isset($getLead[0]['lead_opportunity_id'])?$getLead[0]['lead_opportunity_id']:''; ?>">
                    <div class="modal-body" style="min-height: 100% !important; height: 100% !important;">
                        <div id="leadDetails" style="display: none;"></div>
                            <div class="m-portlet m-portlet--tabs">
                                <div class="m-portlet__body margin-top2" style="padding: 12px 0 !important" >
                                    <div class="tab-content" id="replaceLeadActivity">
                                        <div class="tab-pane active show" id="m_portlet_base_demo_8_tab_content" role="tabpanel">
                                            <div class="form-group m-form__group row m--margin-top-20">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <label for="street_address"><span style="color:red;">* </span>Type</label>
                                                    <select class="form-control" name="activity_typeUpdate" id="activity_typeUpdate" style="height: 38px !important" required>
                                                        <option value=""> -- Please Select --</option>
                                                        <?php
                                                        foreach ($activityType as $key => $activityTypeValue) { ?>
                                                            <option value="<?php echo $activityTypeValue['activity_type']?>" <?php if (isset($value['activity_type']) && $value['activity_type'] ==$activityTypeValue['activity_type']) { echo "selected";} else if($activityTypeValue['activity_type'] == 'Phone Call') {echo "selected";}?> ><?php echo $activityTypeValue['activity_type'];?></option>
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
                                                                <option value="<?php echo $Salesperson['sales_people_id'];?>" <?php if (isset($value['initiated_by']) && $value['initiated_by'] == $Salesperson['sales_people_id']) { echo "selected";} else if ($Salesperson['sales_people_id'] == $this->session->userdata('user_id')) { echo "selected"; }?> > <?php echo $Salesperson['name'];?></option>

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
                                                                <option value="<?php echo $Salesperson['sales_people_id'];?>" <?php if (isset($value['assigned_by']) && $value['assigned_by'] == $Salesperson['sales_people_id']) { echo "selected";}  else if ($Salesperson['sales_people_id'] == $this->session->userdata('user_id')) { echo "selected"; }?> > <?php echo $Salesperson['name'];?></option>

                                                    <?php   } } else {
                                                        ?>
                                                        <option value="0">Other</option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php
                                             //if(isset($value['activity_date']) ) {
                                            date_default_timezone_set('Asia/Kolkata');
                                            $currentDate = date('Y-m-d').'T'.date('H:i');
                                            $afterTime = date('Y-m-d', strtotime("+10 minutes")).'T'.date('H:i', strtotime("+10 minutes"))
                                            ?>
                                            <div class="form-group m-form__group row m--margin-top-20">
                                                <div class="col-lg-5 col-md-4 col-sm-12">
                                                    <label for="street_address"><span style="color:red;">* </span>Start Date & Time</label>
                                                    <?php
                                                     //if(isset($value['activity_date']) ) {
                                                    ?>
                                                        <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" id="datepickerUpdte" type="datetime-local" name="activity_start_datetime" min="<?php echo date('Y-m-d')?>" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_start_datetime'])?$value['activity_start_datetime']:$currentDate; ?>" required>

                                                    <?php //} else { ?>

                                                        <!-- <input class="form-control m-input datepicker" style="width: 100%;" id="m_datepicker_4_2" type="text" name="activity_date" placeholder="eg: 23-Oct-2019" required> -->

                                                    <?php //} ?>
                                                </div>

                                                <div class="col-lg-5 col-md-4 col-sm-12">
                                                    <label for="street_address"><span style="color:red;">* </span>End Date & Time</label>
                                                    <?php
                                                     //if(isset($value['activity_date']) ) {
                                                    ?>
                                                        <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" placeholder="eg: 23-Oct-2019" style="width: 100%;" id="datepicker" type="datetime-local" name="activity_end_datetime" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:$afterTime; ?>" required>

                                                    <?php //} else { ?>

                                                        <!-- <input class="form-control m-input datepicker" placeholder="eg: 23-Oct-2019" style="width: 100%;" id="m_datepicker_4_3" type="text" name="activity_date" required> -->

                                                    <?php //} ?>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row m--margin-top-20">

                                                <div class="col-lg-4 col-md-4 col-sm-12" id="activityStatus">
                                                    <label for="street_address">Activity Status</label>
                                                    <select class="form-control" id="activity_status"  name="status" style="height: 30px !important">
                                                        <option value="">--Select Status--</option>
                                                    <?php if (isset($phone_activity_status)) {
                                                        foreach ($phone_activity_status as $key => $activity_status_value) { ?>
                                                            <option value="<?php echo $activity_status_value['status']?>"><?php echo $activity_status_value['status'];?></option>
                                                       <?php }
                                                        } else { ?>
                                                        <option value="">--Select Status--</option>
                                                    <?php }?>
                                                    </select>

                                                </div>

                                                <div class="col-lg-5 col-md-5 col-sm-12" style="padding-top: 30px;">
                                                    <input type="checkbox" id="checkFollowUp"> Do You Want To Add Follow Up ?
                                                </div>

                                                <div class="col-lg-5 col-md-5 col-sm-12" id="showFollowup" style="display: none;">
                                                    <label for="street_address">Follow up Date & Time</label>
                                                    <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" name="follow_up_datetime" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12" id="showReminder"  style="display: none;">
                                                    <label for="street_address">Reminder</label>
                                                    <select class="form-control"  name="reminder" id="reminderUpdate" style="height: 30px !important">
                                                        <option value="">None</option>
                                                        <option value="1 min" <?php if (isset($value['reminder']) && $value['reminder'] =='1 min') { echo "selected";}?>>1 Min Before</option>
                                                        <option value="2 min" <?php if (isset($value['reminder']) && $value['reminder'] =='2 min') { echo "selected";}?>>2 Mins Before</option>
                                                        <option value="5 min" <?php if (isset($value['reminder']) && $value['reminder'] =='5 min') { echo "selected";}?>>5 Mins Before</option>
                                                        <option value="1 Day" <?php if (isset($value['reminder']) && $value['reminder'] =='1 Day') { echo "selected";}?>>1 Day Before</option>
                                                        <option value="2 Day" <?php if (isset($value['reminder']) && $value['reminder'] =='2 Day') { echo "selected";}?>>2 Days Before</option>
                                                        <option value="5 Day" <?php if (isset($value['reminder']) && $value['reminder'] =='2 Day') { echo "selected";}?>>5 Days Before</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-12" id="drafttime" disabled style="display: none;">
                                                    <label for="street_address">Set Time to Send Later</label>
                                                    <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" id="email_draft_time" name="email_draft_time" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row m--margin-top-20">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label for="street_address" id="title"><span style="color:red;">* </span>Add Note</label>
                                                    <input class="form-control m-input" type="text" name="activity_title" value="<?php echo isset($value['activity_title'])?$value['activity_title']:''; ?>" required>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12"  id="descriptionField" style="margin-top: 10px;display: none">
                                                    <label for="street_address">Description</label>
                                                    <textarea class="form-control m-input" name="description" id="descriptionUpdate" placeholder="" rows="3" style="height:150px!important"><?php echo isset($value['description'])?$value['description']:''; ?></textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12"  id="attachment" style="display: none">
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
                                                    <input id="checkSendEmail" type="checkbox" name="checkComposeEmail">
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
                                <input type="hidden" name="userType" value="leadactivity">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 15px;">
                                        <div id="user_type"></div>
                                        <?php
                                            if (isset($value['lead_activity_id'])) {
                                        ?>
                                        <input type="hidden" name="leadActivityUpdateId" value="<?php echo $value['lead_activity_id'];?>">
                                    <?php }?>
                                        <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Submit</button>
                                        <?php if(empty($value)) { ?>
                                            <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>
                                        <?php } ?>
                                        <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <h3>Customer Info</h3>
                    <label>
                        <b>Name: </b><span id="attachFullname"><?php echo isset($getLead[0]['full_name'])?$getLead[0]['full_name']:'---'; ?></span>
                        <input type="hidden" name="userName" value="<?php echo isset($getLead[0]['full_name'])?$getLead[0]['full_name']:'---'; ?>">
                    </label><br/>
                    <label>
                        <b>Company: </b><span id="attachCompany"><?php echo isset($getLead[0]['company_name'])?$getLead[0]['opportunity_title']:'---'; ?></span>
                    </label><br/>
                    <label>
                        <b>Designation: </b><span id="attachDesignation"><?php echo isset($getLead[0]['designation'])?$getLead[0]['designation']:'---'; ?></span>
                    </label><br/>
                    <label>
                        <b>Phone: </b><span id="attachPhone"><?php echo !empty($emailId)?implode(',', $emailId):'---'; ?></span>
                    </label>
                    <label>
                        <b>Email: </b><span id="attachEmail"><?php echo !empty($phoneId)?implode(',', $phoneId):'---'; ?></span>
                        <input type="hidden" name="userEmail" value="<?php echo !empty($phoneId)?implode('|', $phoneId):'---'; ?>">
                    </label>
                    <br/>
                    <label> ------------------</label>
                    <br/>

                    <label for="street_address"> <b>Activity History</b></label><br/><br/>
                    <!-- <select class="form-control" id="activityList" style="height: 38px !important">
                        <option value=""> -- Please Select --</option>
                        <?php
                        foreach ($activityList as $key => $activityList) { ?>
                            <option value="<?php echo $activityList['lead_activity_id'].'_'.$activityList['activity_title'].'_'.$activityList['activity_date'].'_'.$activityList['description']?>"><?php echo $activityList['activity_type']. '('.$activityList['activity_date'].')';?></option>
                        <?php }
                        ?>
                    </select> -->
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
                <?php }?>
                    <!-- <label id="activityDescription">
                       <b>Description: </b> <span id="descVal">---</span>
                    </label> -->
                </div>

            </div>
</form>
