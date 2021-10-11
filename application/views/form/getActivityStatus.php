<label for="street_address">Activity Status</label>    
<select class="form-control" id="activity_status" name="status" style="height: 30px !important">
    <option value="">--Select Status--</option>
    <?php foreach ($activity_status as $key => $activityTypeValue) { ?>
        <option value="<?php echo $activityTypeValue['status']?>"><?php echo $activityTypeValue['status'];?></option>
    <?php } ?>
</select>