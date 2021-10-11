<div id="validation_errors"></div>

<form action="<?php echo base_url() . 'company/create/company/' . $companyId; ?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">

    <div class="form-group m-form__group row m--margin-top-20 padtop3">

        <div class="col-md-6 col-sm-6 col-6">

            <h5 class="modal-title padtop5">General Info</h5>

        </div>

        <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="company_name"><span style="color: red">* </span>Company Name</label>

            <input type="text" name="company_name" id="add_company_name_test" class="form-control m-input" placeholder="Name" value="<?php echo isset($value['company_name']) ? $value['company_name'] : ''; ?>" required>

            <div id="tagsname"></div>

        </div>


        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="parent_company_id">Parent Company</label>



            <input type="text" list="datalist2" class="form-control m-input" placeholder="Select Parent Company" name="parent_company_id" onkeyup="ac(this.value)" value="<?php echo isset($value['parent_company']) ? $value['parent_company'] : ''; ?>">

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 padtop4" id="logoImage" <?php if (isset($value['company_logo_file']) && $value['company_logo_file'] != '') { ?>style="padding-top: 25px;" <?php } ?>>
            <label for="parent_company_id">Company Logo</label>

            <?php

            if (isset($value['company_logo_file']) && $value['company_logo_file'] != '') {

            ?>

                <a href="<?php echo base_url() . 'upload/company_logo/' . $value['company_logo_file']; ?>" style="margin-top: 26px;" id="deleteFile" target="_blank"><?php echo $value['company_logo_org_file_name']; ?></a>

                <span style="margin-left: 15px;margin-top: 23px;color: red;cursor: pointer;" onclick="deleteLogo(<?php echo $value['company_id']; ?>)"> <i class="la la-trash"></i></span>

            <?php } else { ?>

                <input type="file" class="form-control m-input" name="company_logo" id="company_logo" >

            <?php } ?>

        </div>
        <?php

        if ($companyType == 'supplier') {

        ?>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="parent_company_id">Division <a href="#" id="addDivision" style="margin-left: 16px; color: blue; cursor: pointer;">Add New ? </a></label>

                <div id="replaceDivision">

                    <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="division" id="add_parent_company_id">

                        <option data-tokens="Menu1">--Select Division--</option>

                        <?php

                        foreach ($division as $division) {

                        ?>

                            <option value="<?php echo $division['division_id']; ?>" <?php echo (isset($value['division']) && $value['division'] == $division['division_id']) ? 'selected' : ''; ?>><?php echo $division['division_name']; ?></option>

                        <?php

                        } ?>

                    </select>

                </div>

                <input type="hidden" value="addNew" id="getValue" />

            </div>

        <?php } ?>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="parent_company_id">Industry </label>

            <div id="replaceIndustry">

                <!-- <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="fk_industry_id" id="add_parent_company_id">

                        <option data-tokens="Menu1">--Select Industry--</option>

                        <?php

                        foreach ($industry as $industry) {

                        ?>

                        <option value="<?php echo $industry['industry_id']; ?>" <?php echo (isset($value['fk_industry_id']) && $value['fk_industry_id'] == $industry['industry_id']) ? 'selected' : ''; ?> ><?php echo $industry['industry_name']; ?></option>

                        <?php

                        } ?>

                    </select>

                    <input id="tags" placeholder="Enter a city..." />  -->

                <input type="text" list="datalist" class="form-control m-input" placeholder="Add Industry" name="fk_industry_id" onkeyup="ac_Company(this.value)" value="<?php echo isset($value['industry_name']) ? $value['industry_name'] : ''; ?>">



            </div>

            <input type="hidden" value="addNew" id="getValue" />

        </div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-1 col-md-1 col-sm-1">

            <label for="code">Code</label>

            <input type="text" name="dialing_code" class="form-control m-input" id="dialing_code" style="width: 65px;" readonly value="<?php echo $value['dialing_code'] ?? ''; ?>">

        </div>



        <div class="col-lg-3 col-md-3 col-sm-3">

            <label for="bussiness_contact"><span style="color: red">* </span>Business Phone</label>

            <input type="number" name="bussiness_contact" id="add_bussiness_contact" class="form-control m-input" value="<?php echo $value['bussiness_contact'] ?? ''; ?>" required>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 padtop4">

            <label for="fax">Fax</label>

            <input type="text" class="form-control m-input" name="fax" id="add_fax" value="<?php echo $value['fax'] ?? ''; ?>">

        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 padtop4">

            <label for="street_address">Street Address</label>

            <textarea class="form-control height-60" name="street_address" id="add_street_address" placeholder="" rows="6"><?php echo $value['street_address'] ?? ''; ?></textarea>

        </div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-2 col-md-2 col-sm-12 padtop4">

            <label for="zip_code">Zip</label>

            <input type="text" name="zip_code" id="add_zip" class="form-control m-input" value="<?php echo $value['zip_code'] ?? ''; ?>">

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 padtop4">

            <label for="city"><span style="color: red">* </span>City</label>

            <input type="text" name="city" id="add_city" class="form-control m-input" value="<?php echo $value['city'] ?? ''; ?>" required>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="state">State</label>

            <input type="text" name="state" id="add_state" class="form-control m-input" value="<?php echo $value['state'] ?? ''; ?>">

        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">

            <label for="state"><span style="color: red">* </span>Country</label>

            <select class="form-control countryCode" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="country" id="add_country" onchange="getCountryCode(this.value)" required>

                <option data-tokens="Menu1">--Select Country--</option>

                <?php

                foreach ($country as $showCountry) {

                ?>

                    <option value="<?php echo $showCountry['nicename'] . "-" . $showCountry['phonecode']; ?>" <?php echo (isset($value['country']) && ucfirst($value['country']) == $showCountry['nicename']) ? 'selected' : ''; ?>><?php echo $showCountry['nicename'] . " (+" . $showCountry['phonecode'] . ")"; ?></option>

                <?php

                } ?>

            </select>

        </div>

    </div>



    <!-- Div to replace identifier -->

    <div id="replaceIdentifier">

        <?php

        if ((isset($value['file']) && $value['file'] != '') || isset($value['vat']) && $value['vat'] != '') { ?>

            <div class="form-group m-form__group row m--margin-top-20">

                <div class="col-lg-4 col-md-4 col-sm-12 padtop4">

                    <label for="city">Check If you don't have company documents</label>

                    <input type="checkbox" name="checkDocuments" id="checkDocuments" onclick="checkDoc()" />

                </div>



            </div>

            <div class="form-group m-form__group row m--margin-top-20">

                <div class="col-lg-4 col-md-4 col-sm-12 padtop4">

                    <b id="doc_type_name">Trade Licence</b>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12" id="replaceAddImage">

                    <?php

                    if (isset($value['file']) && $value['file'] != '') {

                    ?>

                        <a href="<?php echo base_url() . 'upload/' . $value['file']; ?>" id="deleteFile" target="_blank"><?php echo $value['file_orig_name']; ?></a> <!-- <span style="color: red; cursor: pointer;" onclick="deleteFile(<?php echo $value['company_id']; ?>)">   X</span> -->

                        <button type="button" id="usrContactAdd" class="btn-sm btn m-btn--icon btn-danger btn-add" onclick="deleteFile(<?php echo $value['company_id']; ?>)" style="margin-left: 15px;">

                            <span> <i class="la la-trash"></i> <span>Delete</span> </span>



                        </button>

                    <?php } else { ?>

                        <input type="file" name="doc_type_file" id="doc_type_file" class="form-control m-input hideit">

                    <?php } ?>

                </div>

            </div>

            <div class="form-group m-form__group row m--margin-top-20">

                <div class="col-lg-4 col-md-4 col-sm-12 padtop4">

                    <b id="doc_type_name">VAT</b>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">

                    <input type="text" name="doc_type_text" id="doc_type_text" class="form-control m-input hideit" value="<?php echo isset($value['vat']) ? $value['vat'] : ''; ?>">

                </div>

            </div>

        <?php    }

        ?>

    </div>

    <?php

    if ($companyType == 'supplier') {

    ?>

        <!-- <div class="form-group m-form__group row m--margin-top-20 padtop3">

        <div class="col-md-6 col-sm-6 col-6">

            <h5 class="modal-title padtop5">Permissions</h5>

        </div>

        <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20 padtop3">

        <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

            <input type="checkbox" name="permit_access_to_new_job" <?php echo isset($value['permit_access_to_new_job']) && $value['permit_access_to_new_job'] == 'Yes' ? 'checked' : ''; ?> style="height: 12px;" /> <label style="margin-left: 10px;">Automatically permit access to new job</label>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

            <input type="checkbox" name="allow_to_view_information" <?php echo isset($value['allow_to_view_information']) && $value['allow_to_view_information'] == 'Yes' ? 'checked' : ''; ?> style="height: 12px;" /> <label style="margin-left: 10px;">Allow supplier to view owners information</label>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

            <input type="checkbox" name="allow_to_share_doc" <?php echo isset($value['allow_to_share_doc']) && $value['allow_to_share_doc'] == 'Yes' ? 'checked' : ''; ?> style="height: 12px;" /> <label style="margin-left: 10px;">Allow supplier to share Comments & Docs with Owner</label>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

            <input type="checkbox" name="allow_to_assign_rfi" <?php echo isset($value['allow_to_assign_rfi']) && $value['allow_to_assign_rfi'] == 'Yes' ? 'checked' : ''; ?> style="height: 12px;" /> <label style="margin-left: 10px;">Allow supplier to assign RFI to other suppliers</label>

        </div>

    </div> -->



        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-md-6 col-sm-6 col-6">

                <h5 class="modal-title padtop5">Additional Info</h5>

            </div>

            <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

        </div>

        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

                <b>General Liability Certificate</b>

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12 padtop4" id="replaceLiabilityImage" <?php if (isset($value['liable_certificate_file']) && $value['liable_certificate_file'] != '') { ?>style="padding-top: 25px;" <?php } ?>>

                <?php

                if (isset($value['liable_certificate_file']) && $value['liable_certificate_file'] != '') {

                ?>

                    <a href="<?php echo base_url() . 'upload/liability_certificate/' . $value['liable_certificate_file']; ?>" style="margin-top: 26px;" id="deleteFile" target="_blank"><?php echo $value['liable_certificate_orig_name']; ?></a>

                    <span style="margin-left: 15px;margin-top: 23px;color: red;cursor: pointer;" onclick="deleteLiableCertificateFile(<?php echo $value['company_id']; ?>)"> <i class="la la-trash"></i></span>

                <?php } else { ?>

                    <input type="file" class="form-control m-input" name="liable_certificate_file" id="liable_certificate_file" style="margin-top: 26px;">

                <?php } ?>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 padtop4">

                <label>Expires</label>

                <input type="text" class="form-control m-input datepicker" name="liable_certificate_expires" id="liable_certificate_expires" placeholder="Expiry Date" value="<?php echo $value['liable_certificate_expires'] ?? ''; ?>" style="width:100%;">

            </div>

            <div class="col-lg-1 col-md-1 col-sm-12 padtop4">

                <label>Reminder</label>

                <input type="number" class="form-control m-input" name="liable_certificate_expire_reminder" id="liable_certificate_expire_reminder" value="<?php echo isset($value['liable_certificate_expire_reminder']) ? $value['liable_certificate_expire_reminder'] : ''; ?>">

            </div> <span class="mob-days" style="margin-top: 31px;">Days</span>

            <div class="col-lg-2 col-md-2 col-sm-12 padtop4">

                <select class="form-control m-input mob-top-0" name="liable_certificate_expire_reminder_type" id="liable_certificate_expire_reminder_type" style="margin-top: 26px;">

                    <option value="before" <?php if (isset($value['liable_certificate_expire_reminder_type']) && $value['liable_certificate_expire_reminder_type'] == 'before') {
                                                echo 'selected';
                                            } ?>>before</option>

                    <option value="after" <?php if (isset($value['liable_certificate_expire_reminder_type']) && $value['liable_certificate_expire_reminder_type'] == 'after') {
                                                echo 'selected';
                                            } ?>>after</option>

                </select>

            </div>

            <span class="mob-days" style="margin-top: 31px;">(max</span>

            <div class="col-lg-2 col-md-2 col-sm-12 padtop4">

                <select class="form-control m-input mob-top-0" name="liable_certificate_expire_reminder_value" id="liable_certificate_expire_reminder_value" style="margin-top: 26px;">

                    <option value="5" <?php if (isset($value['liable_certificate_expire_reminder_value']) && $value['liable_certificate_expire_reminder_value'] == '5') {
                                            echo 'selected';
                                        } ?>>5</option>

                    <option value="5" <?php if (isset($value['liable_certificate_expire_reminder_value']) && $value['liable_certificate_expire_reminder_value'] == '4') {
                                            echo 'selected';
                                        } ?>>4</option>

                    <option value="3" <?php if (isset($value['liable_certificate_expire_reminder_value']) && $value['liable_certificate_expire_reminder_value'] == '3') {
                                            echo 'selected';
                                        } ?>>3</option>

                    <option value="2" <?php if (isset($value['liable_certificate_expire_reminder_value']) && $value['liable_certificate_expire_reminder_value'] == '2') {
                                            echo 'selected';
                                        } ?>>2</option>

                    <option value="1" <?php if (isset($value['liable_certificate_expire_reminder_value']) && $value['liable_certificate_expire_reminder_value'] == '1') {
                                            echo 'selected';
                                        } ?>>1</option>

                </select>

            </div>

            <span class="mob-days" style="margin-top: 31px;">)</span>

        </div>



        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

                <b>Workkman's Comp Certificate</b>

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12 padtop4" id="replaceWorkmanImage" <?php if (isset($value['liable_certificate_file']) && $value['liable_certificate_file'] != '') { ?>style="padding-top: 25px;" <?php } ?>>

                <?php

                if (isset($value['workman_certificate_file']) && $value['workman_certificate_file'] != '') {

                ?>

                    <a href="<?php echo base_url() . 'upload/workman_certificate/' . $value['workman_certificate_file']; ?>" style="margin-top: 26px;" id="deleteFile" target="_blank"><?php echo $value['workman_certificate_orig_name']; ?></a>

                    <span style="margin-left: 15px;margin-top: 23px;color: red;cursor: pointer;" onclick="deleteWorkmanCertificateFile(<?php echo $value['company_id']; ?>)"> <i class="la la-trash"></i></span>

                <?php } else { ?>

                    <input type="file" class="form-control m-input" name="workman_certificate_file" id="workman_certificate_file" style="margin-top: 26px;">

                <?php } ?>



            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 padtop4">

                <label>Expires</label>

                <input type="text" class="form-control m-input datepicker" name="workman_certificate_expires" id="workman_certificate_expires" placeholder="Expiry Date" value="<?php echo $value['workman_certificate_expires'] ?? ''; ?>" style="width:100%;">

            </div>

            <div class="col-lg-1 col-md-1 col-sm-12 padtop4">

                <label>Reminder</label>

                <input type="number" class="form-control m-input" name="workman_certificate_expire_reminder" id="workman_certificate_expire_reminder" value="<?php echo $value['workman_certificate_expire_reminder'] ?? ''; ?>">

            </div> <span class="mob-days" style="margin-top: 31px;">Days</span>

            <div class="col-lg-2 col-md-2 col-sm-12 padtop4">

                <select class="form-control m-input mob-top-0" name="workman_certificate_expire_reminder_type" id="workman_certificate_expire_reminder_type" style="margin-top: 26px;">

                    <option value="before" <?php if (isset($value['workman_certificate_expire_reminder_type']) && $value['workman_certificate_expire_reminder_type'] == 'before') {
                                                echo 'selected';
                                            } ?>>before</option>

                    <option value="after" <?php if (isset($value['workman_certificate_expire_reminder_type']) && $value['workman_certificate_expire_reminder_type'] == 'after') {
                                                echo 'selected';
                                            } ?>>after</option>

                </select>

            </div>

            <span class="mob-days" style="margin-top: 31px;">(max</span>

            <div class="col-lg-2 col-md-2 col-sm-12 padtop4">

                <select class="form-control m-input mob-top-0" name="workman_certificate_expire_reminder_value" id="workman_certificate_expire_reminder_value" style="margin-top: 26px;">

                    <option value="5" <?php if (isset($value['workman_certificate_expire_reminder_value']) && $value['workman_certificate_expire_reminder_value'] == '5') {
                                            echo 'selected';
                                        } ?>>5</option>

                    <option value="5" <?php if (isset($value['workman_certificate_expire_reminder_value']) && $value['workman_certificate_expire_reminder_value'] == '4') {
                                            echo 'selected';
                                        } ?>>4</option>

                    <option value="3" <?php if (isset($value['workman_certificate_expire_reminder_value']) && $value['workman_certificate_expire_reminder_value'] == '3') {
                                            echo 'selected';
                                        } ?>>3</option>

                    <option value="2" <?php if (isset($value['workman_certificate_expire_reminder_value']) && $value['workman_certificate_expire_reminder_value'] == '2') {
                                            echo 'selected';
                                        } ?>>2</option>

                    <option value="1" <?php if (isset($value['workman_certificate_expire_reminder_value']) && $value['workman_certificate_expire_reminder_value'] == '1') {
                                            echo 'selected';
                                        } ?>>1</option>

                </select>

            </div>

            <span class="mob-days" style="margin-top: 31px;">)</span>

        </div>

        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

                <b>Company Profile</b>

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12 padtop4" id="replaceCompanyProfile" <?php if (isset($value['company_profile_file']) && $value['company_profile_file'] != '') { ?>style="padding-top: 25px;" <?php } ?>>

                <?php

                if (isset($value['company_profile_file']) && $value['company_profile_file'] != '') {

                ?>

                    <a href="<?php echo base_url() . 'upload/liability_certificate/' . $value['company_profile_file']; ?>" style="margin-top: 26px;" id="deleteFile" target="_blank"><?php echo $value['liable_certificate_orig_name']; ?></a>

                    <span style="margin-left: 15px;margin-top: 23px;color: red;cursor: pointer;" onclick="deleteCompanyProfileFile(<?php echo $value['company_id']; ?>)"> <i class="la la-trash"></i></span>

                <?php } else { ?>

                    <input type="file" class="form-control m-input" name="companyProfileFile" id="companyProfileFile" style="margin-top: 26px;">

                <?php } ?>

            </div>

        </div>
        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-lg-12 col-md-12 col-sm-12 padtop4">

                <b>Catalog</b>

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12 padtop4" id="replaceCatalog" <?php if (isset($value['catalog_file']) && $value['catalog_file'] != '') { ?>style="padding-top: 25px;" <?php } ?>>

                <?php

                if (isset($value['catalog_file']) && $value['catalog_file'] != '') {

                ?>

                    <a href="<?php echo base_url() . 'upload/liability_certificate/' . $value['catalog_file']; ?>" style="margin-top: 26px;" id="deleteFile" target="_blank"><?php echo $value['liable_certificate_orig_name']; ?></a>

                    <span style="margin-left: 15px;margin-top: 23px;color: red;cursor: pointer;" onclick="deleteCatalogFile(<?php echo $value['company_id']; ?>)"> <i class="la la-trash"></i></span>

                <?php } else { ?>

                    <input type="file" class="form-control m-input" name="companyCatelog" id="companyCatelog" style="margin-top: 26px;">

                <?php } ?>

            </div>

        </div>
    <?php } ?>

    <input type="hidden" name="companyType" value="<?php echo $companyType; ?>">

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div id="company_type"></div>

            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

            <?php if (empty($value)) { ?>

                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>

                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>

            <?php } ?>

        </div>

    </div>

    <datalist id="datalist">

        <?php

        foreach ($industryNames as $key => $value) {

        ?>

            <option value="<?php echo $value['industry_name']; ?>"><?php echo $value['industry_name']; ?></option>

        <?php } ?>



        <!-- This data list will be edited through javascript     -->

    </datalist>



    <datalist id="datalist2">

        <?php

        foreach ($parentCompany as $key2 => $value2) {

        ?>

            <option value="<?php echo $value2['company_name']; ?>"></option>

        <?php } ?>



    </datalist>

</form>
