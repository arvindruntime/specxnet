<div class="m-portlet m-portlet--tabs">   
    <div class="m-portlet__head">
        <div class="m-portlet__head-tools">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#overview<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tab" aria-selected="false">
                    Overview 
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#permissionsIn<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" onclick="getRolePermissions(<?php echo isset($value['user_id'])?$value['user_id']:''; ?>)" role="tab" aria-selected="true">
                    Permissions
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#notifications<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" onclick="getRoleNotifications(<?php echo isset($value['user_id'])?$value['user_id']:''; ?>)" role="tab" aria-selected="true">
                    Notifications
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#job_access<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tab" aria-selected="true">
                    Job Access
                    </a>
                </li>
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#preferences<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tab" aria-selected="true">
                    Preferences
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body margin-top2" style="">
        <form action="<?php echo base_url().'user/create/user/'.$userId; ?>" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
        <div class="tab-content">
                <div id="validation_errors_delete"></div>
                <div class="tab-pane active show" id="overview<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                     <div id="validation_errors"></div>
                        
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <label for="street_address"><span style="color:red;">* </span>First Name</label>
                                    <input type="text" name="first_name" id="UsrFName" class="form-control m-input" value="<?php echo isset($value['first_name'])?$value['first_name']:''; ?>" required>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <label for="street_address"><span style="color:red;">* </span>Last Name</label>
                                    <input type="text" name="last_name" id="UsrLName" class="form-control m-input" value="<?php echo isset($value['last_name'])?$value['last_name']:''; ?>" required>
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20 padtop3" >
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <label for="street_address"><span style="color:red;">* </span>Designation</label>
                                    <input type="text" name="designation" id="UsrDesi" class="form-control m-input" value="<?php echo isset($value['designation'])?$value['designation']:''; ?>" required>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12" id="getNewRole">
                                    <label for="street_address"><span style="color:red;">* </span>Role</label>
                                    <div id="newrolereceived">
                                        <select class="form-control" id="LeadusrRole" style="height: 30px !important" name="user_role_id" required>
                                            
                                            <?php if(isset($userType) && $userType == "internal") {  ?>
                                                <option data-tokens="Menu1" value="">--Select Role--</option>
                                                    <?php
                                                        foreach ($roles as $fkRole) {
                                                        ?>
                                                    <option value="<?php echo $fkRole['role_id'];?>" <?php if (isset($value['fk_role_id']) && $fkRole['role_id'] == $value['fk_role_id']) { echo "selected";}?> ><?php echo ucwords($fkRole['role_name']);?></option>
                                                    <?php
                                                        }?>
                                                <?php
                                                }?>

                                                <?php if(isset($userType) && $userType== "supplier") { ?>
                                                    <option value="182" selected> Supplier</option>
                                                 <?php } ?>

                                                 <?php if(isset($userType) && $userType== "customer") { ?>
                                                    <option value="181" selected> Customer</option>
                                                 <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <label for="street_address"><span style="color:red;">* </span>Company</label>
                                    <!-- <input type="text" name="user_company" class="form-control m-input" required> -->
                                    <select class="form-control" id="usrComp" style="height: 30px !important" name="user_comp_id" required>
                                        <option data-tokens="Menu1" value="">--Select Company--</option>
                                        <?php
                                            foreach ($company as $fkComp) {
                                            ?>
                                        <option value="<?php echo $fkComp['company_id'];?>" <?php if (isset($value['fk_company_id']) && $fkComp['company_id'] == $value['fk_company_id']) { echo "selected";}?> ><?php echo ucwords($fkComp['company_name']);?></option>
                                        <?php
                                            }?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand invite_user">
                                    <input type="checkbox" name="invite_user"> Invite User
                                    <span></span>
                                    </label>
                                </div>
                                <div class="col-lg-5 col-md-4 col-sm-12 form-group m-form__group row oactive_user" >
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon">
                                        <label>
                                        <?php if (isset($value['active_status']) && $value['active_status'] == 'inactive') { ?>
                                            <input type="checkbox"  name="active_user" id="UsrActi" value="inactive">
                                        <?php
                                        } else { ?>
                                            <input type="checkbox" checked="checked" name="active_user" id="UsrActi" value="active">
                                        <?php
                                        }?>
                                        <span></span>
                                        </label>
                                        </span>
                                    </div>
                                    <label class="col-5 col-form-label">Active User</label>
                                </div>
                            </div>
                            
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="street_address">Street Address</label>
                                    <input type="text" name="street_address" id="UsrAdd" class="form-control m-input" value="<?php echo isset($value['street_address'])?$value['street_address']:''; ?>">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="street_address"><span style="color:red;">* </span>City</label>
                                    <input type="text" name="city" id="UsrCity" class="form-control m-input" value="<?php echo isset($value['city'])?$value['city']:''; ?>" required>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="street_address">State</label>
                                    <input type="text" name="state" id="UsrState" class="form-control m-input" value="<?php echo isset($value['state'])?$value['state']:''; ?>">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="street_address">Pincode</label>
                                    <input type="number" name="pincode" id="UsrPin" class="form-control m-input" value="<?php echo isset($value['pincode'])?$value['pincode']:''; ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label for="state"><span style="color: red">* </span>Country</label>
                                    <select class="form-control countryCode" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="country" id="add_country" onchange="getCountryCode(this.value)" required>
                                        <option data-tokens="Menu1">--Select Country--</option>
                                        <?php
                                            foreach ($country as $showCountry) {
                                            ?>
                                        <option value="<?php echo $showCountry['nicename']."-".$showCountry['phonecode'];?>" <?php echo (isset($value['country']) && ucfirst($value['country'])==$showCountry['nicename'])?'selected':''; ?> ><?php echo $showCountry['nicename']." (+".$showCountry['phonecode'].")";?></option>
                                        <?php
                                            }?>
                                    </select>
                                </div>
                            </div> 
                             <?php
                                // if(isset($value['ContactInfo']) || isset($Contact) && !empty($Contact) && count($Contact) > 1) { 
                                if(isset($value['ContactInfo']) || isset($Contact) && !empty($Contact)) { 
                            ?>
                            
                            <div id="myRepeatingFieldsUpdate">
                                <div class="form-group  m-form__group row" style="padding-left:15px">
                                    <div class="entry input-group form-group  m-form__group row">
                                        <?php 
                                        $i=0;
                                        foreach ($Contact as $ContactInfo) { $length = count($Contact);?> 
                                        <div class="entry-row entry input-group form-group  m-form__group row" id="oldData"> 
                                            <input type="hidden" name="userConactId[]" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>">
                                            <div class=" col-lg-4 col-md-4 col-sm-12">
                                                <label for="street_address"><span style="color:red;">* </span>Contact Details</label>
                                                <input type="text" id="conatctInfoU" name="contact_detail[]" value="<?php echo isset($ContactInfo['contact_info'])?$ContactInfo['contact_info']:''; ?>" class="form-control m-input pages_titleDetails">
                                            </div>
                                            <div class=" col-lg-4 col-md-4 col-sm-12">
                                                <label for="street_address"><span style="color:red;">* </span>Contact Type</label>
                                                <select id="conatctTypeUsr" name="contact_type[]" class="form-control m-input pages_titleType" style="height: 30px !important">
                                                    <option value="Email" <?php if ($ContactInfo['contact_type'] =="Email") { echo "selected";}?> >Email</option>
                                                    <option value="Phone" <?php if ($ContactInfo['contact_type'] =="Phone") { echo "selected";}?> >Phone</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <span class="input-group-btn">
                                                <button type="button" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>" class="btn-sm btn m-btn--icon m-btn--pill btn-danger btn-remove delete_top2">
                                                <!-- <span> <i class="la la-plus"></i> <span>Add</span> </span> -->
                                                <span><i class="la la-trash-o btn-danger btn-remove"></i><span>Delete</span></span>
                                                </button>
                                                </span>
                                            </div>
                                        </div>
                                    <?php $i++; } ?>
                                    <div id="newClondedContact" style="width: 100%;">
                                        
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                            <span class="input-group-btn">
                                            <button type="button" class="btn-sm btn m-btn--icon m-btn--pill btn-success btn-update">
                                            <span> <i class="la la-plus"></i> <span>Add</span> </span>
                                            <!-- <span><i class="la la-trash-o btn-danger"></i><span>Delete</span></span> -->
                                            </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php } else { ?> 

                            <div class="form-group  m-form__group row">
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="street_address"><strong><span style="color:red;">* </span>Contact Details</strong></label>
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="street_address"><strong><span style="color:red;">* </span>Contact Type</strong></label>
                                </div>
                            </div>
                            <div id="myRepeatingFields">
                                <input type="hidden" name="userConactId[]" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>">
                                                  <div class="entry input-group form-group  m-form__group row">
                                                  <div class=" col-lg-4 col-md-4 col-sm-12">
                                                  <input type="text" name="contact_detail[]" class="form-control m-input" value="<?php echo isset($Contact[0]['contact_info'])?$Contact[0]['contact_info']:''; ?>">
                                                  </div>
                                                  <div class=" col-lg-4 col-md-4 col-sm-12">
                                                    <select id="conatctTypeUsr" name="contact_type[]" class="form-control m-input pages_titleType" style="height: 30px !important">
                                                    <option value="Email" <?php if (isset($Contact[0]['contact_type']) && $Contact[0]['contact_type'] =="Email") { echo "selected";}?> >Email</option>
                                                    <option value="Phone" <?php if (isset($Contact[0]['contact_type']) && $Contact[0]['contact_type'] =="Phone") { echo "selected";}?> >Phone</option>
                                                </select>
                                                </div>
                                                </div> 
                                                <div id="cloneThisCt"> </div>                 
                                                 
                                             </div> 
                                             <div class="row form-group  m-form__group">
                                                      <div class="col-lg-2 col-md-2">
                                                             <span class="input-group-btn">
                                                                        <button type="button" id="usrContactAdd" class="btn-sm btn m-btn--icon btn-success btn-add">
                                                                            <span> <i class="la la-plus"></i> <span>Add</span> </span>

                                                                        </button>
                                                             </span>
                                                     </div> 
                                            </div> 
                                 
                                </div>

                                    <?php } ?>

                            <input type="hidden" name="userType" value="<?php echo $userType; ?>">
                            
                        
                </div>
<!-- --------------------------------------Permissions------------------------------------------------------------------- -->
                <div class="tab-pane" id="permissionsIn<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                    <div class="m-accordion__item">
                        <div id="permissionMsg"></div>
                   </div>
                </div>
<!-- --------------------------------------Notifications------------------------------------------------------------------- -->
                <div class="tab-pane" id="notifications<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                   <div id="notificationMsg"></div>
                </div>
<!-- --------------------------------------Job Access------------------------------------------------------------------- -->
                <div class="tab-pane" id="job_access<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                    
                </div>

<!-- --------------------------------------Preferences------------------------------------------------------------------- -->
                <div class="tab-pane" id="preferences<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                    <div class="form-group m-form__group row m--margin-top-20 padtop3">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <label for="street_address">Message Signature</label>
                            <textarea class="form-control m-input" name="message_signature" style="height: 100px !important;"><?php echo isset($preferences[0]['message_signature'])?$preferences[0]['message_signature']:''; ?></textarea>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <label for="street_address">Message Signature Image</label>
                            <input type="file" name="message_signature_image" id="signature_iamge" class="form-control m-input">
                        </div>
                    </div>

                </div>
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
        </div>
    </div>
    </form>
</div>
