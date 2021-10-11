<?php
//print_r($data);exit;
if (!empty($data)) {
    $newData = $data[0];
    $data = json_decode($newData['filter_values']);
    //print_r($parentCompany[0]['company_name']);exit;
    $status = '';
    $opportunity_status = '';
    $approval_deadline = '';
    $sales_person = '';

    if(isset($data->status)) {
        $status = $data->status;
    }
    if(isset($data->opportunity_status)) {
        $opportunity_status = $data->opportunity_status;
    }
    if(isset($data->approval_deadline)) {
        $approval_deadline = $data->approval_deadline;
    }
    if(isset($data->sales_person)) {
        $sales_person = $data->sales_person;
    }
    ?>

    <input type="hidden" name="saved_filter_id" id="saved_filter_id" value="<?php echo $filter_id;?>">
    <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom:0">
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label">Proposal Status</label>
            <div>
                <select class="form-control greyborder" name="status" id="status">
                    <option value="">--Select Status--</option>
                    <option value="Drafted" <?php echo (isset($status) && $status=='Drafted')?'selected':''; ?>>Drafted</option>
                    <option value="Released" <?php echo (isset($status) && $status=='Released')?'selected':''; ?>>Released</option>
                    <option value="Approved" <?php echo (isset($status) && $status=='Approved')?'selected':''; ?>>Approved</option>
                    <option value="Declined" <?php echo (isset($status) && $status=='Declined')?'selected':''; ?>>Declined</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label padtop3">Opportunity Status</label>
            <div>
                <select class="form-control greyborder" name="opportunity_status" id="opportunity_status">
                    <option value="">--Select Status--</option>
                    <option value="active" <?php echo (isset($opportunity_status) && $opportunity_status=='active')?'selected':''; ?>>Active</option>
                    <option value="inactive" <?php echo (isset($opportunity_status) && $opportunity_status=='inactive')?'selected':''; ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label">Approval Deadline</label>
            <!-- <input type="text" name="approval_deadline" id="approval_deadline" class="form-control m-input" placeholder="Approval Deadline" value="<?php echo isset($approval_deadline)?$approval_deadline:''; ?>"> -->
            <?php
                if(isset($approval_deadline) && $approval_deadline != '') {
            ?>
            <input type="date" name="approval_deadline" id="approval_deadline" class="form-control m-input" value="<?php echo isset($approval_deadline)?date('Y-m-d',strtotime($approval_deadline)):''; ?>">
        <?php } else {?>
            <input type="date" name="approval_deadline" id="approval_deadline" class="form-control m-input" placeholder="Approval Deadline" value="">
        <?php }?>
        </div>

        <!-- <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label padtop3">Salesperson</label>
            <div>
                <select class="form-control greyborder" name="sales_person" id="sales_person">
                    <option value="">--Select Salesperson--</option>
                    <?php
                        foreach ($getSalesperson as $key => $value) { ?>
                            <option value="<?php echo $value['user_id'];?>" <?php echo (isset($sales_person) && $sales_person==$value['user_id'])?'selected':''; ?>><?php echo $value['name'];?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div> -->
    </div>
<?php } else {
?>
    <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom:0">
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label">Proposal Status</label>
            <div>
                <select class="form-control greyborder" name="status" id="status">
                    <option value="">--Select Status--</option>
                    <option value="Drafted" <?php echo (isset($status) && $status=='Drafted')?'selected':''; ?>>Drafted</option>
                    <option value="Released" <?php echo (isset($status) && $status=='Released')?'selected':''; ?>>Released</option>
                    <option value="Approved" <?php echo (isset($status) && $status=='Approved')?'selected':''; ?>>Approved</option>
                    <option value="Declined" <?php echo (isset($status) && $status=='Declined')?'selected':''; ?>>Declined</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label padtop3">Opportunity Status</label>
            <div>
                <select class="form-control greyborder" name="opportunity_status" id="opportunity_status">
                    <option value="">--Select Status--</option>
                    <option value="active" <?php echo (isset($opportunity_status) && $opportunity_status=='active')?'selected':''; ?>>Active</option>
                    <option value="inactive" <?php echo (isset($opportunity_status) && $opportunity_status=='inactive')?'selected':''; ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label">Approval Deadline</label>
            <?php
                if(isset($approval_deadline) && $approval_deadline != '') {
            ?>
            <input type="date" name="approval_deadline" id="approval_deadline" class="form-control m-input" value="<?php echo isset($approval_deadline)?date('Y-m-d',strtotime($approval_deadline)):''; ?>">
        <?php } else {?>
            <input type="date" name="approval_deadline" id="approval_deadline" class="form-control m-input" placeholder="Approval Deadline" value="">
        <?php }?>
        </div>
        <!-- <div class="col-lg-2 col-md-2 col-sm-3">
            <label class="form-control-label padtop3">Salesperson</label>
            <div>
                <select class="form-control greyborder" name="sales_person" id="sales_person">
                    <option value="">--Select Salesperson--</option>
                    <?php
                        foreach ($getSalesperson as $key => $value) { ?>
                            <option value="<?php echo $value['user_id'];?>" <?php echo (isset($sales_person) && $sales_person==$value['user_id'])?'selected':''; ?>><?php echo $value['name'];?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div> -->
    </div>
<?php } ?>
