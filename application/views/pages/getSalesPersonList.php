<label for="street_address" style="margin-top:5px">Sales Person</label>
<select class="form-control" name="sales_person">
    <option value="">--Select Sales Person--</option>
<?php
$i=0;
    foreach ($userDetails as $dataskey => $dataValue) {
    $i++;
?>
<option value="<?php echo $dataValue['user_id']?>"><?php echo $dataValue['full_name']?></option>
<?php }?>
</select>
<input type="hidden" name="lead_id" value="<?php echo $lead_id;?>">