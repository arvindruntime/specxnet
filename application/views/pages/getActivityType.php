<label for="street_address"><span style="color:red;">* </span>Activity Status</label>
<select class="form-control" id="activity_status"  name="status" style="height: 30px !important" required>
    <option value="">--Select Status--</option>
<?php
    foreach ($getActivityStatus as $key => $activity_status_value) { ?>
        <option value="<?php echo $activity_status_value['status']?>" <?php if (isset($lead_activity_status) && $lead_activity_status == $activity_status_value['status']) { echo "selected";}?>><?php echo $activity_status_value['status'];?></option>
   <?php } ?> 
</select>