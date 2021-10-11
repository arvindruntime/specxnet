<?php
$value = $Contact[0];

$newval = explode(',', $value['user_info']);
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
<form enctype="multipart/form-data" method="post" class="m-form m-form--fit m-form--label-align-right" id="sendEmail">
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
            
            <div class="">
                <div class="">
                    <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >
                            <div class="tab-pane margin-top2" id="m_portlet_base_demo_9_tab_content" role="tabpanel">
                                <div class="col-md-12">
                                    <div class="inbox-body">
                                        <div class="inbox-content" style="">
                    
                                                <div class="form-group">
                                                    <label class="control-label">To:</label>
                                                    <div class="controls">
                                                        <label name='toEmail' id="toEmail"><input type="text" class="form-control" name="to" value="<?php echo !empty($emailId)?implode(',', $emailId):''; ?>" readonly></label>
                                                        <input type="hidden" name="to" id="to" value="<?php echo !empty($emailId)?implode(',', $emailId):''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Subject:</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="subject" id="subject" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Attachment:</label>
                                                    <div class="controls">
                                                        <input type="file" name="activity_mail" id="activity_mail"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Message:</label>
                                                    <div class="controls">
                                                        <textarea class="form-control" name="message" id="messagebox" style="height: 75px !important;" required></textarea> 
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <div class="form-group m-form__group row m--margin-top-20" style="padding-left: 0px !important;">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="user_type"></div>
                                                <input type="hidden" name="fk_lead_opportunity_id" id="fk_lead_opportunity_id" value="<?php echo $fk_lead_opportunity_id;?>">
                                                <input type="hidden" name="lead_activity_id" id="lead_activity_id" value="<?php echo $activity_id;?>">
                                                <button type="submit" class="btn btn-primary m-btn" id="sendEmail" style="font-family: sans-serif, Arial;">Send Email</button>
                                                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                    </div>
                </div>
        </div>  
    
</form>