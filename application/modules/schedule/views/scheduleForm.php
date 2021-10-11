<div id="validation_errors"></div>

<div class="m-portlet m-portlet--tabs" id="tab">

    <div class="m-portlet__head">

        <div class="m-portlet__head-tools">

            <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">

                <li class="nav-item m-tabs__item">

                    <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#schedule-form" role="tab" aria-selected="false">new </a>

                </li>

                <li class="nav-item m-tabs__item" <?php ($id)?'style="display: none;"':'style="display: none;"'?>>

                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#phase" role="tab" aria-selected="false">Phase </a>

                </li>

                <li class="nav-item m-tabs__item" <?php ($id)?'style="display: none;"':''?>>

                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#note" role="tab" aria-selected="true">Notes </a>

                </li>

                <li class="nav-item m-tabs__item" <?php ($id)?'style="display: none;"':''?>>

                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#files" role="tab" aria-selected="true">Files(s) </a>

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

					            	<option value="<?php echo $row['job_id']; ?>" <?php echo (isset($schedule['job_id']) && $row['job_id'] == $schedule['job_id'])?'selected':''; ?>><?php echo $row['opportunity_title']; ?></option>

					            <?php } ?>

					        </select>

				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">

				            <label for="company_name"><span style="color: red">* </span>Title</label>

				            <input type="text" name="schedule_title" id="title" class="form-control m-input" placeholder="title" value="<?php echo (isset($schedule['title']))?$schedule['title']:''; ?>" required>

				            <div id="tagsname"></div>

				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">

				            <label for="start_date"><span style="color: red">* </span>Start Date Time</label>

				            <input type="text" name="start_date" id="title" class="form-control m-input date-time" placeholder="start date time" value="<?php echo (isset($schedule['start_date']))?date('d-M-Y H:i',strtotime($schedule['start_date'].' '.$schedule['start_time'])):''; ?>" required>

				            <div id="tagsname"></div>

				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">

				            <label for="end_date"><span style="color: red">* </span>End Date Time</label>

				            <input type="text" name="end_date" id="title" class="form-control m-input date-time" placeholder="end date time" value="<?php echo (isset($schedule['start_date']))?date('d-M-Y H:i',strtotime($schedule['end_date'].' '.$schedule['end_time'])):''; ?>" required>

				            <div id="tagsname"></div>

				        </div>

					</div>

					<div class="form-group m-form__group row m--margin-top-20">

						<div class="col-lg-3 col-md-3 col-sm-12">

				            <label for="end_date"><span style="color: red">* </span>Assigned To</label>

				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="assigned_to" id="assigned_to" required="true">

					            <option data-tokens="Menu1">--Select Assigned To--</option>

					           <?php foreach($assignedTo as $row) { ?>

					            	<option value="<?php echo $row['user_id']; ?>" <?php echo (isset($schedule['assigned_to']) && $schedule['assigned_to'] == $row['user_id'])?'selected':''; ?>><?php echo $row['full_name']; ?></option>

					            <?php } ?>

					        </select>

				        </div>

				        <div class="col-lg-3 col-md-3 col-sm-12">

				            <label for="end_date"><span style="color: red">* </span>Reminder</label>

				            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="reminder" id="reminder" required="true">

					            <option data-tokens="Menu1">--Select Reminder--</option>

					        	<?php for($i = 1; $i < 11; $i++) { ?>

					        		<option value="<?php echo $i ?>" <?php echo (isset($schedule['reminder']) && $schedule['reminder'] == $i)?'selected':''; ?>><?php echo $i.' hour' ?></option>

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

            <div class="tab-pane" id="phase" role="tabpanel">

            	<form action="<?php echo base_url().$phaseUrl ?>" method="POST">

            		<div class="col-lg-3 col-md-3 col-sm-12 no-padding">

			            <label for="phase"><span style="color: red">* </span>Phase</label>

			            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="phase" id="phase" required>

				            <option data-tokens="Menu1" value="">--Select Phase--</option>

				            <?php foreach($phase as $row) { ?>

				        		<option value="<?php echo $row ?>" <?php echo (isset($schedulePhase) && ($row == $schedulePhase))?'selected':''; ?>><?php echo $row ?></option>

				        	<?php } ?>

				        </select>

			        </div>

			        <div class="form-group m-form__group row m--margin-top-20">

						<div class="col-lg-12 col-md-12 col-sm-12">

							<button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

						</div>

					</div>

            	</form>

            </div>

            <div class="tab-pane" id="note" role="tabpanel">

            	<form action="<?php echo base_url().$NoteUrl?>" method="POST">

	            	<div class="form-group m-form__group row m--margin-top-20">

	            		<div class="col-lg-12 col-md-12 col-sm-12">

		            		<label for="company_name"><span style="color: red"></span>All</label>

		            		<textarea class="form-control m-input" name="all"><?php echo (isset($note['all']))?$note['all']:''; ?></textarea>

				            <div id="tagsname"></div>

				        </div>

				        <div class="col-lg-12 col-md-12 col-sm-12">

		            		<label for="company_name"><span style="color: red"></span>Internal</label>

		            		<textarea class="form-control m-input" name="internal"><?php echo (isset($note['internal']))?$note['internal']:''; ?></textarea>

				            <div id="tagsname"></div>

				        </div>

				        <div class="col-lg-12 col-md-12 col-sm-12">

		            		<label for="company_name"><span style="color: red"></span>Vendor</label>

		            		<textarea class="form-control m-input" name="owner"><?php echo (isset($note['owner']))?$note['owner']:''; ?></textarea>

				            <div id="tagsname"></div>

				        </div>

				        <div class="col-lg-12 col-md-12 col-sm-12">

		            		<label for="company_name"><span style="color: red"></span>Owner</label>

		            		<textarea class="form-control m-input" name="vendor"><?php echo (isset($note['vendor']))?$note['vendor']:''; ?></textarea>

				            <div id="tagsname"></div>

				        </div>

	            	</div>

	            	<div class="form-group m-form__group row m--margin-top-20">

						<div class="col-lg-12 col-md-12 col-sm-12">

							<button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

						</div>

					</div>

	            </form>

            </div>

            <div class="tab-pane" id="files" role="tabpanel">

            	<div class="tab-pane" id="m_portlet_base_demo_19_tab_content" role="tabpanel">

                    <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <h3>Upload Schedule Document</h3>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div id="validation_errors_upload_tab"></div>

                            <form enctype="multipart/form-data" method="post" id="excelUpload" action="<?php echo base_url().$uploadUrl?>" >

                                <div class="modal-body">

                                    <div class="alert hide excel-upload-response" style="color:#ff0000;"></div>

                                    <input type="file" name="uploadFile" id="customFile" value="<?php echo $scheduleDocument??'';?>" required>

                                    <div class="" style="display:inline;">

                                        <button type="submit" data-type="save" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>   

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>