
<?php
foreach ($data as $key => $activityList) { ?>
   <label>
       <b>Type: </b> <span><?php echo isset($activityList['activity_type'])?$activityList['activity_type']:''; ?></span>
    </label>
    <br/>
    <label>
       <b>Activity Date: </b> <span><?php echo isset($activityList['activity_start_datetime'])?date('d-M-Y h:i A', strtotime($activityList['activity_start_datetime'])):''; ?></span>
    </label>
    <br/>
    <label>
       <b>Comment: </b> <span><?php echo isset($activityList['activity_title'])?$activityList['activity_title']:''; ?></span>
    </label>
    <br/>
    <label> ------------------</label> 
    <br/> 
<?php } ?>