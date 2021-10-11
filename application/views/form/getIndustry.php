<?php
if ($value == 'addNew') { ?>
<input type="text" name="fk_industry_id" class="form-control" placeholder="Add Industry Name">
<?php } else { ?>
<select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="fk_industry_id" id="add_parent_company_id">
    <option data-tokens="Menu1">--Select Industry--</option>
    <?php
        foreach ($industry as $industry) {
        ?>
    <option value="<?php echo $industry['industry_id'];?>" <?php echo (isset($value['fk_industry_id']) && $value['fk_industry_id']==$industry['industry_id'])?'selected':''; ?> ><?php echo $industry['industry_name'];?></option>
    <?php
        }?>
</select>
<?php }
?>
