<form action="<?php echo base_url().'leadactivity/update/leadactivity/'?>" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">

    <div class="modal-content" id="selectLeadOpp" style="display: block;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lead Activity Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="height: 250px; overflow-y: scroll;">
                <div class="form-group m-form__group row m--margin-top-20">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <select class="form-control m-select2" id="selecLeadOpportinuty" name="param" style="opacity: 1;">
                            <option value="">-- Select a Lead --</option>
                            <?php
                                foreach($getLead as $title) { ?>
                                    <option value="<?php echo $title['lead_opportunity_id'];?>"><?php echo $title['opportunity_title'];?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-content" id="addLeadActivity" style="display: none;">
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
                                                <i class="fa fa-phone-square" style="font-size: 2.1rem"></i>
                                            </div>
                                            <div class="col-md-2 col-sm-2">
                                                <div class="m-checkbox-inline">
                                                    <label class="m-checkbox">
                                                    <input type="checkbox" id="checkUpdateOld" onclick="checkUpdateBoxNew()"> Complete
                                                    <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <label for="example-text-input" class="col-2 col-form-label">Schedule Follow-up</label>
                                            <div class="col-3 new-activity">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control m-input" value="Select Date" id="m_datepicker_4_2" name="follow_up_date" disabled="disabled">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <label for="example-text-input" class="col-1 col-form-label">at</label>
                                            <div class="col-2 new-activity">
                                                <div class="input-group date">
                                                    <input type="text" name="at" id="atUpdateOld" class="form-control m-input" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Activity Dates</label>
                                        <div class="col-2 new-activity">
                                            <div class="input-group date">
                                                <input type="text" class="form-control m-input datepicker"  id="m_datepicker_4_5" name="activity_date">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1 new-activity">
                                            <div class="input-group date">
                                                <input type="text"  name="activity_time_from" id="activity_time_fromUpdate" class="form-control m-input">
                                            </div>
                                        </div>
                                        <label for="example-text-input"  class="col-1 col-form-label">to</label>
                                        <div class="col-1 new-activity">
                                            <div class="input-group date">
                                                <input type="text" name="activity_time_to" id="activity_time_toUpdate" class="form-control m-input">
                                            </div>
                                        </div>
                                        <label class="col-form-label col-lg-1 Col-md-1 col-12">reminder</label>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <select class="form-control"  name="reminder" id="reminderUpdate" style="height: 30px !important">
                                                <option value="">-- Please Select --</option>
                                                <option value="0">None</option>
                                                <option value="5">5 Mins Before</option>
                                                <option value="10">1- Mins Before</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="border: 1px solid #ddd; width: 100%; margin-left: 15px; margin-right:15px"></div>
                                    </div>
                                    <div class="form-group m-form__group row" style="padding-top:15px">
                                        <label class="col-form-label col-lg-2 Col-md-3 col-sm-12">Type</label>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <select class="form-control" name="activity_typeUpdate" id="activity_typeUpdate" style="height: 38px !important">
                                                <option value="Phone Call">Phone Call</option>
                                                <option value="Email">Email</option>
                                            </select>
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12" style="text-align: center !important">Phone</label>
                                        <div class="col-lg-5 col-md-9 col-sm-12">
                                            <label class="col-form-label">9807820970</label>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" style="padding-top:15px">
                                        <label class="col-form-label col-lg-2 Col-md-3 col-sm-12">Initiated By</label>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <select class="form-control" name="initiated_byUpdate" id="initiated_byUpdate" style="height: 38px !important">
                                                <option value="">-- Please Select --</option>
                                                <?php
                                                    if (isset($salesPerson)) {
                                                        foreach ($salesPerson as $Salesperson) { ?>
                                                            <option value="<?php echo $Salesperson['user_id'];?>"><?php echo $Salesperson['first_name']." ".$Salesperson['last_name'];?></option>
                                            <?php   }} else {
                                                ?>
                                                <option value="other">Other</option>
                                            <?php }?>
                                            </select>
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12" style="text-align: center !important">Cell:</label>
                                        <div class="col-lg-5 col-md-9 col-sm-12">
                                            <label class="col-form-label">9807820970</label>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row" style="padding-top:15px">
                                        <label class="col-form-label col-lg-2 Col-md-3 col-sm-12">Assigned To</label>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <select class="form-control" name="assigned_by" id="assigned_byUpdate" style="height: 38px !important">
                                                <option value="">-- Please Select --</option>
                                                <?php
                                                    if (isset($salesPerson)) {
                                                        foreach ($salesPerson as $Salesperson) { ?>
                                                            <option value="<?php echo $Salesperson['user_id'];?>"><?php echo $Salesperson['first_name']." ".$Salesperson['last_name'];?></option>
                                            <?php   }} else {
                                                ?>
                                                <option value="other">Other</option>
                                            <?php }?>
                                            </select>
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12" style="text-align: center !important">Email:</label>
                                        <div class="col-lg-5 col-md-9 col-sm-12">
                                            <label class="col-form-label">ahrar@hospitality.com</label>
                                        </div>
                                    </div>
                                    <div class="m-portlet" style="margin-top: 2.2rem; padding-top: 1rem; padding-bottom: 1rem">
                                        <div class="form-group m-form__group row m--margin-top-20">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="street_address">Address</label>    
                                                <textarea class="form-control m-input" name="address" id="addressUpdate" placeholder="" rows="6"></textarea>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12" style="padding-top: 27px">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row m--margin-top-20">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="street_address">City</label>    
                                                <input type="text" name="city" id="cityUpdate" class="form-control m-input">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
                                                <label for="street_address">State</label>
                                                <input type="text" name="stateUpdate" id="stateUpdate" class="form-control m-input">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
                                                <label for="street_address">Zip</label>
                                                <input type="text" name="zipUpdate" id="zipUpdate" class="form-control m-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row m--margin-top-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="street_address">Description</label>    
                                            <textarea class="form-control m-input" name="description" id="descriptionUpdate" placeholder="" rows="6" style="height: 150px!important"></textarea>
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
                                                                <button type="button" class="btn btn-secondary m-btn" style="font-family: sans-serif, Arial; margin-left: 20px">Add</button>
                                                                <button type="button" class="btn btn-secondary m-btn" style="font-family: sans-serif, Arial;">Save &amp; Create New Doc</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Subject:</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control" name="subject">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Body</label>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 new-activity">
                                                            <div class="summernote" id="m_summernote_1"></div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_portlet_base_demo_10_tab_content" role="tabpanel">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                                </div>
                            </div>      
                        </div>
                    </div>
        </div>  

    <input type="hidden" name="userType" value="leadactivity">
    
</form>