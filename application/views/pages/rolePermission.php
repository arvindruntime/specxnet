<form action="<?php echo base_url().'role/addPermissions'?>" enctype="multipart/form-data" method="post" id="fRoleeedInput" class="m-form m-form--fit m-form--label-align-right">

    <?php



        if (isset($permissions[0])) {

            $permissionsList = json_decode($permissions[0]['permissions']);

            //print_r($permissions);exit;

        }



        foreach ($module as $key => $value) {

    ?>

        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-md-6 col-sm-6 col-6">

                <h5 class="modal-title padtop5"><i class="fa fa-chart-line">&nbsp;&nbsp;</i><?php echo $value['module_name'];?></h5>

            </div>

            <div class="col-md-6 col-sm-6 col-6">

                <h5 class="modal-title padtop5">Access</h5>

            </div>

            <div class="col-sm-12 col-12" style="border:2px groove #000000"></div>

        </div>

        <!-- <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-md-6 col-sm-6 col-6">

                <p class="modal-title padtop5"><strong>Leads</strong></p>

            </div>

            <div class="col-md-6 col-sm-6 col-6">

                <p class="modal-title padtop5">Add View Edit Delete</p>

            </div>

        </div> -->

        <?php

            $permissions = explode(',', $value['permission']);

            //if (!empty($permissions)) {

            foreach ($permissions as $permisionskey => $permisionsValue) {

                $permisionsValue = explode('_', $permisionsValue);

                //print_r($permisionsValue);exit;

        ?>

        <div class="form-group m-form__group row m--margin-top-20 padtop3">

            <div class="col-md-6 col-sm-6 col-6">

                <p class="modal-title padtop5" id="permisionTitle" name="permission_tit[]" value="Assign" salesperson=""><?php echo $permisionsValue[1];?></p>

            </div>



            <div class="col-md-6 col-sm-6 col-6">

                <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">

                <input type="checkbox" id="permissioncheck" name="check[]" value="<?php echo $permisionsValue[0];?>" <?php if (isset($permissionsList) && in_array($permisionsValue[0], $permissionsList)) { echo 'checked';}?>> <span></span>

                </label>

            </div>

        </div>

        <?php

            }}

         ?>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <input type="hidden" name="role_id" value="<?php echo $role_id;?>">

            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

        </div>

    </div>

</form>