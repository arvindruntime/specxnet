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
                               Todo
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-10 col-md-10 lead-bottommargin">
                  <?php 
                        foreach($newButton as $keyChildren => $valueChildren) {
                            ?>
                              <?php if(isset($valueChildren['allowAdd']) && $valueChildren['name'] == $module_name) { ?>                   
                                <div class="m-menu__link-badge">
                                  <button class="btn green m-btn m-btn--custom new-btn2 m-menu__link-icon call-form" data-url="<?php echo isset($valueChildren['modelUrl'])?base_url().$valueChildren['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel']?>">
                                      New
                                  </button>
                                </div>
                      <?php }} ?>
                </div>
            </div>
            <div style="margin-bottom: 0.5rem;">
                <div class="d-flex align-items-center">
                    <div class="mr-auto margin_left">
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                
            </div>
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                        </div>
                    </div>
                    <div class="m-portlet__body tab-padding-top" style="padding: 0.8 rem 2.2rem">
                        <?php //echo $this->page->getPage('layout/tabs'); ?>
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

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->

<script>
    window.moduleType = "<?php echo $module_type; ?>";
    window.moduleTabs = <?php echo json_encode($tabs); ?>;
    window.column = <?php echo json_encode($tableColumn); ?>;
    window.customeFilter = '?q=<?php echo json_encode($filter ); ?>';
    
</script>