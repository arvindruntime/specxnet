begin:: Page -->

<div class="m-grid m-grid--hor m-grid--root m-page">

  <!-- BEGIN: HEADER -->

  <?php echo $this->page->getPage('layout/header'); ?>

  <!-- END: HEADER -->    

</div>

<!-- end:: Page -->

<?php 

    $pageMenuArray = HEADER_ARRAY;

?>



<!-- begin::Body -->

<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

   <!-- BEGIN: Left Aside -->

   <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>

   <!-- END: Left Aside -->             

   <div class="m-grid__item m-grid__item--fluid m-wrapper">

      <!-- BEGIN: Subheader -->

      <?php echo $this->page->getPage('layout/body/body_header'); ?>

      <!-- END: Subheader -->         

      <div class="m-content">

         <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">

            <div class="m-portlet__head box-center1" align="center">

               <div class="m-portlet__head-caption">

                  <div class="m-portlet__head-title">

                     <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >

                        Projects List

                     </h3>

                  </div>

               </div>

            </div>

         </div>
		 
		<div class="form-group m-form__group row">
            <div class="col-lg-10 col-md-10 lead-bottommargin">
			
					<button type="button" id="AddProjectBtn" class="btn btn-success active" data-toggle="modal" data-target="#AddProjectModal" style="height: 35px;padding: .45rem 1.15rem; margin-right:10px;">Add Project</button>
					
			</div>
		</div>

         <div class="form-group m-form__group row">

            <div class="col-lg-10 col-md-10 lead-bottommargin">

                  <div class="m-dropdown__wrapper" style="z-index: 101;">

                     <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>

                     <div class="m-dropdown__inner">

                        <div class="m-dropdown__body">

                           <div class="m-dropdown__content">

                              <div class="col-lg-8 col-md-8 col-sm-122 lead-bottommargin">

                                    <!-- <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal">

                                      <span class="m-menu__link-badge">

                                        <span class="m-menu__link-icon call-form addOpportunity" data-url="<?php echo isset($newButton['modelUrl'])?base_url().$newButton['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $newButton['isModel']?>">

                                            <?php echo $newButton['name']?>

                                        </span>

                                      </span>                                             

                                  </button> -->

                                </div>

                           </div>

                        </div>

                     </div>

                  </div>

               

            </div>

            <?php echo $this->page->getPage('layout/body/body_action'); ?> 

         </div>

         <div style="margin-bottom: 0.5rem;">

            <div class="d-flex align-items-center">

               <div class="mr-auto margin_left">

               </div>

            </div>

         </div>

         



         <div class="modal fade" id="gridView" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;"> 

            <div class="modal-dialog modal-sm" role="document">

               <div class="modal-content">

                  <div class="modal-header">

                                    <h5 class="modal-title">Select Columns To View</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true" class="la la-remove"></span>

                                    </button>

                                 </div>

                                <form name="formgrid" id="feedInput" action="<?php echo base_url().'lead/create/gridview/'?>" method="POST" enctype="multipart/form-data">

                                    <div class="modal-body">

                                        <!--Div for Success/Alert message-->

                                       <table class="table table-bordered">

                                        <tr align="center">

                                            <th>Opportunity Title</th><td><input type="checkbox" name="internal[]" value="Name"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Created</th><td><input type="checkbox" name="internal[]" value="Role"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Contact</th><td><input type="checkbox" name="internal[]" value="Admin Access"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Status</th><td><input type="checkbox" name="internal[]" value="Login Enabled"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Age</th><td><input type="checkbox" name="internal[]" value="Auto Access"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Confidence</th><td><input type="checkbox" name="internal[]" value="Email"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>$ Est Revenue Min</th><td><input type="checkbox" name="internal[]" value="Phone"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>$ Est Revenue Max</th><td><input type="checkbox" name="internal[]" value="Phone"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>$ Last Contacted</th><td><input type="checkbox" name="internal[]" value="Phone"></td>

                                        </tr>

                                        <tr align="center">

                                            <th><b>Save For Future</b><input type="checkbox" name="ischeck" id="ischeck"></th><td><input type="text" name="saveGrid" id="saveGrid" disabled="true" required="" /></td>

                                        </tr>

                                        <tr>

                                            <th></th><td><input type="submit" value="Submit"></td>

                                        </tr>

                                       </table>

                                    </div>

                                 </form>

               </div>

            </div>

         </div>



         <div class="m-portlet m-portlet--mobile">

            <div class="m-portlet m-portlet--tabs">

               <div class="m-portlet__head">

                        <div class="m-portlet__head-tools">

                            <?php echo $this->page->getPage('layout/body/presale_tabs'); ?>

                        </div>

                </div>

               <div class="m-portlet__body tab-padding-top" style="padding: 0.8 rem 2.2rem">

                 

                <?php //echo $this->page->getPage('layout/tabs'); ?>

               </div>

               <div class="m-portlet__body3 mob-m-top-160">

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

