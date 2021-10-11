<?php
if ($value == 'addNew') { ?>
<input type="text" name="leadGeneralJobType" id="leadGeneralJopSelected" class="form-control" placeholder="Add Job Type">
<?php } else { ?>
<select class="form-control m-bootstrap-select m_selectpicker" name="leadGeneralJobType" id="leadGeneralJopSelected" data-live-search="true" placeholder="-- Job Type --">
    <option value="">-- Select Job Type --</option>
   <?php
        foreach ($jobType as $JbT) {
        ?>
    <option value="<?php echo $JbT['job_type_id'];?>" <?php if (isset($value['job_type_id']) && $JbT['job_type_id'] == $value['job_type_id']) { echo "selected";}?> ><?php echo ucwords($JbT['job_name']);?></option>
    <?php
        }?>
</select>
<?php }
?>
