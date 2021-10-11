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
                            <h3 class="m-portlet__head-text m-portlet__head-text2 text-center" align="center" >
                                <?php
                                    if ($folderType == 'folders') {
                                        echo "List of Folders";
                                    }  
								     else {
                                        echo "List of Files";
                                    }
                                ?>
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
                            $module_type = ucfirst($module_type);
                            if(isset($valueChildren['allowAdd']) && $valueChildren['name'] == ucfirst($module_type)) { ?>                   
                                <div class="m-menu__link-badge">
                                  <button class="btn green m-btn m-btn--custom new-btn2 m-menu__link-icon call-form" data-url="<?php echo isset($valueChildren['modelUrl'])?base_url().$valueChildren['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel']?>">
                                      New
                                  </button>
                                </div>
                      <?php }}} ?>
                </div>
                <?php
                    if ($deletePermission) {
                        echo $this->page->getPage('layout/body/body_action');
                    }
                ?>
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
                                <form action="" method="post" class="m-form m-form--fit m-form--label-align-right" id="getFilter">
                                    <div id="replaceFilter">
                                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">
                                            <div class="col-lg-2 col-md-4 col-sm-4">
                                                <label class="form-control-label">Folder Name</label>
                                                <input type="text" name="filter[folder_name]" id="filter_company_name" class="form-control m-input" placeholder="" value="<?php echo isset($filter['folder_name'])?$filter['folder_name']:''; ?>">
                                            </div>
                                            
                                            <div class="col-lg-2 col-md-4 col-sm-4">
                                                <label class="form-control-label">Project Name</label>
                                                <input type="text" maxlength="15" name="filter[project_name]" id="filter_bussiness_contact" class="form-control m-input" placeholder="" value="<?php echo isset($filter['project_name'])?$filter['project_name']:''; ?>">
                                            </div>
                                            
                                            
                                    <div class="row" style="padding:0 2rem;display:none">
                                        <div class="" style="padding-bottom: 30px;">
                                            <input type="hidden" name="filter[folder_type]" id="filter_company_type" value="<?php echo $folderType;?>">
                                            <input type="hidden" name="filter[saved_filter_id]" id="saved_filter_id" value="">
                                            <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>
                                            <a href="<?php echo base_url().'folders/'.$folderType; ?>" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey">Reset</a>
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
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x" role="tablist" style="margin-top: 15px">
                                <?php
                                if (isset($foldersPermissions) && $foldersPermissions !='') {
                                ?>
                                    <li class="nav-item m-tabs__item black-height">
                                        <a class="nav-link m-tabs__link black-pad <?php if(isset($folderType) && $folderType =='folders') { echo "active show";}?>" href="folders">
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Folders
                                        </a>
                                    </li>
                            <?php } 
                                if (isset($filesPermissions) && $filesPermissions !='') {
                                ?>
                                <li class="nav-item m-tabs__item black-height">
                                    <a class="nav-link m-tabs__link black-pad <?php if(isset($folderType) && $folderType =='files') { echo "active show";}?>" href="files">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Files
                                    </a>
                                </li>
                                <?php } ?>
                                
                            </ul>
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
                        <a type="button" class="btn btn-default m-btn m-btn--custom" style="margin-left: 725px;" href="<?php echo base_url().'upload/sampleCompany.xls'?>">Sample Excel</a>
                    </div>
                </div>
            </form>
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
        <form name="formgrid" id="feedInput" action="<?php echo base_url().'company/create/gridview/'?>" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <!--Div for Success/Alert message-->
               <table class="table table-bordered">
                <tr align="center">
                    <th>Folder Name</th><td><input type="checkbox" name="folder[]" value="1"></td>
                </tr>
                <tr align="center">
                    <th>Project Name</th><td><input type="checkbox" name="folder[]" value="3"></td>
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

<script>
    window.folderType = "<?php echo $folderType; ?>";
    window.moduleType = "<?php echo $folderType; ?>";
    window.moduleTabs = <?php echo json_encode($tabs); ?>;
    window.column = <?php echo json_encode($companyColumn); ?>;
    window.customeFilter = '?q=<?php echo json_encode($filter ); ?>';
</script>