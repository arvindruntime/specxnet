
    <div class="m-portlet__body margin-top2" style="">
        <form action="<?php echo base_url().'user/create/user/'.$userId; ?>" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                   <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_portlet_base_demo_11_tab_content" role="tab" aria-selected="true">
                                   Overview 
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" onclick="getRolePermissions()" href="#m_portlet_base_demo_12_tab_content" role="tab" aria-selected="false">
                                    Permissions
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" onclick="getRoleNotifications()" href="#m_portlet_base_demo_13_tab_content" role="tab" aria-selected="false">
                                   Notification
                                </a>
                            </li>
                             <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_14_tab_content" role="tab" aria-selected="false">
                                   Job Access
                                </a>
                            </li>
                             <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_15_tab_content" role="tab" aria-selected="false">
                                     Preferences
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >                   
                    <div class="tab-content">
                        <div class="tab-pane active show" id="m_portlet_base_demo_11_tab_content<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                            <div id="validation_errors_delete"></div>
                            <!-- <div class="tab-pane active show" id="overview<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel"> -->
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
                                             
                                            <!-- </div> -->

                                                <?php } ?>

                                        <input type="hidden" name="userType" value="<?php echo $userType; ?>">
                        </div>
                        
                        <div class="tab-pane" id="m_portlet_base_demo_12_tab_content<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                            <div class="m-accordion__item">
                                <div id="permissionMsg"></div>
                           </div>
                        </div>
                        <div class="tab-pane" id="m_portlet_base_demo_13_tab_content<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                            <div id="notificationMsg">
                                
                            </div>
                        </div>
                
                        <div class="tab-pane" id="m_portlet_base_demo_14_tab_content<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-lg-5 col-md-6 col-sm-12">
                                    <h5 class="modal-title padtop5 new-activity" id=""><strong>Job Access</strong></h5>
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-1" style="padding-top:13px">
                                    <span class="m-switch m-switch--icon">
                                    <label>
                                    <input type="checkbox" checked="checked" name="">
                                    <span></span>
                                    </label>
                                    </span>
                                </div>
                                <label class="col-md-5 col-11 col-form-label" style="padding-top:22px">Grant this user automatic access to new jobs</label>
                            </div>
                            <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_8" role="tablist">
                                <!--begin::Item-->              
                                <div class="m-accordion__item" style="background: #ffffff !important; padding-left:20px">
                                    <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_8_head" data-toggle="collapse" href="#m_accordion_7_item_8_body" aria-expanded="false" style="background: #FFF">
                                        <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>
                                        <span class="m-accordion__item-title">Filter Your Results</span>
                                        <span class="m-accordion__item-mode"></span>     
                                    </div>
                                    <div class="m-accordion__item-body collapse" id="m_accordion_7_item_8_body" role="tabpanel" aria-labelledby="m_accordion_7_item_8_head" data-parent="#m_accordion_8" style="">
                                        <div class="m-accordion__item-content">
                                            <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <label class="form-control-label">Job Name</label>
                                                    <input type="text" name="billing_card_name" class="form-control m-input" placeholder="" value="">
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <div class="m-portlet__nav-item">
                                                        <label class="form-control-label">Status</label>
                                                        <div>
                                                            <select class="form-control greyborder" name="">
                                                                <option value="Checked Action" selected="">Open Jobs</option>
                                                                <option value="fluid">Menu 1</option>
                                                                <option value="boxed">Menu 2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-4">
                                                    <label class="form-control-label">Groups</label>
                                                    <div>
                                                        <select class="form-control greyborder" name="">
                                                            <option value="Checked Action" selected="">--All Items Selected--</option>
                                                            <option value="fluid">Menu 1</option>
                                                            <option value="boxed">Menu 2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding:0 2rem">
                                                <div class="">
                                                    <button type="reset" class="btn btn-primary" style="sans-serif,Arial">Update Results</button>
                                                    <button type="reset" class="btn  m-btn btn-black m-btn--custom grey" style="sans-serif,Arial">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Item--> 
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="table-responsive" style="padding-left: 15px">
                                    <table class="table">
                                        <thead class="thead-light tableth">
                                            <tr>
                                                <th class="tableth"><strong>Job Name</strong></th>
                                                <th class="tableth"><strong>Status</strong></th>
                                                <th class="tableth"><strong>Group</strong></th>
                                                <th class="tableth"><strong>Created on</strong></th>
                                                <th class="tableth"><strong>Access</strong></th>
                                                <th class="tableth"><strong>Notification</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>New Opportunity</td>
                                                <td>Open</td>
                                                <td>--</td>
                                                <td>09-05-2019</td>
                                                <td>
                                                    <div class="m-switch m-switch--icon">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="">
                                                        <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-switch m-switch--icon">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="">
                                                        <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>New Opportunity</td>
                                                <td>Open</td>
                                                <td>--</td>
                                                <td>09-05-2019</td>
                                                <td>
                                                    <div class="m-switch m-switch--icon">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="">
                                                        <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="m-switch m-switch--icon">
                                                        <label>
                                                        <input type="checkbox" checked="checked" name="">
                                                        <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
                        <div class="tab-pane" id="m_portlet_base_demo_15_tab_content<?php echo isset($value['user_id'])?$value['user_id']:''; ?>" role="tabpanel">
                            <div class="form-group m-form__group row m--margin-top-20 padtop3">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label for="street_address">Message Signature</label>
                                    <textarea class="form-control m-input" name="message_signature" style="height: 100px !important;"></textarea>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label for="street_address">Message Signature Image</label>
                                    <input type="file" name="message_signature_image" id="signature_iamge" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
        </form>
    </div>
