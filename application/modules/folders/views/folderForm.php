<div id="validation_errors"></div>
<form action="<?php echo base_url().'folders/create/folders/'.$folderId; ?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
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
 <div class="col-lg-3 col-md-3 col-sm-12">
            <label for="folder_name"><span style="color: red">* </span>Project Name</label>
            <input type="text" name="project_name" id="add_company_name_test" class="form-control m-input" placeholder="Project Name" value="<?php echo isset($value['project_name'])?$value['project_name']:''; ?>" required>
            <div id="tagsname"></div>
		</div>
         <div class="col-lg-3 col-md-3 col-sm-12">
            <label for="folder_name"><span style="color: red">* </span>Is Parent?</label>
			<?php 
			if(isset($value['is_parent']))
			{
			?>
            <select name="is_parent" id="is_parent" class="form-control m-input">
			<option value="">Please Select</option>
			<option value="1" <?php if($value['is_parent']==1){ echo 'selected';} ?>>Yes</option>
			<option value="0" <?php if($value['is_parent']==0){ echo 'selected';} ?>>No</option>
			</select>
			<?php } else { ?>
			<select name="is_parent" id="is_parent" class="form-control m-input">
			<option value="">Please Select</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
			</select>
			<?php } ?>
            <div id="tagsname"></div>
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