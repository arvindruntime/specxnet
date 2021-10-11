<?php
if ($list) {?>
	<div class="form-group m-form__group row m--margin-top-20">
	    <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
	        <label for="city">Check If you don't have comapny documents</label>
	        <input type="checkbox" name="checkDocuments" id="checkDocuments" onclick="checkDoc()" />
	    </div>
    
	</div>
<?php
foreach ($list as $key => $value) { ?>
	<div class="form-group m-form__group row m--margin-top-20">
	    <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
	        <b id="doc_type_name"><?php echo $value['title'];?></b>
	    </div>
	    <div class="col-lg-4 col-md-4 col-sm-12">
	        <?php if ($value['datatype'] == 'textbox') { ?>
	        <input type="text" name="doc_type_text" id="doc_type_text" class="form-control m-input hideit" <?php if ($value['mandatory'] =='Yes') {echo "required";}?>>
	    <?php } else if ($value['datatype'] == 'file') {?>
	        <input type="file" name="doc_type_file" id="doc_type_file" class="form-control m-input hideit" <?php if ($value['mandatory'] =='Yes') {echo "required";}?>>
	    <?php }?>
	    </div>
	</div>
<?php	
	}?>
<?php 
}?>
