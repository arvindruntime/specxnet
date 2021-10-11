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
            <label for="file_name"><span style="color: red">* </span>File Name</label>
            <input type="text" name="file_name" id="add_company_name_test" class="form-control m-input" placeholder="Name" value="<?php echo isset($value['file_name'])?$value['file_name']:''; ?>" required>
            <div id="tagsname"></div>
		</div>
       <div class="col-lg-3 col-md-3 col-sm-12">
            <label for="file_name"><span style="color: red">* </span>Folder Name</label>
            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="folder_name" id="add_parent_company_id">
                        <option data-tokens="Menu1">--Select Folder--</option>
							<?php
                            foreach ($folders as $folders) {
                            ?>
                        <option value="<?php echo $folders['folder_id'];?>-<?php echo $folders['folder_name'];?>" <?php echo (isset($value['folder_name']) && $value['folder_name']==$folders['folder_name'])?'selected':''; ?> ><?php echo $folders['folder_name'];?></option>
                        <?php
                            }?>
                    </select>
            <div id="tagsname"></div>
		</div>
<div class="col-lg-3 col-md-3 col-sm-12">
            <label for="file_type"><span style="color: red">* </span>File Type</label>
            <select name="file_type" id="file_type" class="form-control m-input">
			<option value="">Please Select</option>
			<option value="Document">Document</option>
			<option value="Photo">Photo</option>
			<option value="Video">Video</option>
			</select>
            <div id="tagsname"></div>
		</div>
<div class="col-lg-3 col-md-3 col-sm-12">
            <label for="document"><span style="color: red">* </span>Upload File</label>
            <input type="file" name="document[]" id="document" class="form-control m-input" placeholder="Name" multiple="true" required>
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