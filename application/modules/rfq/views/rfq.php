<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: HEADER -->
    <?php echo $this->page->getPage('layout/header'); ?>
    <!-- END: HEADER -->
</div>
<!-- end:: Page -->
<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <!-- BEGIN: Left Aside -->
    <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
    <!-- END: Left Aside -->
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader displaynone">
            <div class="d-flex align-items-center">
                <!-- Alert for Delete & Import Excel -->
                <?php
                $msg = '';
                $msg = $this->session->userdata('setMessage');
                if (isset($msg) && $msg == 'Added') { ?>
                    <div id="deleteMsg">
                        <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> RFQ Added Successfully</div>
                    </div>
                    <?php
                } if (isset($msg) && $msg == 'Updated') { ?>
                    <div id="deleteMsg">
                        <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> RFQ Updated Successfully</div>
                    </div>
                    <?php
                } if (isset($msg) && $msg == 'Imported') { ?>
                    <div id="deleteMsg">
                        <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> RFQ Data Imported Successfully</div>
                    </div>
                    <?php
                }
                $this->session->unset_userdata('setMessage');?>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">
                <div class="m-portlet__head box-center1" align="center">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >
                                RFQ
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-10 col-md-10 col-sm-122 lead-bottommargin">
                    <?php
                    if ($addPermission) { ?>
                        <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal">
                            <span class="m-menu__link-badge">
                                <span class="m-menu__link-icon call-form" data-url="<?php echo base_url().'rf/form'; ?>" data-toggle="modal" data-target="#modal">
                                    New RFQ
                                </span>
                            </span>
                        </button>
                    <?php }?>
                </div>
                <?php echo $this->page->getPage('layout/body/body_action'); ?>
            </div>
            <div style="margin-bottom: 0.5rem;">
                <div class="d-flex align-items-center">
                    <div class="mr-auto margin_left">
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_7" role="tablist">
                    <!--begin::Item-->
                    <div class="m-accordion__item">
                        <div class="m-accordion__item-head collapsed <?php if (isset($getFilterData)) { echo 'in show';}?>" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">
                            <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>
                            <span class="m-accordion__item-title">Filter Your Results</span>
                            <span class="m-accordion__item-mode"></span>
                        </div>
                        <div class="m-accordion__item-body collapse <?php if (isset($getFilterData) && $getFilterData !='') { echo 'in show'; }?>" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">
                            <div class="m-accordion__item-content">
                                <div class="m-portlet__head" style="padding: 0">
                                    <div class="m-portlet__head-tools">
                                        <div class="col-lg-12 col-md-12 col-sm-12" align="right" style="padding-top: 10px">
                                            <div style="width:194px;">
                                                <select class="form-control greyborder filter" name="">
                                                    <option value="">Standard Filter</option>
                                                    <?php
                                                    foreach ($getSavedFilter as $key => $value) { ?>
                                                        <option value="<?php echo $value['filter_id'];?>" <?php if (isset($savedfilterID) && $savedfilterID == $value['filter_id']) { echo 'selected'; } ?>><?php echo $value['filter_name'];?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="<?php echo base_url();?>rfq" method="post" class="m-form m-form--fit m-form--label-align-right" id="getFilter">
                                    <div id="replaceFilter">
                                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom:0">
                                            <div class="col-lg-2 col-md-2 col-sm-3">
                                                <label class="form-control-label padtop3">Opportunity Status</label>
                                                <div>
                                                    <select class="form-control greyborder" name="opportunity_status" id="opportunity_status">
                                                        <option value="">--Select Status--</option>
                                                        <option value="active" <?php echo (isset($getFilterData['opportunity_status']) && $getFilterData['opportunity_status']=='active')?'selected':''; ?>>Active</option>
                                                        <option value="inactive" <?php echo (isset($getFilterData['opportunity_status']) && $getFilterData['opportunity_status']=='inactive')?'selected':''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-3">
                                                <label class="form-control-label">Submission Deadline</label>
                                                <?php
                                                if(isset($getFilterData['approval_deadline']) && $getFilterData['approval_deadline'] != '') {
                                                    ?>
                                                    <input type="text" name="approval_deadline" id="approval_deadline" class="form-control m-input datepicker" value="<?php echo isset($getFilterData['approval_deadline'])?date('Y-m-d',strtotime($getFilterData['approval_deadline'])):''; ?>">
                                                <?php } else {?>
                                                    <input type="text" name="approval_deadline" id="approval_deadline" class="form-control m-input datepicker" placeholder="Submission Deadline" value="">
                                                <?php }?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding:0 2rem">
                                        <div class="m-form__actions">

                                            <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>
                                            <a type="button" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey" href="<?php echo base_url().'rfq';?>">Reset</a>
                                            <button type="button" class="btn green m-btn m-btn--custom" data-toggle="modal" data-target="#mySaveFilterModal">Save Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Section-->
            </div>
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <?php echo $this->page->getPage('layout/body/presale_tabs'); ?>
                        </div>
                    </div>
                    <div class="m-portlet__body tab-padding-top" style="padding: 0.8 rem 2.2rem">
                        <?php echo $this->page->getPage('layout/tabs'); ?>
                    </div>
                    <div class="m-portlet__body3">
                        <div class="col-md-12 no-padding">
                            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                            </table>
                        </div>
                    </div>
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<div class="modal fade" id="gridView" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Columns To View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <form name="formgrid" id="feedInput" action="<?php echo base_url().'rfq/createGrid'?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!--Div for Success/Alert message-->
                    <table class="table table-bordered">
                        <tr align="center">
                            <th>RFQ Title</th><td><input type="checkbox" name="internal" value="RFQ Title"></td>
                        </tr>
                        <tr align="center">
                            <th>RFQ Status</th><td><input type="checkbox" name="internal" value="RFQ Status"></td>
                        </tr>
                        <tr align="center">
                            <th>Opportunity Title</th><td><input type="checkbox" name="internal" value="Opportunity Title"></td>
                        </tr>
                        <tr align="center">
                            <th>Submission Deadline</th><td><input type="checkbox" name="internal" value="Submission Deadline"></td>
                        </tr>
                        <tr align="center">
                            <th><b>Save For Future</b><input type="checkbox" name="ischeck" id="ischeck"></th><td><input type="text" name="saveGrid" id="saveGrid" disabled="true" required="" /></td>
                        </tr>
                        <tr>
                            <th></th><td><input type="button" value="Submit" onclick="createGridTable()"></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<!----Save Filter Model--->

<div class="modal fade" id="mySaveFilterModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Save Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <form name="saveFilter" id="saveFilter" class="m-form m-form--fit m-form--label-align-right">
                <div class="modal-body">
                    <!--Div for Success/Alert message-->
                    <div id="validation_errors"></div>
                    <div class="form-group m-form__group row m--margin-top-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="company_name">Filter Name</label>
                            <input type="text" name="filter_name" id="filter_name" class="form-control m-input" placeholder="Filter Name" required>
                        </div>
                    </div>

                    <div class="form-group m-form__group row m--margin-top-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="button" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;" id="saveMyFilter">Save</button>
                            <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Code added by arvind //-->
<div class="modal fade" id="RFQstatusModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;max-width: 1100px !important;">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="item_header">

                        Update RFQ Status

                    </h5>

                    <button type="button" class="close" id="closeRFQstatusModal" data-dismiss="RFQstatusModal" aria-label="Close">

                        <span aria-hidden="true" class="la la-remove"></span>

                    </button>

                </div>

                <div id="validation_errors_rfq_worksheet"></div>

                <form method="post" id="" class="m-form m-form--fit m-form--label-align-right">

                    <div id="replaceItemForm">

                        <div class="modal-body">
                            <div id="validation_errors"></div>

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">RFQ Status</label>

                                    <select name="rfq_status" id="rfq_status" class="form-control">
                                        <option value="Drafted">Drafted</option>
                                        <option value="Open">Open</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Close">Close</option>
                                        
                                    </select>
									<!--<option value="Re Bid">Re Bid</option>-->

                                    <span id="rfq_status_alert" style="color:red"></span>

                                </div>

                                

                                <div class="col-lg-6 col-md-6 col-sm-12">

                                    <label for="company_name">Remark</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <textarea class="form-control m-input" placeholder="Remark" id="rfq_remark" value="" name="rfq_remark" aria-describedby="basic-addon1" rows="10" cols="10"></textarea>

                                    </div>

                                </div>

                            </div>

                            <hr />

<input type="hidden" name="bw_id" id="bw_id" value="">
							
                           

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div id="company_type"></div>

                                    <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->

                                    <button type="button" data-type="save_n_close" class="btn btn-primary m-btn" id="updateRFQStatus1" style="font-family: sans-serif, Arial;">Update</button>

                                    <span id="itemSuccessMessage" style="color: green;margin-left: 20px;"></span>

                                    <!-- <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button> -->

                                </div>

                            </div>

                        </div>

                    </div>

                </form>



            </div>

        </div>

    </div>


<script>
window.moduleType = "<?php echo "rfq"; ?>";
window.moduleTabs = <?php echo json_encode($tabs); ?>;
window.column = <?php echo json_encode($rfqColumn); ?>;
window.customeFilter = '?q=<?php echo json_encode($getFilterData); ?>';
</script>
