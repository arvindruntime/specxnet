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
    <div class="modal-content snehal" id="selectLeadOpp" style="display: inline;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lead Activity Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="height: 250px; overflow-y: scroll;">
                <div class="form-group m-form__group row m--margin-top-20">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control m-select2" id="selecLeadOpportinutyadd" name="param" style="opacity: 1;">
                            <option value="">-- Select a Lead --</option>
                            <?php
                                foreach($getLead as $title) { ?>
                                    <option value="<?php echo $title['lead_opportunity_id'],":",$title['email'],":",$title['phone'];?>"><?php echo $title['opportunity_title'];?></option>
                            <?php }
                            ?>
                        </select>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content updateActivity" id="addLeadActivity" style="display: none;">
            <div class="form-group m-form__group row m--margin-top-20">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="user_type"></div>
                    <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>
                    <?php if(empty($value)) { ?>
                        <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>
                    <?php } ?>
                    <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
                </div>
            </div>
            <div class="modal-body modal__scroll">
                <div id="leadDetails" style="display: none;"></div>
                    <div class="m-portlet m-portlet--tabs">
                        <div class="m-portlet__head" style="padding: 0">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_8_tab_content" role="tab" aria-selected="false">
                                        General
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_9_tab_content" role="tab" aria-selected="false">
                                        Attach an Email
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >
                            <div class="tab-content" id="replaceLeadActivity">
                                <div class="tab-pane active show" id="m_portlet_base_demo_8_tab_content" role="tabpanel">
                                    <div class="m-portlet" style="margin-top: 2.2rem; padding-top: 1rem; padding-bottom: 1rem">
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-1 col-sm-1">
                                                <?php
                                                    if (isset($value['activity_type']) && $value['activity_type'] == 'Email') {
                                                        echo "<i class='fa fa-envelope' style='font-size: 2.1rem'></i>";
                                                    } else {
                                                        echo "<i class='fa fa-phone-square' style='font-size: 2.1rem'></i>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <div class="m-checkbox-inline">
                                                    <label class="m-checkbox">
                                                        <?php
                                                         if(isset($value['follow_up_date']) && $value['follow_up_date'] != '01-Jan-1970') {
                                                        ?>
                                                    <input type="checkbox" id="checkUpdateavailable" onclick="checkUpdateData()" checked="" > Complete
                                                    <span></span>
                                                     <?php } else { ?>
                                                        <input type="checkbox" id="checkUpdateOld" onclick="checkUpdateBoxNew()"> Complete
                                                    <span></span>
                                                     <?php } ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <label for="example-text-input" class="col-3 col-form-label" id="add_follow_up" <?php if (!isset($value['follow_up_date']) || $value['follow_up_date'] == '01-Jan-1970') { ?> style="visibility: hidden;"  <?php } ?>><span style="color:red;">* </span>Schedule Follow-up</label>
                                            <div class="col-3 new-activity">
                                                <div class="input-group date" id="follow-up-date">
                                                    <?php
                                                     if(isset($value['follow_up_date']) && $value['follow_up_date'] != '01-Jan-1970' ) {
                                                    ?>
                                                    <input type="text" class="form-control m-input datepicker" id="m_datepicker_4_2" name="follow_up_date" value="<?php echo isset($value['follow_up_date'])?$value['follow_up_date']:''; ?>" required>

                                                    <?php } else { ?>
                                                        <input type="text" class="form-control m-input datepicker" value="Select Date" id="m_datepicker_4_3" name="follow_up_date" style="visibility: hidden;" disabled>
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                            <label for="example-text-input" class="col-1 col-form-label" id="at_label" <?php if (!isset($value['follow_up_date']) || $value['follow_up_date'] == '01-Jan-1970') { ?> style="visibility: hidden;" <?php } ?>>at</label>
                                            <div class="col-2 new-activity">
                                                <div class="input-group date">
                                                    <?php
                                                     if(isset($value['follow_up_date']) && $value['follow_up_date'] != '01-Jan-1970' ) {
                                                    ?>
                                                    <input type="time" name="at" id="atUpdateOld" class="form-control m-input" value="<?php echo isset($value['at'])?$value['at']:''; ?>" >
                                                    <?php } else { ?>
                                                        <input type="time" name="at" id="atUpdatetwo" class="form-control m-input" style="visibility: hidden;" disabled>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                    <div id="leadOppUserCtTypeUId"> </div>

                                        <label for="example-text-input" class="col-2 col-form-label"><span style="color:red;">* </span>Activity Dates</label>
                                        <div class="col-3 new-activity">
                                            <div class="input-group date" id="dateCaleder">
                                                
                                                <?php
                                                 if(isset($value['activity_date']) ) {
                                                ?>
                                                    <input class="form-control m-input datepicker" id="datepickerUpdte" type="text" name="activity_date" value="<?php echo isset($value['activity_date'])?$value['activity_date']:''; ?>" required>

                                                <?php } else { ?>

                                                    <input class="form-control m-input datepicker" id="datepicker" type="text" name="activity_date" value="Select Date" required>

                                                <?php } ?>
                                               
                                            </div>
                                        </div>
                                        <div class="col-2 new-activity">
                                            <div class="input-group date">
                                                <input type="time"  name="activity_time_from" id="activity_time_fromUpdate" class="form-control m-input" value="<?php echo isset($value['activity_time_from'])?$value['activity_time_from']:''; ?>">
                                            </div>
                                        </div>
                                        <label for="example-text-input"  class="col-1 col-form-label">To</label>
                                        <div class="col-2 new-activity">
                                            <div class="input-group date">
                                                <input type="time" name="activity_time_to" id="activity_time_toUpdate" class="form-control m-input" value="<?php echo isset($value['activity_time_to'])?$value['activity_time_to']:''; ?>">
                                                <input type="hidden" name="leadOpportunityUpdateId" id="opp-create-update" class="form-control m-input" value="<?php echo isset($value['fk_lead_opportunity_id'])?$value['fk_lead_opportunity_id']:''; ?>">
                                                <input type="hidden" name="leadActivityUpdateId" id="snehal" class="form-control m-input" value="<?php echo isset($value['lead_activity_id'])?$value['lead_activity_id']:''; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <select class="form-control"  name="reminder" id="reminderUpdate" style="height: 30px !important">
                                                <option value="">Reminder</option>
                                                <option value="0" <?php if (isset($value['reminder']) && $value['reminder'] =='0') { echo "selected";}?> >None</option>
                                                <option value="5" <?php if (isset($value['reminder']) && $value['reminder'] =='5') { echo "selected";}?>>5 Mins Before</option>
                                                <option value="10" <?php if (isset($value['reminder']) && $value['reminder'] =='10') { echo "selected";}?>>10 Mins Before</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="border: 1px solid #ddd; width: 100%; margin-left: 15px; margin-right:15px"></div>
                                    </div>
                                    <div class="form-group m-form__group row m--margin-top-20">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="street_address"><span style="color:red;">* </span>Type</label>    
                                            <select class="form-control" name="activity_typeUpdate" id="activity_typeUpdate" style="height: 38px !important"onchnage='chackexist();' required>
                                                <option value="0"> -- Please Select --</option>
                                                <option value="Phone Call" <?php if (isset($value['activity_type']) && $value['activity_type'] =='Phone Call') { echo "selected";}?> >Phone Call</option>
                                                // <option value="Email" <?php if (isset($value['activity_type']) && $value['activity_type'] =='Email') { echo "selected";}?> >Email</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <label for="street_address"><span style="color:red;">* </span>Initiated By</label>    
                                            <select class="form-control" name="initiated_byUpdate" id="initiated_byUpdate" style="height: 38px !important" required>
                                                <option value="">-- Please Select --</option>
                                                <?php
                                                    if (isset($salesPerson)) {
                                                        foreach ($salesPerson as $Salesperson) { ?>
                                                        <option value="<?php echo $Salesperson['user_id'];?>" <?php if (isset($value['initiated_by']) && $value['initiated_by'] == $Salesperson['user_id']) { echo "selected";}?> > <?php echo $Salesperson['name'];?></option>
                                                            
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
                                                        <option value="<?php echo $Salesperson['user_id'];?>" <?php if (isset($value['assigned_by']) && $value['assigned_by'] == $Salesperson['user_id']) { echo "selected";}?> > <?php echo $Salesperson['name'];?></option>
                                                            
                                            <?php   } } else {
                                                ?>
                                                <option value="0">Other</option>
                                            <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" style="padding-left: 18px !important;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">  
                                            <div class="form-group m-form__group row">
                                                <label style="text-align: center !important"><b>Phone: </b><span id="attachPhone"><?php echo isset($value['phone'])?$value['phone']:'---'; ?></span> <b style="margin-left: 90px;">Email: </b><span id="attachEmail"><?php echo isset($value['email'])?$value['email']:'---'; ?></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="m-portlet" style="margin-top: 2.2rem; padding-top: 1rem; padding-bottom: 1rem">
                                        <div class="form-group m-form__group row m--margin-top-20">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="street_address">Address</label>    
                                                <textarea class="form-control m-input" name="address" id="addressUpdate" placeholder="" rows="6"><?php echo isset($value['address'])?$value['address']:''; ?></textarea>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" style="padding-top: 27px">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row m--margin-top-20">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="street_address">City</label>    
                                                <input type="text" name="city" id="cityUpdate" class="form-control m-input" value="<?php echo isset($value['city'])?$value['city']:''; ?>">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
                                                <label for="street_address">State</label>
                                                <input type="text" name="stateUpdate" id="stateUpdate" value="<?php echo isset($value['state'])?$value['state']:''; ?>" class="form-control m-input">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
                                                <label for="street_address">Zip</label>
                                                <input type="text" name="zipUpdate" id="zipUpdate" value="<?php echo isset($value['zip'])?$value['zip']:''; ?>" class="form-control m-input">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group m-form__group row m--margin-top-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="street_address">Description</label>    
                                            <textarea class="form-control m-input" name="description" id="descriptionUpdate" placeholder="" rows="6" style="height: 150px!important"><?php echo isset($value['description'])?$value['description']:''; ?></textarea>
                                        </div>
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
                    </div>
        </div>  

    <input type="hidden" name="userType" value="leadactivity">
    
</form>