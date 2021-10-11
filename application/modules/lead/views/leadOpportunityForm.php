<?php

function getVisIpAddr() {



    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        return $_SERVER['HTTP_CLIENT_IP'];

    }

    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    }

    else {

        return $_SERVER['REMOTE_ADDR'];

    }

}

$vis_ip = getVisIPAddr();

$ip = $vis_ip;



// Use JSON encoded string and converts

// it into a PHP variable

$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

$timezone=$ipdat->geoplugin_timezone;

?>

<form action="<?php echo base_url().'lead/create/leadopportunity/'.$userId;?>" method="post" id="feedInput2222" class="m-form m-form--fit m-form--label-align-right">

    <div class="form-group m-form__group row m--margin-top-20 padtop3" <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id'] !='') { ?>style="display: none;" <?php } ?>>

        <div class="col-md-6 col-sm-6 col-12 mob-no-pad">

            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand" style="padding-top: 5px;">

            <input type="checkbox" class="permissionCheckbox" id="clientDetailsCheck" checked=""> <span></span>

            </label>

            <span style="font-size: 15px">Check To Add Client & Company Details</span>

        </div>

    </div>

    <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_7" role="tablist">

        <!--begin::User Details Item-->

        <div id="userSection" class="m-portlet m-portlet--tabs" <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id'] !='') { ?>style="display: none;" <?php } else {?>style="display: block;" <?php }?>>

            <div id="selectExistingCustomer" style="padding-top: 15px;">

                <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >

                    <div class="tab-content">

                        <div class="tab-pane active show" id="m_portlet_base_demo_11_tab_content" role="tabpanel">

                            <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id'] !='') { ?>

                            <?php } else { ?>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-5 col-md-6 col-sm-12">

                                    <label for="street_address">Select User</label>

                                    <select class="form-control greyborder" name="useInfo" id="selectLeadUsr" required="">

                                        <option value="1" >Create New</option>

                                        <option value="thirdoption">Select Existing</option>

                                    </select>

                                </div>

                            </div>

                            <?php } ?>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div id="leadDetailsExist"> </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address"><?php if (!isset($value['pemail'])) { echo "<span style='color: red'>* </span>";}?>Primary Email</label>

                                    <input type="text" name="pemail" onkeyup="getEmailList(this.value)" value="<?php echo isset($value['pemail'])?$value['pemail']:''; ?>" id="pemail" class="form-control m-input" <?php if(empty($userId)){ echo "required"; } ?>>

                                    <p id="emailText"></p>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address"><?php if (!isset($value['last_name'])) { echo "<span style='color: red'>* </span>";}?>Primary Phone</label>

                                    <input type="text" name="pphone" onkeyup="changeColor('pphone',this.value)" value="<?php echo isset($value['pphone'])?$value['pphone']:''; ?>" id="pphone" class="form-control m-input" <?php if(empty($userId)){ echo "required"; } ?>>

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div id="leadDetailsExist"> </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address"><?php if (!isset($value['first_name'])) { echo "<span style='color: red'>* </span>";}?>First Name</label>

                                    <input type="text" name="Leadfirst_name" onkeyup="changeColor('firstName',this.value)" value="<?php echo isset($value['first_name'])?$value['first_name']:''; ?>" id="LeadUsrFName" class="form-control m-input" required>

                                    <input type="hidden" name="getUsrID" id="userID" value="0">

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address">Last Name</label>

                                    <input type="text" name="Leadlast_name" value="<?php echo isset($value['last_name'])?$value['last_name']:''; ?>" id="LeadUsrLName" class="form-control m-input">

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address">Designation</label>

                                    <input type="text" name="Leaddesignation" id="LeadUsrDesi" value="<?php echo isset($value['designation'])?$value['designation']:''; ?>" class="form-control m-input">

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-4 col-md-4 col-sm-12" id="getNewRole">

                                    <label for="street_address"><span style="color:red;">* </span>Role</label>

                                    <div id="newrolereceived">

                                        <select class="form-control" id="LeadusrRole" style="height: 30px !important" name="user_role_id" required>

                                                <option value="181" selected> Customer</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address">Department

                                        <!-- <a style="margin-left: 16px; color: blue; cursor: pointer;" id="addDept">Add Department ?</a> -->

                                    </label>

                                    <div id="setDepartment">

                                        <input type="text" list="datalist2" class="form-control m-input" placeholder="Add Department" name="fk_department_id" id="department_name"  value="<?php echo isset($value['department_name'])?$value['department_name']:''; ?>">

                                    </div>

                                    <input type="hidden" id="deptId" value=""/>

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-md-6 col-sm-6 col-12">

                                    <h5 class="modal-title padtop5">Company Address & Contact</h5>

                                </div>

                                <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="street_address"><?php if (!isset($value['fk_company_id'])) { echo "<span style='color: red'>* </span>";}?>Company</label>

                                    <input type="text" list="datalist" class="form-control m-input" id="LeadusrComp" placeholder="Select Company" name="Leaduser_comp_id" onkeyup="changeColor('company',this.value)" value="<?php echo isset($value['company_name'])?$value['company_name']:''; ?>" onchange="selectCompany(this.value, '<?php echo 'customer'; ?>')" <?php if(empty($userId)){ echo "required"; } ?>>

                                    <input type="hidden" name="company_id" id="company_id" value="<?php echo isset($value['company_id'])?$value['company_id']:''; ?>">

                                </div>



                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="parent_comp">Parent Company</label>



                                    <input type="text" list="datalist3" id="parent_comp" class="form-control m-input" placeholder="Select Parent Company" name="parent_company_name" value="<?php echo isset($value['parentCompany'])?$value['parentCompany']:''; ?>" onchange="selectParentCompany(this.value, '<?php echo 'customer'; ?>')">

                                    <input type="hidden" name="parent_company_id" id="parent_company" value="<?php echo isset($value['parentCompanyId'])?$value['parentCompanyId']:''; ?>">

                                </div>



                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="fk_industry_name">Industry</label>



                                    <input type="text" list="datalist4" class="form-control m-input" placeholder="Select Industry" name="fk_industry_name" id="fk_industry_name" onchange="selectIndustry(this.value, '<?php echo 'customer'; ?>')" value="<?php echo isset($value['industry_name'])?$value['industry_name']:''; ?>">

                                    <input type="hidden" name="fk_industry_id" id="fk_industry_id" value="<?php echo isset($value['industry_id'])?$value['industry_id']:''; ?>">

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="street_address">Street Address</label>

                                    <input type="text" name="Leadstreet_address" id="LeadUsrAdd" value="<?php echo isset($value['street_address'])?$value['street_address']:''; ?>" class="form-control m-input">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="street_address">Zip</label>

                                    <input type="number" name="Leadpincode" id="LeadUsrPin" value="<?php echo isset($value['zip'])?$value['zip']:''; ?>" class="form-control m-input">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="street_address"><?php if (!isset($value['city'])) { echo "<span style='color: red'>* </span>";}?>City</label>

                                    <input type="text" name="Leadcity" id="LeadUsrCity" onkeyup="changeColor('city',this.value)" value="<?php echo isset($value['city'])?$value['city']:''; ?>" class="form-control m-input" required>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="street_address">State</label>

                                    <input type="text" name="Leadstate" id="LeadUsrState" value="<?php echo isset($value['state'])?$value['state']:''; ?>" class="form-control m-input">

                                </div>



                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="state"><span style="color: red">* </span>Country</label>

                                    <select class="form-control countryCode" style="padding:.46rem 1.15rem !important; height:30px !important" name="company_country" id="add_country" onchange="getCountryCode(this.value)" required>

                                        <option value="">--Select Country--</option>

                                        <?php

                                            foreach ($country as $showCountry) {

                                            ?>

                                        <option value="<?php echo $showCountry['nicename']."-".$showCountry['phonecode'];?>" <?php echo (isset($value['country']) && ucfirst($value['country'])==$showCountry['nicename'])?'selected':''; ?> ><?php echo $showCountry['nicename']." (+".$showCountry['phonecode'].")";?></option>

                                        <?php

                                            }?>

                                    </select>

                                    <input type="hidden" name="dialing_code" id="dialing_code" value="<?php echo isset($value['dialing_code'])?$value['dialing_code']:''; ?>">

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3">

                                    <label for="bussiness_contact">Business Phone</label>

                                    <!-- <input type="text" name="company_bussiness_contact" id="company_bussiness_contact" class="form-control m-input" value="<?php echo isset($value['bussiness_contact'])?$value['dialing_code'].' - '.$value['bussiness_contact']:''; ?>"> -->



                                    <div class="input-group m-input-group">

                                        <div class="input-group-prepend" style="height: 30px"><span class="input-group-text" id="dialing_code_append"><?php echo isset($value['dialing_code'])?$value['dialing_code']:''; ?></span></div>

                                        <input type="text" name="company_bussiness_contact" id="company_bussiness_contact" class="form-control m-input" value="<?php echo isset($value['bussiness_contact'])?$value['bussiness_contact']:''; ?>" <?php if(empty($userId)){ echo "required"; } ?>>

                                    </div>

                                </div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-md-6 col-sm-6 col-12">

                                    <h5 class="modal-title padtop5">Users Address</h5>

                                </div>

                                <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

                            </div>

                            <div class="form-group m-form__group row m--margin-top-20 padtop3">

                                <div class="col-md-6 col-sm-6 col-12">

                                    <input type="checkbox" id="sameLeadCompanyAdd"> Check if user address is same as company address

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

                                    <input type="text" name="city" onkeyup="changeColor('usercity',this.value)" id="UsrCity" class="form-control m-input" value="<?php echo isset($value['city'])?$value['city']:''; ?>" required>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="street_address">State</label>

                                    <input type="text" name="state" id="UsrState" class="form-control m-input" value="<?php echo isset($value['state'])?$value['state']:''; ?>">

                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">

                                    <label for="state"><span style="color: red">* </span>Country</label>

                                    <select class="form-control countryCode" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="user_country" id="add_user_country" onchange="getCountryCode(this.value)" required>

                                        <option value="">--Select Country--</option>

                                        <?php

                                            foreach ($country as $showCountry) {

                                            ?>

                                        <option value="<?php echo $showCountry['nicename']."-".$showCountry['phonecode'];?>" <?php echo (isset($value['country']) && ucfirst($value['country'])==$showCountry['nicename'])?'selected':''; ?> ><?php echo $showCountry['nicename']." (+".$showCountry['phonecode'].")";?></option>

                                        <?php

                                            }?>

                                    </select>

                                </div>

                            </div>

                        </div>



                        <!-- contact details add and update -->

                    </div>

                </div>

            </div>

        </div>



        <!--end::User Details Item-->

        <!--begin::Lead Details Item-->

        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-md-6 col-sm-6 col-12 mob-no-pad">

                <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand" style="padding-top: 5px;">

                <input type="checkbox" class="permissionCheckbox" id="leadDetailsCheck" <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id']!='') { echo 'checked' ;}?>> <span></span>

                </label>

                <span style="font-size: 15px">Check To Add Lead Inquiry Details</span>

            </div>

        </div>

        <div id="leadSection"  class="m-portlet m-portlet--tabs" <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id']!='') { ?>style="display: block;" <?php } else { ?> style="display: none;" <?php }?>>

            <div class="form-group m-form__group row padtop3" style="padding-top: 15px;">

                <div class="col-lg-5 col-md-12 col-sm-12">

                    <label for="street_address"><span style="color:red;">* </span>  Opportunity Type</label>

                    <input type="text" list="datalist5" name="leadGeneraloppTitle" id="leadGeneralOppTitle" onchange="selectTitle(this.value)" class="form-control m-input" value="<?php echo isset($value['opportunity_title'])?$value['opportunity_title']:''; ?>" required>

                    <input type="hidden" name="priLeadOppIdUsr" id="priLeadOppId" value="<?php echo isset($value['lead_opportunity_id'])?$value['lead_opportunity_id']:''; ?>">

                </div>

            </div>



            <div class="form-group m-form__group row">

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <label for="recipient-name" class="form-control-label">Conversion Probability:</label>

                    <!-- <div class="m-section__content">

                        <div class="m-ion-range-slider">

                            <input type="range" name="weight" id="range_weight" value="<?php echo isset($value['Confidence'])?$value['Confidence']:'0'; ?>" min="1" max="100" oninput="range_weight_disp.value = range_weight.value">

                            <output  id="range_weight_disp"></output>

                        </div>

                        </div> -->

                    <div class="slide-ui">

                        <input type="text" value="<?php echo isset($value['confidence'])?$value['confidence']:'0'; ?>" style="visibility:hidden" />

                        <div class="procent"></div>

                    </div>

                    <div class="text" id="getConfidenceVAlue" style="visibility:hidden"></div>

                    <div class="pie" style="display:none">

                        <svg viewBox="0 0 32 32">

                            <circle r="16" cx="16" cy="16" id="circle" stroke-dasharray="0 100" />

                        </svg>

                    </div>

                    <script src="<?php echo base_url()?>media/script.js"></script>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <label for="recipient-name" class="form-control-label">Projected Contract date:</label>

                    <div class="input-group date" id="opportunity_project" >

                        <?php

                            if(isset($value['projected_sales_date']) ) {

                            ?>
                        <input type="date" min="<?php echo date('Y-m-d')?>" class="form-control m-input" name="follow_up_date" value="<?php echo isset($value['projected_sales_date'])?$value['projected_sales_date']:$afterThreeMonth; ?>">

                        <?php } else {

                            date_default_timezone_set($timezone);

                            $afterThreeMonth = date('Y-m-d', strtotime("+3 months"));

                        ?>

                        <input type="date" class="form-control m-input" name="follow_up_date" value="<?php echo $afterThreeMonth;?>">

                        <?php } ?>

                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12" style="margin-top: -14px;">

                    <label class="col-form-label"><span style="color:red;">* </span>Lead Generated By</label>

                    <select class="form-control" id="leadGeneralpeople" name="leadGeneralSalesPeople" style="height: 32px !important" required>

                        <option value="">-- Select Sales People --</option>

                        <?php

                            foreach ($salesPerson as $SalesP) {

                            ?>

                        <option value="<?php echo $SalesP['sales_people_id'];?>" <?php if (isset($value['fk_sales_people_id']) && $SalesP['sales_people_id'] == $value['fk_sales_people_id']) { echo "selected";} else if (!isset($value['lead_opportunity_id']) && $SalesP['sales_people_id'] == $this->session->userdata('user_id')) { echo "selected"; }?> ><?php echo ucwords($SalesP['name']);?></option>

                        <?php

                            }?>

                    </select>

                </div>

            </div>

            <div class="form-group m-form__group row">

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <label class="col-form-label">Job Type <a href="#" id="addJobType" style="margin-left: 16px; color: blue; cursor: pointer;">Add New ? </a></label>

                    <div id="replaceJobType">

                        <select class="form-control m-bootstrap-select m_selectpicker" name="leadGeneralJobType" id="leadGeneralJopSelected" data-live-search="true" placeholder="-- Job Type --">

                            <option value="">-- Select Job Type --</option>

                            <?php

                                foreach ($jobType as $JbT) {

                                ?>

                            <option value="<?php echo $JbT['job_name'];?>" <?php if (isset($value['job_type_id']) && $JbT['job_type_id'] == $value['job_type_id']) { echo "selected";} else if ($JbT['job_name'] =='Contract') {echo 'selected';}?> ><?php echo ucwords($JbT['job_name']);?></option>

                            <?php

                                }?>

                        </select>

                        <input type="hidden" value="addNew" id="getValue"/>

                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <label class="col-form-label" style="text-align: right !important">Source  <a href="#" id="addSource" style="margin-left: 16px; color: blue; cursor: pointer;">Add New ? </a></label>

                    <div id="replaceSource">

                        <select class="form-control m-bootstrap-select m_selectpicker" name="leadGeneralSourceName" id="leadGeneralSourceId" data-live-search="true" placeholder="-- No Leads Tags --">

                            <option value="">-- Select Socurce --</option>

                            <?php

                                foreach ($source as $Sour) {

                                ?>

                            <option value="<?php echo $Sour['source_name'];?>" <?php if (isset($value['source']) && $Sour['source_name'] == $value['source']) { echo "selected";} else if ($Sour['source_name'] =='Web Search') {echo 'selected';}?> ><?php echo ucwords($Sour['source_name']);?></option>

                            <?php

                                }?>

                        </select>

                        <input type="hidden" value="addNew" id="getValueSource"/>

                    </div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <label class="col-form-label"><span style="color:red;">* </span>Status</label>

                    <select class="form-control" id="leadGeneralStatusId" name="leadGeneralStatus" required>

                        <option value=""> --Select Status-- </option>

                        <option value="Open" selected >Open</option>

                        <option value="Urgent" <?php if (isset($value['status']) && $value['status']== 'Urgent') { echo "selected";} ?> >Urgent</option>

                        <option value="Close" <?php if (isset($value['status']) && $value['status']== 'Close') { echo "selected";}?> >Close</option>

                        <option value="Complete" <?php if (isset($value['status']) && $value['status']== 'Complete') { echo "selected";}?> >Complete</option>

                    </select>

                </div>

            </div>

        </div>



        <!--end::Lead Details Item-->

        <!--begin::Activity Details Item-->

        <div class="form-group m-form__group row m--margin-top-20 padtop3" <?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id'] !='') { ?>style="display: none;" <?php } ?>>

            <div class="col-md-6 col-sm-6 col-12 mob-no-pad">

                <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand" style="padding-top: 5px;">

                <input type="checkbox" class="permissionCheckbox" id="activityDetailsCheck"> <span></span>

                </label>

                <span style="font-size: 15px">Check To Add Activity Details</span>

            </div>

        </div>

        <div id="activitySection" style="display: none;" class="m-portlet m-portlet--tabs">

            <div class="form-group m-form__group row m--margin-top-20" style="padding-top: 15px;">

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

        date_default_timezone_set($timezone);

        $currentDate = date('Y-m-d').'T'.date('H:i');

        $afterTime = date('Y-m-d', strtotime("+10 minutes")).'T'.date('H:i', strtotime("+10 minutes"))

        ?>

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-5 col-md-4 col-sm-12">

                <label for="street_address"><span style="color:red;">* </span>Start Date & Time</label>
                    <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" id="datepickerUpdte" type="datetime-local" name="activity_start_datetime" min="<?php echo date('Y-m-d')?>" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_start_datetime'])?$value['activity_start_datetime']:$currentDate; ?>" required>
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



            <div class="col-lg-5 col-md-5 col-sm-12">

                <label for="street_address">Follow up Date & Time</label>

                <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" name="follow_up_datetime" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12">

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

                <label for="street_address">Email Draft Time</label>

                <input class="form-control m-input" min="<?php echo date('Y-m-d')?>T00:00" style="width: 100%;" type="datetime-local" id="email_draft_time" name="email_draft_time" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">

            </div>

        </div>



        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <label for="street_address" id="title"><span style="color:red;">* </span>Add Note</label>

                <input class="form-control m-input" type="text" name="activity_title" onkeyup="changeColor('addNote',this.value)" value="<?php echo isset($value['activity_title'])?$value['activity_title']:''; ?>" <?php if(empty($userId)){ echo "required"; } ?>>

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



        <!--end::Activity Details Item-->

        <?php

            if (!isset($value['lead_opportunity_id'])) { ?>

        <span style="font-weight: bold;">* Required Fields</span>

        <ul>

            <li style="color: red;" id="firstnameColor">First Name is required</li>

            <li style="color: red;" id="pemailColor">Primary Email is required</li>

            <li style="color: red;" id="pphoneColor">Primary Phone is required</li>

            <li style="color: red;" id="companyColor">Company is required</li>

            <li style="color: red;" id="companyCityColor">City from Company is required</li>

            <li style="color: red;" id="companyCountryColor">Country from Company is required</li>

            <li style="color: red;" id="userCountryColor">Country from User is required</li>

            <li style="color: red;" id="userCityColor">City from User is required</li>

            <li style="color: red;" id="addNoteColor">Add Note from Activity is required</li>

        </ul>

        <?php }?>

        <div id="validation_errors_update_opportunity"></div>

        <input type="hidden" name="userType" value="leadopportunity">

        <div class="col-lg-6 col-md-6 col-sm-12" style="margin-top: 29px;">

            <div id="user_type"></div>

            <input type="hidden" name="confidence" id="confidence" value="">

            <input type="hidden" name="lead_opportunity_id" id="lead_opportunity_id" value="<?php if(isset($value['lead_opportunity_id']) && $value['lead_opportunity_id']!='') { echo $value['lead_opportunity_id']; }?>">

            <?php

                if (isset($value['lead_opportunity_id']) && $value['lead_opportunity_id']!='') { ?>

                    <button type="button" id="leadSubmit" onclick="saveLeadForm()" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

            <?php } else {

            ?>

            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

        <?php }

            ?>

            <!-- <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->

            <?php if(empty($value)) { ?>

                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>

            <?php } ?>

            <button type="submit" data-type="convetToJob" class="btn btn-default m-btn" style="font-family: sans-serif, Arial;background-color: #545c54;color: white;">Convert To Job</button>

            <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>

        </div>

    </div>

    <div class="modal fade show" id="select_existing" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-lg" role="document" style="max-width:900px">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="">Select Existing Details</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="la la-remove"></span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 col-12">

                            <form class="form-inline ml-auto">

                                <input class="form-control mr-sm-2" id="myInput" type="text" placeholder="Search..">

                            </form>

                        </div>

                    </div>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <table class="table table-striped- table-bordered table-hover table-checkable">

                            <thead>

                                <tr>

                                    <th></th>

                                    <th>Name</th>

                                    <th>Company</th>

                                    <th>Phone</th>

                                    <th>Email</th>

                                    <th>Address</th>

                                    <th>City</th>

                                    <th>State</th>

                                    <th>Country</th>

                                </tr>

                            </thead>

                            <tbody id="myTable">

                            <?php



                                foreach ($existingUser as $key =>$usrData) { ?>

                                <tr>

                                <td><button type="button" id="existUId" value="<?php echo $usrData['user_id'].'|'.$usrData['first_name'].'|'.$usrData['last_name'].'|'.$usrData['designation'].'|'.$usrData['company_id'].'|'.$usrData['street_address'].'|'.$usrData['city'].'|'.$usrData['state'].'|'.$usrData['pincode'].'|'.$usrData['countryName']=str_replace('+', '', $usrData['countryName']).'|'.$usrData['contact_info'].'|'.$usrData['contact_type'].'|'.$usrData['phone'].'|'.$usrData['email'].'|'.$usrData['user_contact_id'].'|'.$usrData['company_name'].'|'.$usrData['bussiness_contact'].'|'.$usrData['company_add'].'|'.$usrData['company_city'].'|'.$usrData['company_state'].'|'.$usrData['company_country'].'|'.$usrData['dialing_code'].'|'.$usrData['company_zip'].'|'.$usrData['industry_name'].'|'.$usrData['fk_industry_id'].'|'.$usrData['parentCompany'].'|'.$usrData['parentCompanyId'].'|'.$usrData['countryName'].'|'.$usrData['department_name'].'|'.$usrData['fk_department_id'];?>" class="btn btn-secondary m-btn" style="font-family: sans-serif, Arial;">Select</button>

                                </td>

                                <td><?php echo $usrData['first_name']." ".$usrData['last_name'];?></td>

                                <td><?php echo $usrData['company_name'];?></td>

                                <td><?php echo $usrData['phone'];?></td>

                                <td><?php echo $usrData['email'];?></td>

                                <td><?php echo $usrData['street_address'];?></td>

                                <td><?php echo $usrData['city'];?></td>

                                <td><?php echo $usrData['state'];?></td>

                                <td><?php echo $usrData['country'];?></td>

                                </tr>

                            <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Company List For Auto Complete -->

    <datalist id="datalist">

        <?php

            foreach ($company as $key => $value) {

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



    <datalist id="datalist5">

    <?php

        foreach ($opportunity_master as $key => $value) {

    ?>

    <option value="<?php echo $value['opportunity_title'];?>"><?php echo $value['opportunity_title'];?></option>

    <?php }?>



    <!-- This data list will be edited through javascript     -->

    </datalist>

</form>
