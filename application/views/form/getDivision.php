<?php
if ($value == 'addNew') { ?>
<input type="text" name="division" class="form-control" placeholder="Add Division Name">
<?php } else { ?>
<select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="division" id="add_parent_company_id">
    <option data-tokens="Menu1">--Select Division--</option>
    <?php
        foreach ($division as $division) {
        ?>
    <option value="<?php echo $division['division_id'];?>" <?php echo (isset($value['division']) && $value['division']==$division['division_id'])?'selected':''; ?> ><?php echo $division['division_name'];?></option>
    <?php
        }?>
</select>
<?php }
?>
