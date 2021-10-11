<div id="validation_errors"></div>
<form action="<?php echo base_url().'opportunity/create/title'?>" enctype="multipart/form-data" method="post" id="fRoleeedInput" class="m-form m-form--fit m-form--label-align-right">
    <div class="form-group m-form__group row m--margin-top-20">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <label for="roleName"><span style="color:red;">* </span>Opportunity Title</label>
            <input type="text" name="opportunity_title" id="opportunity_title" class="form-control m-input" placeholder="Name" value="<?php echo isset($value['opportunity_title'])?$value['opportunity_title']:''; ?>" required>
            <!-- <div id="tagsname"></div> -->
        </div>
        
    </div>

    <div class="form-group m-form__group row m--margin-top-20">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <input type="hidden" name="opportunity_id" value="<?php echo isset($value['opportunity_id'])?$value['opportunity_id']:''; ?>">
            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>
            <?php if(empty($value)) { ?>
                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>
                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
            <?php } ?>
        </div>
    </div>

</form>
