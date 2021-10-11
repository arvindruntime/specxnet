<?php

//$companyCountry = $value['companycountry'].'-'.str_replace('+', '', $value['dialing_code']);

?>

<div class="modal-content">

    <div class="modal-body modal__scroll">

        <div class="m-portlet m-portlet--tabs">

            <div class="m-portlet__head">

                <div class="m-portlet__head-tools">

                    <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">

                        <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_portlet_base_demo_11_tab_content" role="tab" aria-selected="true">

                            Overview 

                            </a>

                        </li>

                        <?php

                        //if ($userType == 'internal') {

                        ?>

                        <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_12_tab_content" onclick="getRolePermissions(<?php echo isset($value['user_id'])?$value['user_id']:''; ?>)" role="tab" aria-selected="false">

                            Permissions

                            </a>

                        </li>

                        <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_13_tab_content" onclick="getRoleNotifications(<?php echo isset($value['user_id'])?$value['user_id']:''; ?>)" role="tab" aria-selected="false">

                            Notification

                            </a>

                        </li>

                        <?php //}

                            if ($userType != 'customer') {

                        ?>

                        <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_14_tab_content" onclick="getJobList(<?php echo isset($value['user_id'])?$value['user_id']:''; ?>)" role="tab" aria-selected="false">

                            Job Access

                            </a>

                        </li>

                    <?php } ?>

                        <!-- <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_15_tab_content" role="tab" aria-selected="false">

                            Preferences

                            </a>

                        </li> -->

                    </ul>

                </div>

            </div>

            <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >

                <form action="<?php echo base_url().'user/create/user/'.$userId; ?>" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">

                    <div class="tab-content">

                        <div id="validation_errors_delete"></div><div id="validation_errors" style="margin-bottom: 11px;"></div>

                        <div class="tab-pane active show" id="m_portlet_base_demo_11_tab_content" role="tabpanel">

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address"><span style="color:red;">* </span>First Name</label>

                                    <input type="text" name="first_name" id="UsrFName" class="form-control m-input" value="<?php echo isset($value['first_name'])?$value['first_name']:''; ?>" required>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address">Last Name</label>

                                    <input type="text" name="last_name" id="UsrLName" class="form-control m-input" value="<?php echo isset($value['last_name'])?$value['last_name']:''; ?>">

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address">Designation</label>

                                    <input type="text" name="designation" id="UsrDesi" class="form-control m-input" value="<?php echo isset($value['designation'])?$value['designation']:''; ?>">

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3" >

                            

                            <?php

                                if ($userType == 'internal' ) {

                            ?>

                            <div class="col-lg-3 col-md-3 col-sm-12" id="getNewRole">

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

                        <?php } else if ($userType== "supplier") {?>

                            <input type="hidden" name="user_role_id" value="182">

                        <?php } else {?>

                            <input type="hidden" name="user_role_id" value="181">

                        <?php }?>



                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">Department

                                    <!-- <a style="margin-left: 16px; color: blue; cursor: pointer;" id="addDept">Add Department ?</a> -->

                                </label>

                                <div id="setDepartment">

                                    <!-- <select class="form-control" id="fk_department_id" style="height: 30px !important" name="fk_department_id">

                                        <option data-tokens="Menu1" value="">--Select Department--</option>

                                        <?php

                                            foreach ($department as $department) {

                                            ?>

                                        <option value="<?php echo $department['department_id'];?>" <?php if (isset($value['fk_department_id']) && $department['department_id'] == $value['fk_department_id']) { echo "selected";}?> ><?php echo ucwords($department['department_name']);?></option>

                                        <?php

                                            }?>

                                    </select> -->

                                    <input type="text" list="datalist2" class="form-control m-input" placeholder="Add Department" name="fk_department_id"  value="<?php echo isset($value['department_name'])?$value['department_name']:''; ?>">

                                </div>

                                <input type="hidden" id="deptId" value="addNew"/>

                            </div>



                            <?php

                                // if ($userType != 'customer') {

                            ?>

                                <div class="col-lg-2 col-md-2 col-sm-12"  style="margin-top: 31px;">

                                    <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand invite_user">

                                    <input type="checkbox" name="invite_user"> Invite User

                                    <span></span>

                                    </label>

                                </div>

                            <?php //}?>



                            <div class="col-lg-4 col-md-4 col-sm-12 form-group m-form__group row oactive_user"  style="margin-top: 18px;">

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

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <label for="street_address"><span style="color:red;">* </span>Company</label>

                                <input type="text" list="datalist" class="form-control m-input" placeholder="Select Company" name="user_comp_id"  value="<?php echo isset($value['company_name'])?$value['company_name']:''; ?>" onchange="selectCompany(this.value, '<?php echo $userType; ?>')">

                                <input type="hidden" name="company_id" id="company_id" value="<?php echo isset($value['company_id'])?$value['company_id']:''; ?>">

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <label for="parent_comp">Parent Company</label>



                                <input type="text" list="datalist3" id="parent_comp" class="form-control m-input" placeholder="Select Parent Company" name="parent_company_name" value="<?php echo isset($value['parentCompany'])?$value['parentCompany']:''; ?>" onchange="selectParentCompany(this.value, '<?php echo $userType; ?>')">

                                <input type="hidden" name="parent_company_id" id="parent_company" value="<?php echo isset($value['parentCompanyId'])?$value['parentCompanyId']:''; ?>">

                            </div>



                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <label for="fk_industry_name">Industry</label>



                                <input type="text" list="datalist4" class="form-control m-input" placeholder="Select Industry" name="fk_industry_name" id="fk_industry_name" onchange="selectIndustry(this.value, '<?php echo $userType; ?>')" value="<?php echo isset($value['industry_name'])?$value['industry_name']:''; ?>">

                                <input type="hidden" name="fk_industry_id" id="fk_industry_id" value="<?php echo isset($value['industry_id'])?$value['industry_id']:''; ?>">

                            </div>

                            

                        </div>

                        <div class="form-group m-form__group row m--margin-top-20 padtop3">

                            <div class="col-md-6 col-sm-6 col-6">

                                <h5 class="modal-title padtop5">Company Address & Contact</h5>

                            </div>

                            <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

                        </div>

                        <div class="form-group m-form__group row m--margin-top-20 padtop3">

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">Street Address</label>

                                <input type="text" name="company_street_address" id="companyAdd" class="form-control m-input" value="<?php echo isset($value['companyAddress'])?$value['companyAddress']:''; ?>">

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">Zip</label>

                                <input type="number" name="company_pincode" id="companyPin" class="form-control m-input" value="<?php echo isset($value['companyzip'])?$value['companyzip']:''; ?>">

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address"><span style="color:red;">* </span>City</label>

                                <input type="text" name="company_city" id="companyCity" class="form-control m-input" value="<?php echo isset($value['companycity'])?$value['companycity']:''; ?>" required>

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">State</label>

                                <input type="text" name="company_state" id="companyState" class="form-control m-input" value="<?php echo isset($value['companystate'])?$value['companystate']:''; ?>">

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">

                                <label for="state"><span style="color: red">* </span>Country</label>

                                <select class="form-control countryCode" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="company_country" id="companyCountry" onchange="getCountryCodeForUsers(this.value)" required>

                                    <option>--Select Country--</option>

                                    <?php

                                    if (isset($value['companycountry'])) {

                                        $value['company_country'] = $value['companycountry'].'-'.str_replace('+', '', $value['dialing_code']);

                                    }

                                        foreach ($country as $showCountry) {

                                        ?>

                                    <option value="<?php echo $showCountry['nicename']."-".$showCountry['phonecode'];?>" <?php echo (isset($value['companycountry']) && $value['companycountry']==$showCountry['nicename'])?'selected':''; ?> ><?php echo $showCountry['nicename']." (+".$showCountry['phonecode'].")";?></option>

                                    <?php

                                        }?>

                                </select>

                                <input type="hidden" name="dialing_code" id="dialing_code" value="<?php echo isset($value['dialing_code'])?$value['dialing_code']:''; ?>">

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3">

                                <label for="bussiness_contact"><span style="color: red">* </span>Business Phone</label>

                                <!-- <input type="text" name="company_bussiness_contact" id="company_bussiness_contact" class="form-control m-input" value="<?php echo isset($value['bussiness_contact'])?$value['dialing_code'].' - '.$value['bussiness_contact']:''; ?>" required> -->

                                <div class="input-group m-input-group">

                                    <div class="input-group-prepend" style="height: 30px"><span class="input-group-text" id="dialing_code_append"><?php echo isset($value['dialing_code'])?$value['dialing_code']:''; ?></span></div>

                                    <input type="text" name="company_bussiness_contact" id="company_bussiness_contact" class="form-control m-input" value="<?php echo isset($value['bussiness_contact'])?$value['bussiness_contact']:''; ?>" required>

                                </div>

                            </div>

                        </div>

                        <div class="form-group m-form__group row m--margin-top-20 padtop3">

                            <div class="col-md-6 col-sm-6 col-6">

                                <h5 class="modal-title padtop5">Users Address</h5>

                            </div>

                            <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

                        </div>

                        <div class="form-group m-form__group row m--margin-top-20 padtop3">

                            <div class="col-md-6 col-sm-6 col-6">

                                <input type="checkbox" id="sameCompanyAdd"> Check if user address is same as company address

                            </div>

                        </div>

                        <div class="form-group m-form__group row m--margin-top-20 padtop3">

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">Street Address</label>

                                <input type="text" name="street_address" id="UsrAdd" class="form-control m-input" value="<?php echo isset($value['street_address'])?$value['street_address']:''; ?>">

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">Zip</label>

                                <input type="number" name="pincode" id="UsrPin" class="form-control m-input" value="<?php echo isset($value['pincode'])?$value['pincode']:''; ?>">

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address"><span style="color:red;">* </span>City</label>

                                <input type="text" name="city" id="UsrCity" class="form-control m-input" value="<?php echo isset($value['city'])?$value['city']:''; ?>" required>

                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">

                                <label for="street_address">State</label>

                                <input type="text" name="state" id="UsrState" class="form-control m-input" value="<?php echo isset($value['state'])?$value['state']:''; ?>">

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

                                                <option value="Mobile" <?php if ($ContactInfo['contact_type'] == "Mobile") {
                                                                                            echo "selected";
                                                                                        } ?>>Mobile</option>
                                            </select>

                                        </div>

                                        <div class="col-lg-2 col-md-2">

                                            <span class="input-group-btn">

                                            <button type="button" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>" class="btn-sm btn m-btn--icon m-btn--pill btn-danger btn-remove delete_top2">

                                            

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

                                <option value="Mobile" <?php if (isset($Contact[0]['contact_type']) && $Contact[0]['contact_type'] =="Mobile") {
                                                                                            echo "selected";
                                                                                        } ?>>Mobile</option>
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

                        <?php } ?>



                        <input type="hidden" name="userType" value="<?php echo $userType; ?>">

                        </div>



