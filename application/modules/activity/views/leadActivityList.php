<style type="text/css">

  .notification {

  /*background-color: #555;

  color: white;*/

  text-decoration: none;

  padding: 0px 14px;

  position: relative;

  display: inline-block;

  border-radius: 2px;

}



/*.notification:hover {

  background: red;

}*/



.notification .badge {

  position: absolute;

  top: -10px;

  right: -10px;

  padding: 5px 10px;

  border-radius: 50%;

  background-color: red;

  color: white;

}

</style>



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

         <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">

            <div class="m-portlet__head box-center1" align="center">

               <div class="m-portlet__head-caption">

                  <div class="m-portlet__head-title">

                     <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >

                        Lead Activity

                     </h3>

                  </div>

               </div>

            </div>

         </div>

         <div class="form-group m-form__group row">

            <div class="col-lg-10 col-md-10 lead-bottommargin">

               <div class="m-dropdown m-dropdown--inline m-dropdown--arrow  m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="display: block">

                  <div class="m-dropdown__inner">

                        <div class="m-dropdown__body">

                           <div class="m-dropdown__content">

                                <div class="col-lg-8 col-md-8 col-sm-122 lead-bottommargin">

                                    <button type="button" class="btn green m-btn m-btn--custom col-sm-122" data-toggle="modal" data-target="#m_select_modal">

                                      <span class="m-menu__link-badge">

                                        <span class="m-menu__link-icon call-form" data-url="<?php echo isset($newButton['modelUrl'])?base_url().$newButton['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $newButton['isModel']?>">

                                            <?php echo $newButton['name']?>

                                        </span>

                                      </span>                                             

                                  </button>

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

                      <?php echo $this->page->getPage('layout/body/body_filtre_data'); ?> 

                      <form action="" method="post" class="m-form m-form--fit m-form--label-align-right" id="getFilter">

                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">

                           <div class="col-lg-3 col-md-3 col-sm-4">

                              <label class="form-control-label">Activity Type</label>

                              <select class="form-control" id="filterActivityType" name="filter[activity_type]">

                                <option value=""> --Select Activity Type-- </option>

                                <option value="Phone Call" <?php if (isset($filter['activity_type']) && $filter['activity_type'] == 'Phone Call') { echo "selected";} ?> >Phone Call</option>

                                <option value="Email" <?php if (isset($filter['activity_type']) && $filter['activity_type']== 'Email') { echo "selected";} ?> >Email</option>

                            </select>

                           </div>



                           <div class="col-lg-3 col-md-3 col-sm-4">

                              <label class="form-control-label">Activity Status</label>

                              <select class="form-control" id="filterStatus" name="filter[status]">

                                <option value=""> --Select Status-- </option>

                                <option value="Past Due" <?php if (isset($filter['status']) && $filter['status'] == 'Past Due') { echo "selected";} ?> >Past Due</option>

                                <option value="Complete" <?php if (isset($filter['status']) && $filter['status']== 'Complete') { echo "selected";} ?> >Complete</option>

                                <option value="Incomplete" <?php if (isset($filter['status']) && $filter['status']== 'Incomplete') { echo "selected";}?> >Incomplete</option>

                            </select>

                           </div>



                           <div class="col-lg-3 col-md-3 col-sm-4">

                              <label class="form-control-label">Assigned User</label>

                              

                              <select class="form-control greyborder"  id="filterAssigfgnedUSer" name="filter[assigned_by]">

                                <option value="">--Please Select--</option>

                                <?php

                                  foreach ($salesPerson as $key => $Salesperson) { ?>

                                <option value="<?php echo $Salesperson['user_id'];?>" <?php if ($filter['assigned_by']==$Salesperson['user_id']) { echo "selected";}?> > <?php echo $Salesperson['first_name']." ".$Salesperson['last_name'];?></option>

                              <?php

                                  }?>

                              </select>

                           </div>

                    

                        </div>

                        <div class="row" style="padding:0 2rem">

                          <div class="" style="padding-bottom: 30px;">

                            <input type="hidden" name="filter[saved_filter_id]" id="saved_filter_id" value="">

                              <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>

                              <a href="<?php echo base_url().'activity'; ?>" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey">Reset</a>

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

            <div class="modal-dialog" role="document">

               <div class="modal-content">

                  <div class="modal-header">

                                    <h5 class="modal-title">Select Columns To View</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true" class="la la-remove"></span>

                                    </button>

                                 </div>

                                <form name="formgrid" id="feedInput" action="<?php echo base_url().'activity/create/gridview/'?>" method="POST" enctype="multipart/form-data">

                                    <div class="modal-body">

                                        <!--Div for Success/Alert message-->

                                       <table class="table table-bordered">

                                        <tr align="center">

                                            <th>Name</th><td><input type="checkbox" name="internal[]" value="Name"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Role</th><td><input type="checkbox" name="internal[]" value="Role"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Admin Access</th><td><input type="checkbox" name="internal[]" value="Admin Access"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Login Enabled</th><td><input type="checkbox" name="internal[]" value="Login Enabled"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Auto Access</th><td><input type="checkbox" name="internal[]" value="Auto Access"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Email</th><td><input type="checkbox" name="internal[]" value="Email"></td>

                                        </tr>

                                        <tr align="center">

                                            <th>Phone</th><td><input type="checkbox" name="internal[]" value="Phone"></td>

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

 

         <div class="m-content">

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

</div>

                   

<!-- begin::Scroll Top -->

<div id="m_scroll_top" class="m-scroll-top">

  <i class="la la-arrow-up"></i>

</div>

<!-- end::Scroll Top -->



<script>

  window.userType = "<?php echo $userType; ?>";

  window.moduleType = "<?php echo "leadActivity"; ?>"; 

  window.customeFilter = '?q=<?php echo isset($filter)?json_encode($filter):''; ?>';

  window.moduleTabs = <?php echo json_encode($tabs); ?>;

  window.column = <?php echo json_encode($activityColumn); ?>;

</script>