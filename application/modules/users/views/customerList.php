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
               <a class="m-subheader__title m-subheader__title--separator" href="index.php"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsive"></a>			
            </div>
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
                        Customer Contact
                     </h3>
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group m-form__group row">
            <div class="col-lg-10 col-md-10 lead-bottommargin">
               <div class="m-dropdown m-dropdown--inline m-dropdown--arrow  m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="display: block">
                  <a href="#" class="m-portlet__nav-link btn green m-btn m-btn--custom new-btn2 checked_action dropdown-toggle  m-dropdown__toggle" style="color: #FFF">
                  <span>New</span>
                  </a>
                  <div class="m-dropdown__wrapper" style="z-index: 101;">
                     <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
                     <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                           <div class="m-dropdown__content">
                              <ul class="m-nav">
                                 <li class="m-nav__item">
                                    <a href="#" class="m-nav__link" data-toggle="modal" data-target="#internal_user_modal">
                                    <span class="m-nav__link-text">Internal Users</span>
                                    </a>
                                 </li>
                                 <li class="m-nav__item">
                                    <a href="#" class="m-nav__link" data-toggle="modal" data-target="#myModal2">
                                    <span class="m-nav__link-text">Suppliers</span>
                                    </a>
                                 </li>
                                 <li class="m-nav__item">
                                    <a href="#" class="m-nav__link" data-toggle="modal" data-target="#myModal">
                                    <span class="m-nav__link-text">Customer Contacts</span>
                                    </a>
                                 </li>
                              </ul>
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
                  <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">
                     <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>
                     <span class="m-accordion__item-title">Filter Your Results</span>
                     <span class="m-accordion__item-mode"></span>     
                  </div>
                  <div class="m-accordion__item-body collapse" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">
                     <div class="m-accordion__item-content">
                        <div class="m-portlet__head" style="padding: 0">
                           <div class="m-portlet__head-tools">
                              <div class="col-lg-12 col-md-12 col-sm-12" align="right" style="padding-top: 10px">
                                 <div style="width:194px;">
                                    <select class="form-control greyborder" name="">
                                       <option value="Checked Action" selected="">Standard Filter</option>
                                       <option value="fluid">Menu 1</option>
                                       <option value="boxed">Menu 2</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">Name</label>
                              <input type="text" name="billing_card_name" class="form-control m-input" placeholder="" value="">
                           </div>
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <div class="m-portlet__nav-item">
                                 <label class="form-control-label">User Status</label>
                                 <div>
                                    <select class="form-control greyborder" name="">
                                       <option value="Checked Action" selected="">Name</option>
                                       <option value="fluid">Menu 1</option>
                                       <option value="boxed">Menu 2</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-2 col-md-4 col-sm-4">
                              <label class="form-control-label">Role</label>
                              <div>
                                 <select class="form-control greyborder" name="">
                                    <option value="Checked Action" selected="">--All Items Selected--</option>
                                    <option value="fluid">Menu 1</option>
                                    <option value="boxed">Menu 2</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row" style="padding:0 2rem">
                           <div class="m-form__actions">
                              <button type="reset" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>
                              <button type="reset" class="btn  m-btn btn-black m-btn--custom grey">Reset</button>
                              <button type="reset" class="btn green m-btn m-btn--custom">Save Filter</button>
                           </div>
                        </div>
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
                        <li class="nav-item m-tabs__item black-height">
                           <a class="nav-link m-tabs__link black-pad" href="internal">
                           <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Internal Users
                           </a>
                        </li>
                        <li class="nav-item m-tabs__item black-height">
                           <a class="nav-link m-tabs__link black-pad" href="supplier">
                           <i class="fa fa-bar-chart" aria-hidden="true"></i> Suppliers
                           </a>
                        </li>
                        <li class="nav-item m-tabs__item black-height">
                           <a class="nav-link m-tabs__link black-pad active show"  href="CustomerContact">
                           Customer Contact
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="m-portlet__body tab-padding-top" style="padding: 0.8 rem 2.2rem">
                  <div class="row tab-top-margin2">
                     <div class="col-lg-6 col-md-12 col-sm-12 tab-margin-top">
                        <div class="md-header btn-toolbar">
                           <div class="btn-group">
                              <select class="form-control greyborder" name="">
                                 <option value="Checked Action" selected=""> Standard View</option>
                                 <option value="fluid">Fluid</option>
                                 <option value="boxed">Boxed</option>
                              </select>
                           </div>
                           <div class="btn-group">
                              <button class="btn-default btn-sm btn" type="button" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdBold">
                              <i class="la la-cog"></i></button>
                              <button class="btn-default btn-sm btn" type="button" title="Excel" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdItalic">
                              <i class="fa fa-file-excel"></i> </button>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-12 col-sm-12"></div>
                  </div>
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

<script>
   window.userType = "<?php echo $userType; ?>"
</script>