<!-- --------------------------------------Permissions------------------------------------------------------------------- -->

                        <div class="tab-pane" id="m_portlet_base_demo_12_tab_content" role="tabpanel">

                            <div class="m-accordion__item">

                                <div id="permissionMsg" style="margin-left: 26px;"></div>

                           </div>

                        </div>



<!-- --------------------------------------Notifications------------------------------------------------------------------- -->

                        <div class="tab-pane" id="m_portlet_base_demo_13_tab_content" role="tabpanel">

                           <div id="notificationMsg" style="margin-left: 26px;"></div>

                        </div>



<!-- --------------------------------------Job Access------------------------------------------------------------------- -->

                        <div class="tab-pane" id="m_portlet_base_demo_14_tab_content" role="tabpanel">

                            

                        </div>





<!-- --------------------------------------Preferences------------------------------------------------------------------- -->

                        <div class="tab-pane" id="m_portlet_base_demo_15_tab_content" role="tabpanel">

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-8 col-md-8 col-sm-12">

                                    <label for="street_address">Message Signature</label>

                                    <textarea class="form-control m-input" name="message_signature" style="height: 100px !important;"><?php echo isset($preferences[0]['message_signature'])?$preferences[0]['message_signature']:''; ?></textarea>

                                </div>

                                <?php

                                if (isset($preferences[0]['file'])) {

                                ?>

                                <div class="col-lg-8 col-md-8 col-sm-12" style="margin-top: 15px;margin-bottom: 15px;">

                                    <label for="street_address">Signature Image: </label>

                                    <img src="<?php echo base_url().'upload/'.$preferences[0]['file']?>">

                                </div>

                            <?php }?>

                                <div class="col-lg-8 col-md-8 col-sm-12">

                                    <label for="street_address">Message Signature Image</label>

                                    <input type="file" name="message_signature_image" id="signature_iamge" class="form-control m-input">

                                </div>

                            </div>



                        </div>

                        <!-- Company List For Auto Complete -->

                        <datalist id="datalist"> 

                            <?php

                                foreach ($companyListDropdown as $key => $value) {

                            ?>

                            <option value="<?php echo $value['company_name'];?>"></option>

                            <?php }?>

                          

                        <!-- This data list will be edited through javascript     -->

                        </datalist>



                        <datalist id="datalist2"> 

                            <?php

                                foreach ($departmentNames as $key2 => $value2) {

                            ?>

                            <option value="<?php echo $value2['department_name'];?>"></option>

                            <?php }?>



                        </datalist>



                        <datalist id="datalist3"> 

                            <?php

                                foreach ($parentCompany as $key2 => $value2) {

                            ?>

                            <option value="<?php echo $value2['company_name'];?>"></option>

                            <?php }?>



                        </datalist>



                        <datalist id="datalist4"> 

                        <?php

                            foreach ($industryNames as $key => $value) {

                        ?>

                        <option value="<?php echo $value['industry_name'];?>"><?php echo $value['industry_name'];?></option>

                        <?php }?>

                          

                        <!-- This data list will be edited through javascript     -->

                        </datalist>



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

                </form>

            </div>

        </div>

    </div>

</div>