

<!-- <div class="form-group m-form__group row m--margin-top-20 padtop3">
    <div class="col-lg-5 col-md-6 col-sm-12">
        <h5 class="modal-title padtop5 new-activity" id=""><strong>Notifications</strong></h5>
    </div>
</div> -->
<!-- <div class="form-group m-form__group row m--margin-top-20 padtop3">
    <label class="col-md-5 col-11 col-form-label" style="padding-top:22px;margin-right: 74px;"><h5>Notifications</h5></label>
    <div class="col-1">Email
        <span class="m-switch m-switch--icon">
        <label>
        <input type="checkbox" >
        <span id="emailNotifications" onclick="setNotification()"></span>
        </label>
        </span>
    </div>
    <div class="col-1">Text
        <span class="m-switch m-switch--icon">
        <label>
        <input type="checkbox"  id="textNotifications">
        <span></span>
        </label>
        </span>
    </div>
    <div class="col-1">Push
        <span class="m-switch m-switch--icon">
        <label>
        <input type="checkbox"  id="pushNotifications">
        <span></span>
        </label>
        </span>
    </div>
    <div class="col-2">
        <div>All Users</div>
        <div class="m-switch m-switch--icon">
            <label>
            <input type="checkbox"  id="allUserNotifications">
            <span></span>
            </label>
        </div>
    </div>
</div> -->

<?php
    if (isset($notifications[0])) {
        $emailnotificationsList = json_decode($notifications[0]['email_notifications']);
        $text_notificationsList = json_decode($notifications[0]['text_notifications']);
        $push_notificationsList = json_decode($notifications[0]['push_notifications']);
        $all_user_notificationList = json_decode($notifications[0]['all_user_notification']);
    }
    // $notificationsList = json_decode($notifications[0]['notifications']);
    foreach ($module as $key => $value) {
?>
<div class="form-group m-form__group row m--margin-top-20 padtop3">
    <div class="col-md-6 col-sm-6 col-6">
        <h5 class="modal-title padtop5"><i class="fa fa-chart-line">&nbsp;&nbsp;</i><?php echo $value['module_name'];?></h5>
    </div>
    <div class="col-sm-12 col-12" style="border:2px groove #000000"></div>
</div>
<div class="form-group m-form__group row m--margin-top-20 padtop3">
    <div class="col-md-6 col-sm-6 col-12">
        <h5 class="modal-title padtop5"><strong></strong></h5>
    </div>
    <div class="col-md-6 col-sm-6 col-12">
        <h6 class="modal-title padtop5"><strong style="margin-left: 10px;">Email</strong> 
            <!-- <strong  style="margin-left: 38px;">Text</strong> <strong style="margin-left: 41px;">Push</strong> <strong  style="margin-left: 30px;">All User</strong> -->
        </h6>
    </div>
</div>
<?php
    $notification = explode(',', $value['notification']);
    //if (!empty($permissions)) {
    foreach ($notification as $notificationkey => $notificationValue) {
        $notificationValue = explode('_', $notificationValue);
?>
<div class="form-group m-form__group row m--margin-top-20 padtop3">
    <div class="col-md-6 col-sm-6 col-6">
        <p class="modal-title padtop5"><?php echo $notificationValue[1];?></p>
    </div>
    <div class="col-1">
        <?php if ($notificationValue[2] == 'Yes') { ?>
        <div class="m-switch m-switch--icon">
            <label>
            <input type="checkbox" name="emailcheck[]" class="emailcheck" value="<?php echo isset($notificationValue[0])?$notificationValue[0]:''; ?>" <?php if (!is_null($notificationValue[0]) && @in_array($notificationValue[0], $emailnotificationsList)) { echo 'checked';}?>>
            <span></span>
            </label>
        </div>
        <?php } ?>
    </div>
    <!-- <div class="col-1">
        <?php if ($notificationValue[3] == 'Yes') { ?>
        <div class="m-switch m-switch--icon">
            <label>
            <input type="checkbox" name="textcheck[]" class="textcheck" value="<?php echo isset($notificationValue[0])?$notificationValue[0]:''; ?>" <?php if (!is_null($notificationValue[0]) && @in_array($notificationValue[0], $text_notificationsList)) { echo 'checked';}?>>
            <span></span>
            </label>
        </div>
    <?php } ?>
    </div>
    <div class="col-1">
        <?php if ($notificationValue[4] == 'Yes') { ?>
        <div class="m-switch m-switch--icon">
            <label>
            <input type="checkbox" name="pushcheck[]" class="pushcheck" value="<?php echo isset($notificationValue[0])?$notificationValue[0]:''; ?>" <?php if (!is_null($notificationValue[0]) && @in_array($notificationValue[0], $push_notificationsList)) { echo 'checked';}?>>
            <span></span>
            </label>
        </div>
    <?php } ?>
    </div>
    <div class="col-1">
        <?php if ($notificationValue[5] == 'Yes') { ?>
        <div class="m-switch m-switch--icon">
            <label>
            <input type="checkbox" name="allcheck[]" class="allcheck" value="<?php echo isset($notificationValue[0])?$notificationValue[0]:''; ?>" <?php if (!is_null($notificationValue[0]) && @in_array($notificationValue[0], $all_user_notificationList)) { echo 'checked';}?>>
            <span></span>
            </label>
        </div>
    <?php } ?>
    </div> -->
</div>
<?php
    }}
 ?>
