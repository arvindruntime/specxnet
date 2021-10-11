<?php



    if (isset($permissions[0]['permissions'])) {

        $permissionList = json_decode($permissions[0]['permissions']);

    }

    if (isset($permissions[0]['can_view_company'])) {

        $can_view_company = json_decode($permissions[0]['can_view_company']);

    }

    if (isset($permissions[0]['can_view_users'])) {

        $can_view_users = json_decode($permissions[0]['can_view_users']);

    }

    if (isset($permissions[0]['can_view_opportunity'])) {

        $can_view_opportunity = json_decode($permissions[0]['can_view_opportunity']);

    }

    if (isset($permissions[0]['can_view_activity'])) {

        $can_view_activity = json_decode($permissions[0]['can_view_activity']);

    }

    if (isset($permissions[0]['can_view_activity_comments'])) {

        $can_view_activity_comments = json_decode($permissions[0]['can_view_activity_comments']);

    }

?>

<div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#collapsed" aria-expanded="true">

    <span class="m-accordion__item-icon"><i class="la la-angle-right"></i></span>

    <span class="m-accordion__item-title" style="font-size: 20px;font-weight: bold;">Admin</span>

    <span class="m-accordion__item-mode"></span>     

</div>

<div class="m-accordion__item-body collapse" id="collapsed" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="cursor: pointer;"  aria-expanded="true">

    <div class="m-accordion__item-content">

        <div class="form-group m-form__group row m--margin-top-20 padtop3" style="margin-left: 0px !important;">

            <div class="col-md-6 col-sm-6 col-6">

                <p class="modal-title padtop5" id="permisionTitle" name="permission_tit[]" value="Assign" salesperson="">Admin Access</p>

            </div>

            <div class="col-md-6 col-sm-6 col-6">

                <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                <input type="checkbox" id="adminpermissioncheck" name="check[]" value="admin" <?php if (isset($permissionList[0]) && $permissionList[0] == 'admin') { echo 'checked';}?>> <span></span>

                </label>

            </div>

        </div>

        </div>

</div>

