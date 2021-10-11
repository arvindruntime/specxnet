<?php 
	$due_date = '';
	$linked_to = '';
?>

<?php if(isset($todo['option']) && $todo['option'] == 'Linked To') { ?>
	<?php $linked_to = 'checked'; ?>
	<style type="text/css">
		.due_date {
			display: none;
		}
	</style>
<?php }else  { ?> 
	<?php $due_date = 'checked'; ?>
	<style type="text/css">
		.linked_to{
			display: none;
		}
	</style>
<?php } ?>

<div class="m-portlet m-portlet--tabs" id="tab">
    <div class="m-portlet__head">
        <div class="m-portlet__head-tools">
            <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">
                <li class="nav-item m-tabs__item">
                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#schedule-form" role="tab" aria-selected="false">new </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-portlet__body margin-top2" style="">
        <div class="tab-content">                        
            <div class="tab-pane active show" id="schedule-form" role="tabpanel">
            	<div id="validation_errors"></div>
				<form action="<?php echo base_url().$url; ?>" enctype="multipart/form-data" method="post" id="schedule" class="m-form m-form--fit m-form--label-align-right">
					<div class="form-group m-form__group row m--margin-top-20 padtop3">
    					<div class="col-md-6 col-sm-6 col-6">
        					<h5 class="modal-title padtop5">General Info</h5>
    					</div>
    					<div class="col-sm-12 col-12" style="border:1px groove #000000"></div>
					</div>
					<div class="form-group m-form__group row m--margin-top-20">

						<div class="col-lg-3 col-md-3 col-sm-12">
				        	<label for="job"><span style="color: red">* </span>Job</label>
				        	<select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="job" id="job" required>
					            <option data-tokens="Menu1">--Select Job--</option>
					            <?php foreach($job as $row) { ?>
					            	<option value="<?php echo $row['job_id']; ?>" <?php echo (isset($todo['fk_job']) && $row['job_id'] == $todo['fk_job'])?'selected':''; ?>><?php echo $row['opportunity_title']; ?></option>
					            <?php } ?>
					        </select>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				        	<label><span style="color: red">* </span>Title </label>
				        	<textarea class="form-control m-input" name="title" row="10" col="4" placeholder="title"><?php echo (isset($todo['note']))?trim($todo['note']):''; ?></textarea>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				            <label for="end_date"><span style="color: red">* </span>Assigned To</label>
				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="assigned_to" id="assigned_to" required="true">
					            <option data-tokens="Menu1">--Select Assigned To--</option>
					           <?php foreach($assignedTo as $row) { ?>
					            	<option value="<?php echo $row['user_id']; ?>" <?php echo (isset($todo['assigned_to']) && $todo['assigned_to'] == $row['user_id'])?'selected':''; ?>><?php echo $row['full_name']; ?></option>
					            <?php } ?>
					        </select>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				            <label for="end_date"><span style="color: red">* </span>Priority </label>
				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="priority" id="priority" required="true">
					            <option value="high" <?php echo (isset($todo['priority']) && $todo['priority'] == 'high')?'selected':''; ?>>High</option>
					            <option value="low" <?php echo (isset($todo['priority']) && $todo['priority'] == 'low')?'selected':''; ?>>Low</option>
					        </select>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				            <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand" style="padding-top: 5px;">
			                <input type="checkbox" name="completed" id="completed" class="form-control m-input" <?php echo (isset($todo['is_completed']) && $todo['is_completed'] == '1')?'checked':''; ?>> <span></span>
			                </label>
			                <span style="font-size: 15px">Is Completed</span>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				        	<span class="">
                                <label>
                                    <input type="radio" <?php echo $due_date; ?> name="option" class="option" value="Due Date" > Due Date
                                    <input type="radio" <?php echo $linked_to; ?> name="option" class="option" value="Linked To"> Linked To 
                                </label>
                            </span>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12 linked_to">
				            <label for="start_date">Day(s)</label>
				            <input type="number" name="day" class="form-control m-input" min="0" value="<?php echo isset($todo['day'])?$todo['day']:0; ?>">
				        	
				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="when" id="when" required="true">
					            <option value="before" <?php echo (isset($todo['when']) && $todo['when'] == 'before')?'selected':'';  ?>>Before</option>
					            <option value="after" <?php echo (isset($todo['when']) && $todo['when'] == 'after')?'selected':'';  ?>>After</option>
					        </select>

					        <label for="start_date">Schedule</label>
					        <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="schedule" id="schedule">
					            <option value="">Schedule Item</option>
					            <?php foreach($schedule as $row) { ?>
					            	<option value="<?php echo $row['id']; ?>" <?php echo (isset($todo['fk_schedule']) && $todo['fk_schedule'] == $row['id'])?'selected':'';  ?>><?php echo $row['title']; ?></option>
					            <?php } ?>
					        </select>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12 due_date">
				            <label for="start_date"><span style="color: red">* </span>Date Time</label>
				            <input type="text" name="date_time" id="date_time" class="form-control m-input date-time" placeholder="date time" value="<?php echo (isset($todo['start_date_time']))?date('d-M-Y H:i',strtotime($todo['start_date_time'])):''; ?>" required>
				            <div id="tagsname"></div>
				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">
				            <label for="end_date"><span style="color: red">* </span>Reminder</label>
				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="reminder" id="reminder" required="true">
					            <option data-tokens="Menu1">--Select Reminder--</option>
					        	<?php for($i = 1; $i < 11; $i++) { ?>
					        		<option value="<?php echo $i ?>" <?php echo (isset($todo['reminder']) && $todo['reminder'] == $i)?'selected':''; ?>><?php echo $i.' hour' ?></option>
					        	<?php } ?>
					        </select>
				        </div>
					</div>
					<div class="form-group m-form__group row m--margin-top-20">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>
                            <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save &amp; New</button>
                            <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>

