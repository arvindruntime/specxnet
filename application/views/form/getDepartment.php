<?php
if ($value == 'addNew') { ?>
<input type="text" name="fk_department_id" class="form-control" placeholder="Add Department Name">
<?php } else { ?>
<select class="form-control" id="fk_department_id" style="height: 30px !important" name="fk_department_id">
    <option data-tokens="Menu1" value="">--Select Department--</option>
    <?php
        foreach ($department as $department) {
        ?>
    <option value="<?php echo $department['department_id'];?>" <?php if (isset($value['fk_department_id']) && $department['department_id'] == $value['fk_department_id']) { echo "selected";}?> ><?php echo ucwords($department['department_name']);?></option>
    <?php
        }?>
</select>
<?php }
?>
