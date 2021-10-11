<!-- begin:: Page -->

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

         <div class="m-portlet m-portlet2 box-center1 m-top-50" style="margin-bottom:0.5rem;">

            <div class="m-portlet__head box-center1" align="center">

               <div class="m-portlet__head-caption">

                  <div class="m-portlet__head-title">

                     <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >

                     Lead Inquiry

                     </h3>

                  </div>

               </div>

            </div>

         </div>

         <div class="form-group m-form__group row">

            <div class="col-lg-10 col-md-10 lead-bottommargin">

                <?php

                if ($addPermission) { ?>

                  <div class="m-dropdown__wrapper" style="z-index: 101;">

                     <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>

                     <div class="m-dropdown__inner">

                        <div class="m-dropdown__body">

                           <div class="m-dropdown__content">

                              <div class="col-lg-8 col-md-8 col-sm-122 lead-bottommargin">

                                    <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal">

                                      <span class="m-menu__link-badge">

                                        <span class="m-menu__link-icon call-form addOpportunity" data-url="<?php echo isset($newButton['modelUrl'])?base_url().$newButton['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $newButton['isModel']?>">

                                            <?php echo $newButton['name']?>

                                        </span>

                                      </span>

                                  </button>

                                </div>

                           </div>

                        </div>

                     </div>

                  </div>

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

                  <div class="m-accordion__item-head <?php echo empty($filter)?'collapsed':''; ?>" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">

                     <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>

                     <span class="m-accordion__item-title">Filter Your Results</span>

                     <span class="m-accordion__item-mode"></span>

                  </div>

                  <div class="m-accordion__item-body collapse <?php echo !empty($filter)?'in show':''; ?>" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">

                     <div class="m-accordion__item-content">

                        <?php echo $this->page->getPage('layout/body/body_filtre_data'); ?>

                        <form action="lead" method="post" class="m-form m-form--fit m-form--label-align-right">

                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">



                           <div class="col-lg-2 col-md-4 col-sm-4">

                              <label class="form-control-label">Customer Name</label>

                              <input type="text" name="filter[contact_info]" id="filterCustName" class="form-control m-input" placeholder="" value="<?php echo isset($filter['contact_info'])?$filter['contact_info']:''; ?>">

                           </div>

                           <div class="col-lg-2 col-md-4 col-sm-4">

                              <label class="form-control-label">Lead Generated By</label>

                              <select class="form-control greyborder"  id="filter_sales_people" name="filter[fk_sales_people_id]">

                                  <option data-tokens="Menu1" value="">--All--</option>

                                      <?php

                                        foreach ($salesPerson as $SalesP) {

                                        ?>

                                    <option value="<?php echo $SalesP['sales_people_id'];?>" <?php if (isset($filter['fk_sales_people_id']) && $SalesP['sales_people_id'] == $filter['fk_sales_people_id']) { echo "selected";}?> ><?php echo ucwords($SalesP['name']);?></option>

                                    <?php

                                        }?>

                              </select>

                           </div>

                           <div class="col-lg-2 col-md-4 col-sm-4">

                              <label class="form-control-label">Status</label>

                              <select class="form-control" id="filterStatus" name="filter[status]">

                                <option value=""> --All-- </option>

                                <option value="open" <?php if (isset($filter['status']) && $filter['status'] == 'open') { echo "selected";} ?> >Open</option>

                                <option value="urgent" <?php if (isset($filter['status']) && $filter['status']== 'urgent') { echo "selected";} ?> >Urgent</option>

                                <option value="close" <?php if (isset($filter['status']) && $filter['status']== 'close') { echo "selected";}?> >Close</option>

                            </select>

                           </div>

                           <div class="col-lg-2 col-md-4 col-sm-4">

                              <label class="form-control-label">Age Of Lead</label>

                              <select name="filter[age]" id="filterAge" class="form-control m-input pages_titleType">

                                  <option value=""> --All-- </option>

                                  <option value="today" <?php if (isset($filter['age']) && $filter['age'] == 'today') {echo 'selected';}?>>Today</option>

                                  <option value="yesterday" <?php if (isset($filter['age']) && $filter['age'] == 'yesterday') {echo 'selected';}?>>Yesterday</option>

                                  <option value="this_week" <?php if (isset($filter['age']) && $filter['age'] == 'this_week') {echo 'selected';}?>>This Week</option>

                                  <option value="this_month" <?php if (isset($filter['age']) && $filter['age'] == 'this_month') {echo 'selected';}?>>This Month</option>

                              </select>

                           </div>



                           <div class="col-lg-3 col-md-4 col-sm-4">

                              <label class="form-control-label">Projected Contract date</label>

                              <select class="form-control" id="filter_projected_sales_date" name="filter[projected_sales_date]">

                                <option value=""> --All-- </option>

                                <option value="today" <?php if (isset($filter['projected_sales_date']) && $filter['projected_sales_date'] == 'today') {echo 'selected';}?>>Today</option>

                                <option value="tomorrow" <?php if (isset($filter['projected_sales_date']) && $filter['projected_sales_date'] == 'tomorrow') {echo 'selected';}?>>Tomorrow</option>

                                <option value="this_week" <?php if (isset($filter['projected_sales_date']) && $filter['projected_sales_date'] == 'this_week') {echo 'selected';}?>>This Week</option>

                                <option value="this_month" <?php if (isset($filter['projected_sales_date']) && $filter['projected_sales_date'] == 'this_month') {echo 'selected';}?>>This Month</option>

                            </select>

                           </div>





                        </div>

                        <div class="row" style="padding:0 2rem">

                          <div class="" style="padding-bottom: 30px;">

                              <input type="hidden" name="filter[saved_filter_id]" id="saved_filter_id" value="">

                              <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>

                              <a href="<?php echo base_url().'lead'; ?>" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey">Reset</a>

                              <button type="button" class="btn green m-btn m-btn--custom" data-toggle="modal" id="savefilter">Save Filter</button>

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

                                            <th>Opportunity Type</th><td><input type="checkbox" name="internal[]" value="Name"></td>

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

                                            <th>Conversion Probability</th><td><input type="checkbox" name="internal[]" value="Email"></td>

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

<script>

  window.userType = "<?php echo $userType; ?>";

  window.moduleType = "<?php echo "leadOpportunity"; ?>";

  <?php

    if (isset($filter)) {

  ?>

  window.customeFilter = '?q=<?php echo isset($filter)?json_encode($filter):''; ?>';



<?php } else { ?>

  window.customeFilter = '?q=<?php echo isset($userWise)?json_encode($userWise):''; ?>';

  <?php } ?>

  window.moduleTabs = <?php echo json_encode($tabs); ?>;

  window.column = <?php echo json_encode($leadOpportunityColumn); ?>;



</script>