<?php

    if (isset($permissions[0]['permissions'])) {

        $permissionList = json_decode($permissions[0]['permissions']);

    }

    foreach ($module as $key => $value) {

?>

    <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#collapse<?php echo $value['module_id'];?>" aria-expanded="true">

        <span class="m-accordion__item-icon"><i class="la la-angle-right"></i></span>

        <span class="m-accordion__item-title" style="font-size: 20px;font-weight: bold;"><?php echo $value['module_name'];?></span>

        <span class="m-accordion__item-mode"></span>     

    </div>

    <div class="m-accordion__item-body collapse" id="collapse<?php echo $value['module_id'];?>" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="cursor: pointer;"  aria-expanded="true">

        <?php

            $permissions = explode(',', $value['permission']);
// print_r($permissions);
            //if (!empty($permissions)) {

            foreach ($permissions as $permissionskey => $permissionsValue) {

                $permissionsValue = explode('_', $permissionsValue);

        ?>

                <div class="m-accordion__item-content">

                <div class="form-group m-form__group row m--margin-top-20 padtop3" style="margin-left: 0px !important;">

                    <div class="col-md-6 col-sm-6 col-6">

                        <p class="modal-title padtop5" id="permisionTitle" name="permission_tit[]" value="Assign" salesperson=""><?php echo $permissionsValue[1];?></p>

                    </div>

                    <div class="col-md-3 col-sm-3 col-3">

                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                        <input type="checkbox" class="permissionCheckbox" id="permissioncheck<?php echo $permissionsValue[0];?>" <?php if ($permissionsValue[0] == 42 || $permissionsValue[0] == 44 || $permissionsValue[0] == 21 || $permissionsValue[0] == 45 || $permissionsValue[0] == 46) { ?> onclick="getPermissionValue(<?php echo $permissionsValue[0];?>,'<?php echo $permissionsValue[1];?>')"<?php }?> name="check[]" value="<?php echo $permissionsValue[0];?>" <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'checked';}?>> <span></span>

                        </label>

                    </div>

                    <?php //lead Activity Data

                        if ($permissionsValue[0] == 42) {

                    ?>

                        <div class="col-md-12 col-sm-12 col-12" id="userActivity<?php echo $permissionsValue[0];?>" style="margin-top: 10px; display: <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'block';} else { echo 'none'; }?>;">

                            <table  style="width:61% !important;">

                                <?php

                                

                                foreach ($userList as $key => $user) { 

                                    if ($currentUser != $user['user_id']) {

                                ?>

                                    <tr>

                                        <td><b><?php echo $user['full_name'];?></b></td>

                                        <td>

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                                            <input type="checkbox" class="permissionCheckbox" id="userActivity<?php echo $user['user_id'];?>" name="userCheck[]" value="<?php echo $user['user_id'];?>" <?php if (!is_null($user['user_id']) && @in_array($user['user_id'], $can_view_activity)) { echo 'checked';}?>> <span></span>

                                            </label>

                                        </td>

                                    </tr>    

                                <?php } }?>

                            </table>

                        </div>

                    <?php }?>

                    <?php //lead Comment Data

                        if ($permissionsValue[0] == 44) {

                    ?>

                        <div class="col-md-12 col-sm-12 col-12" id="userComment<?php echo $permissionsValue[0];?>" style="margin-top: 10px; display: <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'block';} else { echo 'none'; }?>;">

                            <table  style="width:61% !important;">

                                <?php

                                foreach ($userList as $key => $user) { 

                                    if ($currentUser != $user['user_id']) {

                                ?>

                                    <tr>

                                        <td><b><?php echo $user['full_name'];?></b></td>

                                        <td>

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                                            <input type="checkbox" class="permissionCheckbox" id="userComment<?php echo $user['user_id'];?>" name="userComment[]" value="<?php echo $user['user_id'];?>" <?php if (!is_null($user['user_id']) && @in_array($user['user_id'], $can_view_activity_comments)) { echo 'checked';}?>> <span></span>

                                            </label>

                                        </td>

                                    </tr>    

                                <?php } } ?>

                            </table>

                        </div>

                    <?php }?>



                    <?php //lead Opportunity Data

                        if ($permissionsValue[0] == 21) {

                    ?>

                        <div class="col-md-12 col-sm-12 col-12" id="userOpportunity<?php echo $permissionsValue[0];?>" style="margin-top: 10px; display: <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'block';} else { echo 'none'; }?>;">

                            <table  style="width:61% !important;">

                                <?php

                                foreach ($userList as $key => $user) { 

                                    if ($currentUser != $user['user_id']) {

                                ?>

                                    <tr>

                                        <td><b><?php echo $user['full_name'];?></b></td>

                                        <td>

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                                            <input type="checkbox" class="permissionCheckbox" id="userOpportunity<?php echo $user['user_id'];?>" name="userOpportunity[]" value="<?php echo $user['user_id'];?>" <?php if (!is_null($user['user_id']) && @in_array($user['user_id'], $can_view_opportunity)) { echo 'checked';}?>> <span></span>

                                            </label>

                                        </td>

                                    </tr>    

                                <?php } } ?>

                            </table>

                        </div>

                    <?php }?>



                    <?php //Users Data

                        if ($permissionsValue[0] == 45) {

                    ?>

                        <div class="col-md-12 col-sm-12 col-12" id="userAdded<?php echo $permissionsValue[0];?>" style="margin-top: 10px; display: <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'block';} else { echo 'none'; }?>;">

                            <table  style="width:61% !important;">

                                <?php

                                foreach ($userList as $key => $user) { 

                                    if ($currentUser != $user['user_id']) {

                                ?>

                                    <tr>

                                        <td><b><?php echo $user['full_name'];?></b></td>

                                        <td>

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                                            <input type="checkbox" class="permissionCheckbox" id="userAdded<?php echo $user['user_id'];?>" name="userAdded[]" value="<?php echo $user['user_id'];?>" <?php if (!is_null($user['user_id']) && @in_array($user['user_id'], $can_view_users)) { echo 'checked';}?>> <span></span>

                                            </label>

                                        </td>

                                    </tr>    

                                <?php } } ?>

                            </table>

                        </div>

                    <?php }?>



                    <?php //Company Data

                        if ($permissionsValue[0] == 46) {

                    ?>

                        <div class="col-md-12 col-sm-12 col-12" id="companyAdded<?php echo $permissionsValue[0];?>" style="margin-top: 10px; display: <?php if (!is_null($permissionsValue[0]) && @in_array($permissionsValue[0], $permissionList)) { echo 'block';} else { echo 'none'; }?>;">

                            <table  style="width:61% !important;">

                                <?php

                                foreach ($userList as $key => $user) { 

                                    if ($currentUser != $user['user_id']) {

                                ?>

                                    <tr>

                                        <td><b><?php echo $user['full_name'];?></b></td>

                                        <td>

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                                            <input type="checkbox" class="permissionCheckbox" id="companyAdded<?php echo $user['user_id'];?>" name="companyAdded[]" value="<?php echo $user['user_id'];?>" <?php if (!is_null($user['user_id']) && @in_array($user['user_id'], $can_view_users)) { echo 'checked';}?>> <span></span>

                                            </label>

                                        </td>

                                    </tr>    

                                <?php } } ?>

                            </table>

                        </div>

                    <?php }?>

                    

                </div>

                </div>

         <?php

            }

         ?>

    </div>

<?php 

    }?>