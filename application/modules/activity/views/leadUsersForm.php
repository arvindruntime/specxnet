<form action="<?php echo base_url().'leadopportunity/create/leadopportunity/'.$userId; ?>" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">

    <div id="selectExistingCustomer">
        <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >
            <div class="tab-content">
                <div class="tab-pane active show" id="m_portlet_base_demo_11_tab_content" role="tabpanel">
                    <div class="form-group m-form__group row m--margin-top-20 padtop3">
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="street_address">First Name</label>
                            <input type="text" name="Leadfirst_name" id="LeadUsrFName" class="form-control m-input" required>
                            <input type="hidden" name="getUsrID" id="userID" value="0">
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="street_address">Last Name</label>
                            <input type="text" name="Leadlast_name" id="LeadUsrLName" class="form-control m-input" required>
                        </div>
                    </div>
                    <div class="form-group m-form__group row m--margin-top-20 padtop3" >
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="street_address">Designation</label>
                            <input type="text" name="Leaddesignation" id="LeadUsrDesi" class="form-control m-input" required>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="street_address">Company</label>
                            <!-- <input type="text" name="user_company" class="form-control m-input" required> -->
                            <select class="form-control" id="LeadusrComp" style="height: 30px !important" name="Leaduser_comp_id">
                                <?php
                                    foreach ($userCompany as $fkComp) {
                                    ?>
                                <option value="<?php echo $fkComp['company_id'];?>"><?php echo ucwords($fkComp['company_name']);?></option>
                                <?php
                                    }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group m-form__group row m--margin-top-20 padtop3">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="street_address">Street Address</label>
                            <input type="text" name="Leadstreet_address" id="LeadUsrAdd" class="form-control m-input" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="street_address">City</label>
                            <input type="text" name="Leadcity" id="LeadUsrCity" class="form-control m-input" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="street_address">State</label>
                            <input type="text" name="Leadstate" id="LeadUsrState" class="form-control m-input" required>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <label for="street_address">Pincode</label>
                            <input type="number" name="Leadpincode" id="LeadUsrPin" class="form-control m-input" required>
                        </div>
                    </div>
                    <div id="myRepeatingLeadContact">
                        <div class="form-group  m-form__group row" style="padding-left:15px">
                            <div class="entry input-group form-group  m-form__group row">
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="street_address">Contact Details</label>
                                    <input type="text" name="contact_detail[]" id="Leadm_contact_detail" class="form-control m-input">
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="street_address">Contact Type</label>
                                    <select class="form-control" id="Leadm_contact_type" name="contact_type[]" style="height: 30px !important">
                                        <option value="Email">Email</option>
                                        <option value="Phone">Phone</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn-sm btn m-btn--icon m-btn--pill btn-success btn-add delete_top2">
                                    <span> <i class="la la-plus"></i> <span>Add</span> </span>
                                    </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xs-12" style="height:50px;"></div>                              
                </div>
            </div>
        </div>
   </div>
    <input type="hidden" name="userType" value="leadopportunity">
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
</form>