<div id="validation_errors"></div>

<form action="<?php echo base_url().'role/create/roleAdd'?>" enctype="multipart/form-data" method="post" id="fRoleeedInput" class="m-form m-form--fit m-form--label-align-right">

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-6 col-md-6 col-sm-12">

            <label for="roleName"><span style="color:red;">* </span>Role Name</label>

            <input type="text" name="roleName" id="addroleName" class="form-control m-input" placeholder="Name" value="<?php echo isset($value['role_name'])?$value['role_name']:''; ?>" required>

            <!-- <div id="tagsname"></div> -->

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">

            <label for="roleName">Role Description</label>

            <textarea class="form-control m-input" name="roledescription" id="roleDesc" style="height: 75px !important;" placeholder=""><?php echo isset($value['role_description'])?$value['role_description']:''; ?></textarea>

        </div>

        

    </div>



    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <input type="hidden" name="role_id" value="<?php echo isset($value['role_id'])?$value['role_id']:''; ?>">

            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

            <?php if(empty($value)) { ?>

                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>

                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>

            <?php } ?>

        </div>

    </div>



</form>

