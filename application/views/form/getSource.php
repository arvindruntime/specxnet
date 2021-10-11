<?php
if ($value == 'addNew') { ?>
	<input type="text" name="leadGeneralSourceName" id="leadGeneralSourceId" class="form-control" placeholder="Add Source Name">
<?php } else { ?>
	<select class="form-control m-bootstrap-select m_selectpicker" name="leadGeneralSourceName" id="leadGeneralSourceId" data-live-search="true">
	    <option value="">-- Select Socurce --</option>
	    <?php
	        foreach ($source as $Sour) {
	        ?>
	    <option value="<?php echo $Sour['source_name'];?>" <?php if (isset($value['source']) && $Sour['source_name'] == $value['source']) { echo "selected";}?> ><?php echo ucwords($Sour['source_name']);?></option>
	    <?php
	        }?>
	</select>
<?php }
?>
