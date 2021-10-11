<div id="validation_errors"></div>
<form action="<?php echo base_url().'files/create/files/'.$folderId; ?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
    <div class="form-group m-form__group row m--margin-top-20 padtop3">
        <div class="col-md-6 col-sm-6 col-6">
            <h5 class="modal-title padtop5">General Info</h5>
        </div>
        <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>
    </div>
    <div class="form-group m-form__group row m--margin-top-20">
        <div class="col-lg-3 col-md-3 col-sm-12">
            <label for="folder_name"><span style="color: red">* </span>Folder Name</label>
            <input type="text" name="folder_name" id="add_company_name_test" class="form-control m-input" placeholder="Name" value="<?php echo isset($value['folder_name'])?$value['folder_name']:''; ?>" required>
            <div id="tagsname"></div>
		</div>   
    </div>
    
    <div class="form-group m-form__group row m--margin-top-20">
        <div class="col-lg-2 col-md-2 col-sm-12 padtop4">
            <label for="zip_code">Zip</label>
            <input type="text" name="zip_code" id="add_zip" class="form-control m-input" value="<?php echo $value['zip_code']??''; ?>">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 padtop4">
            <label for="city"><span style="color: red">* </span>City</label>
            <input type="text" name="city" id="add_city" class="form-control m-input" value="<?php echo $value['city']??''; ?>" required>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <label for="state">State</label>
            <input type="text" name="state" id="add_state" class="form-control m-input" value="<?php echo $value['state']??''; ?>">
        </div>
    </div>

    
    <div class="form-group m-form__group row m--margin-top-20">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="company_type"></div>
            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>
            <?php if(empty($value)) { ?>
                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>
                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
            <?php } ?>
        </div>
    </div>
   
</form>