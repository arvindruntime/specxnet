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
      <?php echo $this->page->getPage('layout/body/body_header'); ?>
      <!-- END: Subheader -->		      
      <div class="m-content">
         <div class="m-portlet m-portlet2 box-center1" style="margin-bottom:0.5rem;">
            <div class="m-portlet__head box-center1" align="center">
               <div class="m-portlet__head-caption">
                  <div class="m-portlet__head-title">
                     <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center">
                        
                        <?php if($userType== 'internal') {?>  Internal User <?php } ?>
                        <?php if($userType== 'supplier') {?>  Supplier User <?php } ?>
                        <?php if($userType== 'customer') {?>  Customer User (Client)<?php } ?>
                     </h3>
                  </div>
               </div>
            </div>
        </div>
        <div class="form-group m-form__group row">
          <div class="col-lg-10 col-md-10 lead-bottommargin">
            <?php 
              if ($addPermission) {
                foreach($newButton as $keyChildren => $valueChildren) {
                  if ($module_type == 'internal') {
                      $module_type = 'Internal Users';
                  } else if ($module_type == 'supplier') {
                    $module_type = 'Suppliers';
                  }
                   else if ($module_type == 'customer') {
                    $module_type = 'Customer Contact';
                  }
                  ?>
                    <?php if(isset($valueChildren['allowAdd']) && $valueChildren['name'] == $module_type) { ?>                   
                      <div class="m-menu__link-badge">
                        <button class="btn green m-btn m-btn--custom new-btn2 m-menu__link-icon call-form" data-url="<?php echo isset($valueChildren['modelUrl'])?base_url().$valueChildren['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel']?>">
                            New
                        </button>
                      </div>
                <?php }}} ?>
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
                  <div class="m-accordion__item-head collapsed <?php if (isset($filter)) {
                            echo 'in show';
                        }?>" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">
                     <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>
                     <span class="m-accordion__item-title">Filter Your Results</span>
                     <span class="m-accordion__item-mode"></span>     
                  </div>
                  <div class="m-accordion__item-body collapse <?php if (isset($filter) && $filter !='') {
                            echo 'in show';
                        }?>" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">
                     <div class="m-accordion__item-content">
                        <?php echo $this->page->getPage('layout/body/body_filtre_data'); ?>
                        <form action="" method="post" class="m-form m-form--fit m-form--label-align-right" id="getFilter"> 
                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">User Name</label>
                              <input type="text" name="filter[full_name]" id="filterfullname" class="form-control m-input" placeholder="Enter Name" value="<?php echo isset($filter['full_name'])?$filter['full_name']:''; ?>">
                           </div>
                           <!-- <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">Last Name</label>
                              <input type="text" name="filter[last_name]" id="filterlastName" class="form-control m-input" placeholder="Enter Last Name" value="<?php echo isset($filter['last_name'])?$filter['last_name']:''; ?>">
                           </div> -->
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">User Status</label>
                              	<select class="form-control greyborder" id="filterStatus" name="filter[userStatus]">
									<option data-tokens="Menu1" value="">--Select User Status--</option>
									<option value="active" <?php if (isset($filter['userStatus']) && $filter['userStatus'] == 'active') { echo "selected";}?>>Active</option>
									<option value="inactive"  <?php if (isset($filter['userStatus']) && $filter['userStatus'] == 'inactive') { echo "selected";}?>>Inactive</option>

								</select>
                           </div>
                           <?php if($userType== 'internal') {?> 
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">Role</label>
                              <div>
                                 <select class="form-control greyborder" id="filterRoleId" name="filter[roleId]">
                                    <option data-tokens="Menu1" value="">--Select Role--</option>
                                      <?php
                                          foreach ($rolesFilter as $fkRole) {
                                          ?>
                                      <option value="<?php echo $fkRole['role_id'];?>" <?php if (isset($filter['roleId']) && $fkRole['role_id'] == $filter['roleId']) { echo "selected";}?> ><?php echo ucwords($fkRole['role_name']);?></option>
                                      <?php
                                          }?> 
                                 </select>
                              </div>
                           </div>
                           <?php } ?>

                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">Department</label>
                              <input type="text" list="datalist51" class="form-control m-input" id="filterDesignation" placeholder="Select Department" name="filter[designation]" value="<?php echo isset($filter['designation'])?$filter['designation']:''; ?>">
                              <datalist id="datalist51"> 
                                  <?php
                                      foreach ($departmentFilter as $key => $value) {
                                  ?>
                                  <option value="<?php echo $value['department_name'];?>"></option>
                                  <?php }?>
                                
                              <!-- This data list will be edited through javascript     -->
                              </datalist>
                           </div>
                        </div>
                        <div class="row" style="padding:0 2rem">
                          <div class="" style="padding-bottom: 30px;">
                              <input type="hidden" name="filter[user_type]" id="filter_company_type" value="<?php echo $userType;?>">
                              <input type="hidden" name="filter[saved_filter_id]" id="saved_filter_id" value="">
                              <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>
                              <a href="<?php echo base_url().'user/'.$userType; ?>" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey">Reset</a>
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

         <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet m-portlet--tabs">
               <div class="m-portlet__head">
                <?php echo $this->page->getPage('layout/body/body_actionButton'); ?>
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
        <form name="formgrid" id="feedInput" action="<?php echo base_url().'user/create/gridview/'?>" method="POST" enctype="multipart/form-data">
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

<div class="modal fade" id="role_new_modal" role="dialog" aria-labelledby="" aria-hidden="true" style="z-index:10000">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body" style="height: 250px; overflow-y: scroll;">
            <div class="form-group m-form__group row m--margin-top-20">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <select class="form-control m-select2" id="selecLeadOpportinuty" name="param" style="opacity: 1;">
                        <option value="">-- Select user email --</option>
                        
                    </select>
                    
                </div>
            </div>
        </div>
    </div>

<!---- Start Import Excel -->
<div class="modal fade" id="import-excel-modal" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Import Excel</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data" action="<?php echo $importAction?>" method="post" id="excelUpload">
                <div class="modal-body" style="height: 250px;">
                    <div class="alert hide excel-upload-response" style="color:#ff0000;"></div>
                    <div class="form-group m-form__group row m--margin-top-20 import-excel-margin">
                        <label for="exampleInputEmail1">File Browser</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="uploadFile" id="customFile">
                            <label class="custom-file-label" for="customFile" style="height:31px">Choose file</label>
                        </div>
                    </div>
                    <div class="" style="display:inline;">
                        <input type="hidden" name="redirectAction" value="<?php echo $redirectAction;?>">
                        <button type="submit" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>
                        <a type="button" class="btn btn-default m-btn m-btn--custom" style="margin-left: 725px;" href="<?php echo base_url().'upload/sampleUserList.xlsx'?>">Sample Excel</a> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
  window.userType = "<?php echo $userType; ?>"
  window.moduleType = "<?php echo "users"; ?>"
  window.moduleTabs = <?php echo json_encode($tabs); ?>;
  window.column = <?php echo json_encode($userColumn); ?>;
    <?php
    if (isset($filter)) {
  ?>
  window.customeFilter = '?q=<?php echo json_encode($filter); ?>';
<?php } else { ?>
   window.customeFilter = '?q=<?php echo isset($userWise)?json_encode($userWise):''; ?>';
  <?php } ?>

  window.baseUrl = '?q=<?php echo base_url(); ?>';
  window.companyList = '<?php echo $company; ?>';
</script>