<div class="modal fade" id="AddProjectModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;max-width: 1100px !important;">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Add Project

                    </h5>

                    <button type="button" class="close" id="closeItemButtonFTR" data-dismiss="addModal" aria-label="Close">

                        <span aria-hidden="true" class="la la-remove"></span>

                    </button>

                </div>

                <div id="validation_errors_rfq_worksheet"></div>

                <form enctype="multipart/form-data" method="post" class="m-form m-form--fit m-form--label-align-right">

                    <div id="replaceItemForm">

                        <div class="modal-body">
                            <div id="validation_errors_worksheet"></div>

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name"><span style="color:red;">* </span>Type</label>

                                    <input type="text" name="projects_types_id" id="projects_types_id" class="form-control m-input" value="" placeholder="Type" required="">

                                </div>
								
								<div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name"><span style="color:red;">* </span>Status</label>

                                    <input type="text" name="projects_types_id" id="projects_types_id" class="form-control m-input" value="" placeholder="Status" required="">

                                </div>
								
								<div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name"><span style="color:red;">* </span>Name</label>

                                    <input type="text" name="projects_types_id" id="projects_types_id" class="form-control m-input" value="" placeholder="Name" required="">

                                </div>
								
								<div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name"><span style="color:red;">* </span>Live Url</label>

                                    <input type="text" name="projects_types_id" id="projects_types_id" class="form-control m-input" value="" placeholder="Live Url" required="">

                                </div>
								
                            </div>


                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name"> Test Url</label>

                                    <input type="text" name="quantity" id="add_quantity" value="" class="form-control m-input" placeholder="Test Url">

                                    <span id="quantity_alert" style="color:red"></span>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Review Brief</label>

                                    <input type="text" name="fabric_quantity" id="add_fabric_quantity" value="" class="form-control m-input" placeholder="Review Brief">

                                    <span id="add_fabric_quantity_alert" style="color:red"></span>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Design</label>

                                    <input type="text" name="leather_quantity" id="add_leather_quantity" value="" class="form-control m-input" placeholder="Design">

                                    <span id="add_leather_quantity_alert" style="color:red"></span>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Development</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <input type="text" class="form-control m-input" placeholder="Development" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1">

                                    </div>

                                </div>
							</div>
							
							<div class="form-group m-form__group row m--margin-top-20">
								
								
								<div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Site Test</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <input type="text" class="form-control m-input" placeholder="Site Test" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1">

                                    </div>

                                </div>
								
								<div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">UAT</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <input type="text" class="form-control m-input" placeholder="UAT" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1">

                                    </div>

                                </div>
								

                                <div class="col-lg-6 col-md-6 col-sm-12">

                                    <label for="company_name">Description</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <textarea class="form-control m-input" placeholder="Description" id="add_note" value="" name="note" aria-describedby="basic-addon1" rows="3" cols="3"></textarea>

                                    </div>

                                </div>

                            </div>

                            <hr />

                            <input type="hidden" name="fk_b_id" id="fk_b_id" value="<?php echo isset($b_id) ? $b_id : ''; ?>">							
							

                            <input type="hidden" name="bw_id" id="bw_id" value="">

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div id="company_type"></div>

                                    <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->

                                    <button type="button" data-type="save_n_close" id="AddProjectAction" class="btn btn-primary m-btn" style="font-family: sans-serif, Arial;">Save</button>

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


