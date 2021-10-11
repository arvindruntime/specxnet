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

                <div class="mr-auto">

                    <!-- <a class="m-subheader__title m-subheader__title--separator" href="index.php"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsive"></a>            -->

                </div>

                <!-- Alert for Delete & Import Excel -->

                <?php

                    $msg = '';

                    $msg = $this->session->userdata('setMessage');

                     if (isset($msg) && $msg == 'Added') { ?>

                <div id="deleteMsg">

                    <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> Proposal Added Successfully</div>

                </div>

                <?php 

                    } if (isset($msg) && $msg == 'Updated') { ?>

                <div id="deleteMsg">

                    <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> Proposal Successfully</div>

                </div>

                <?php 

                    } if (isset($msg) && $msg == 'Imported') { ?>

                <div id="deleteMsg">

                    <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> Proposal Data Imported Successfully</div>

                </div>

                <?php 

                    } if (isset($msg) && $msg == 'deleted') { ?>

                <div id="deleteMsg">

                    <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> Proposal(s) Data Deleted Successfully</div>

                </div>

                <?php 

                    }

                    $this->session->unset_userdata('setMessage');?>

                <div>

                </div>

            </div>

        </div>

        <!-- END: Subheader -->           

        <div class="m-content">

            <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">

                <div class="m-portlet__head box-center1" align="center">

                    <div class="m-portlet__head-caption">

                        <div class="m-portlet__head-title">

                            <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >

                                Invoice

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

            <div class="form-group m-form__group row">

                <div class="col-lg-10 col-md-10 col-sm-122 lead-bottommargin">

                    <!-- <button type="button" class="btn green m-btn m-btn--custom col-sm-122 proposalPopup" data-url="<?php echo base_url().'proposal/form'; ?>" data-toggle="modal" data-target="#modal">

                        New Proposal

                    </button> -->

                    <?php 

                if ($addPermission) { ?>

                    <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal">

                        <span class="m-menu__link-badge">

                            <span class="m-menu__link-icon call-form" data-url="<?php echo base_url().'prop/form'; ?>" data-toggle="modal" data-target="#modal">

                                New Invoice

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

                        <div class="m-accordion__item-head collapsed <?php if (isset($getFilterData)) {

                            echo 'in show';

                        }?>" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">

                            <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>

                            <span class="m-accordion__item-title">Filter Your Results</span>

                            <span class="m-accordion__item-mode"></span>     

                        </div>

                        <div class="m-accordion__item-body collapse <?php if (isset($getFilterData) && $getFilterData !='') {

                            echo 'in show';

                        }?>" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">

                            <div class="m-accordion__item-content">

                                <div class="m-portlet__head" style="padding: 0">

                                    <div class="m-portlet__head-tools">

                                        <div class="col-lg-12 col-md-12 col-sm-12" align="right" style="padding-top: 10px">

                                            <div style="width:194px;">

                                                <select class="form-control greyborder filter" name="">

                                                    <option value="">Standard Filter</option>

                                                    <?php

                                                        foreach ($getSavedFilter as $key => $value) { ?>

                                                            <option value="<?php echo $value['filter_id'];?>"><?php echo $value['filter_name'];?></option>

                                                    <?php }

                                                    ?>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <form action="<?php echo base_url();?>proposal" method="post" class="m-form m-form--fit m-form--label-align-right" id="getFilter">

                                    <div id="replaceFilter">

                                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom:0">

                                            <!-- <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label">Lead Opportunity Title</label>

                                                <input type="text" name="lead_opportunity" class="form-control m-input" placeholder="" value="<?php echo isset($getFilterData['lead_opportunity'])?$getFilterData['lead_opportunity']:''; ?>">

                                            </div> -->

                                            <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label">Proposal Status</label>

                                                <div>

                                                    <select class="form-control greyborder" name="status" id="status">

                                                        <option value="">--Select Status--</option>

                                                        <option value="Drafted" <?php echo (isset($getFilterData['status']) && $getFilterData['status']=='Drafted')?'selected':''; ?>>Drafted</option>

                                                        <option value="Released" <?php echo (isset($getFilterData['status']) && $getFilterData['status']=='Released')?'selected':''; ?>>Released</option>

                                                        <option value="Approved" <?php echo (isset($getFilterData['status']) && $getFilterData['status']=='Approved')?'selected':''; ?>>Approved</option>

                                                        <option value="Declined" <?php echo (isset($getFilterData['status']) && $getFilterData['status']=='Declined')?'selected':''; ?>>Declined</option>

                                                    </select>

                                                </div>

                                            </div>

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

                                                <label class="form-control-label">Approval Deadline</label>

                                                <!-- <div>

                                                    <div class="input-group m-input-group m-input-group--square">

                                                        <div class="input-group-prepend">

                                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">

                                                            <i class="fa fa-dollar-sign"></i>

                                                            </span>

                                                        </div>

                                                        <input type="text" class="form-control m-input" placeholder="Amount" aria-describedby="basic-addon1">

                                                    </div>

                                                </div> -->



                                                <?php

                                                        if(isset($getFilterData['approval_deadline']) && $getFilterData['approval_deadline'] != '') {

                                                    ?>

                                                    <input type="text" name="approval_deadline" id="approval_deadline" class="form-control m-input datepicker" value="<?php echo isset($getFilterData['approval_deadline'])?date('Y-m-d',strtotime($getFilterData['approval_deadline'])):''; ?>">

                                                <?php } else {?>

                                                    <input type="text" name="approval_deadline" id="approval_deadline" class="form-control m-input datepicker" placeholder="Approval Deadline" value="">

                                                <?php }?>

                                            </div>

                                            <!-- <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label padtop3">Salesperson</label>

                                                <div>

                                                    <select class="form-control greyborder" name="sales_person" id="sales_person">

                                                        <option value="">--Select Salesperson--</option>

                                                        <?php

                                                            foreach ($getSalesperson as $key => $value) { ?>

                                                                <option value="<?php echo $value['user_id'];?>" <?php echo (isset($getFilterData['sales_person']) && $getFilterData['sales_person']==$value['user_id'])?'selected':''; ?>><?php echo $value['name'];?></option>

                                                        <?php }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div> -->

                                            <!-- <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label padtop3">Last Amount</label>

                                                <div>

                                                    <select class="form-control greyborder" name="">

                                                        <option value="Checked Action" selected="">All Items Selected</option>

                                                        <option value="fluid">Menu 1</option>

                                                        <option value="boxed">Menu 2</option>

                                                    </select>

                                                </div>

                                            </div> -->

                                        </div>

                                        <!-- <div class="form-group m-form__group row" style="padding:0 1rem;">



                                            <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label padtop3">Source</label>

                                                <div>

                                                    <select class="form-control greyborder" name="">

                                                        <option value="Checked Action" selected="">All Items Selected</option>

                                                        <option value="fluid">Menu 1</option>

                                                        <option value="boxed">Menu 2</option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-lg-2 col-md-2 col-sm-3">

                                                <label class="form-control-label padtop3">Job Type</label>

                                                <div>

                                                    <select class="form-control greyborder" name="">

                                                        <option value="Checked Action" selected="">All Items Selected</option>

                                                        <option value="fluid">Menu 1</option>

                                                        <option value="boxed">Menu 2</option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div> -->

                                    </div>

                                    <div class="row" style="padding:0 2rem">

                                        <div class="m-form__actions">

                                            <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>

                                            <a type="button" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey" href="<?php echo base_url().'proposal';?>">Reset</a>

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

                        <div class="col-md-12">

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

        <form name="formgrid" id="feedInput" action="<?php echo base_url().'proposal/createGrid'?>" method="POST" enctype="multipart/form-data">

            <div class="modal-body">

                <!--Div for Success/Alert message-->

               <table class="table table-bordered">

                <tr align="center">

                    <th>Proposal Title</th><td><input type="checkbox" name="internal" value="Proposal Title"></td>

                </tr>

                <tr align="center">

                    <th>Opportunity Title</th><td><input type="checkbox" name="internal" value="Opportunity Title"></td>

                </tr>

                <tr align="center">

                    <th>Sales Person</th><td><input type="checkbox" name="internal" value="Sales Person"></td>

                </tr>

                <tr align="center">

                    <th>Approval Deadline</th><td><input type="checkbox" name="internal" value="Approval Deadline"></td>

                </tr>

                <tr align="center">

                    <th>Total Price(Ex-Factory)</th><td><input type="checkbox" name="internal" value="Total Price(Ex-Factory)"></td>

                </tr>

                <tr align="center">

                    <th>Total Price(Fabrics)</th><td><input type="checkbox" name="internal" value="Total Price(Fabrics)"></td>

                </tr>

                <tr align="center">

                    <th>Total Price(Leather)</th><td><input type="checkbox" name="internal" value="Total Price(Leather)"></td>

                </tr>

                <tr align="center">

                    <th>Proposal Status</th><td><input type="checkbox" name="internal" value="Proposal Status"></td>

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

                <div id="validation_errors_proposal"></div>

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





<script>

    window.moduleType = "<?php echo "proposal"; ?>";

    window.moduleTabs = <?php echo json_encode($tabs); ?>;

    window.column = <?php echo json_encode($proposalColumn); ?>;

    window.customeFilter = '?q=<?php echo json_encode($getFilterData); ?>';

    window.base_url = '<?php echo base_url(); ?>';

</script>