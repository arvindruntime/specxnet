<div class="m-portlet__body margin-top2" style="">
    <div class="tab-content">
        <!-- <div class="modal-body"> -->
        <div id="validation_errors_delete"></div>
        <div class="tab-pane active show" id="m_portlet_base_demo_15_tab_content" role="tabpanel">
            <div id="validation_errors_rfq"></div>
            <div class="form-group m-form__group row m--margin-top-20">
                <div class="col-md-6">
                    <div class="col-lg-12 col-md-12 col-sm-12 padtop4">
                        <label for="street_address"><strong>Project Name: </strong><?php echo $value['project_name']; ?></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 padtop4">
                        <label for="street_address"><strong>Customer Company Name: </strong><?php echo $value['company_name']; ?></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 padtop4">
                        <label for="street_address"><strong>Internal Company Name:</strong> <?php echo $value['internalcompany']; ?></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="street_address"><strong>Opportunity Title: </strong> <?php echo $value['opportunity_title']; ?></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 padtop4">
                        <label for="street_address"><strong>Submission Deadline: </strong><?php echo isset($value['approval_deadline']) ? date("d M Y g:i A",strtotime($value['approval_deadline'])) : ''; ?></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 padtop4">
                        <label for="street_address"><strong> Notes: </strong><?php echo isset($value['notes']) ? $value['notes'] : ''; ?></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="street_address"><strong>Download Document:</strong></label>
                    <?php if (!empty($attachment['result'])) {
                        foreach ($attachment['result'] as $doc) {
                            $name = $doc['name'];
                            if ($doc['type'] == 'attachment') {
                                $file_url = "upload/addItemImages/" . $doc['name'];
                                echo "<p><a href='" . $file_url . "' target='_blank'>" . $name . "</a></p>";
                            }
                        }
                    } else {
                        echo "<p>No Files Uploaded.</p>";
                    } ?>
                    <label for="street_address"><strong>Download Images:</strong></label>
                    <?php 
						//print_r($attachment);
					if (!empty($attachment['result'])) {
                        foreach ($attachment['result'] as $doc) {
                            if ($doc['type'] == 'imageAttachment') {
                                $name = $doc['name'];
                                $file_url = "upload/addItemImages/" . $doc['name'];
                                echo "<p><a href='" . $file_url . "' target='_blank'>" . $name . "</a></p>";
                            }
                        }
                    } else {
                        echo "<p>No Images Uploaded.</p>";
                    } ?>
                    <label for="street_address"><strong>Download Specification:</strong></label>
                    <a type='button' onclick="downloadItem(<?php echo $value['b_id']; ?>)" style="cursor:pointer;"><i class="fas fa-file-download"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
