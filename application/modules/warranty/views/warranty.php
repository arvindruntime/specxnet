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

                                    if ($module_type == 'internal') {

                                        echo "Internal Company";

                                    } else if ($module_type == 'supplier') {

                                        echo "Supplier Company";

                                    } else if ($module_type == 'customer') {

                                        echo "Customer Company";

                                    } else {

                                        echo "Warranty";

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

                            if ($module_type == 'Supplier') {

                                $module_type = 'Suppliers';

                            }

                            ?>

                              <?php if(isset($valueChildren['allowAdd']) && $valueChildren['name'] == ucfirst($module_type)) { ?>                   

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

                                                <label class="form-control-label">Company Name</label>

                                                <input type="text" name="filter[company_name]" id="filter_company_name" class="form-control m-input" placeholder="" value="<?php echo isset($filter['company_name'])?$filter['company_name']:''; ?>">

                                            </div>

                                            <div class="col-lg-2 col-md-4 col-sm-4">

                                                <div class="m-portlet__nav-item">

                                                    <label class="form-control-label">Parent Company</label>

                                                    <div>

                                                        <select class="form-control greyborder"  id="filter_parent_company_id" name="filter[parent_company]">

                                                            <option data-tokens="Menu1" value="0">--Select Parent Company--</option>

                                                            <?php

                                                                foreach ($parentCompany as $parent) {

                                                                ?>

                                                            <option value="<?php echo $parent['company_id'];?>" <?php if ($filter['parent_company']==$parent['company_id']) { echo "selected";}?> ><?php echo $parent['company_name'];?></option>

                                                            <?php

                                                                }?>

                                                        </select>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-lg-2 col-md-4 col-sm-4">

                                                <label class="form-control-label">Business Contact</label>

                                                <input type="number" maxlength="15" name="filter[bussiness_contact]" id="filter_bussiness_contact" class="form-control m-input" placeholder="" value="<?php echo isset($filter['bussiness_contact'])?$filter['bussiness_contact']:''; ?>">

                                            </div>

                                            <div class="col-lg-2 col-md-4 col-sm-4">

                                                <label class="form-control-label">City</label>

                                                <input type="text" name="filter[city]" id="filter_city" class="form-control m-input" placeholder="" value="<?php echo isset($filter['city'])?$filter['city']:''; ?>">

                                            </div>

                                            <div class="col-lg-2 col-md-4 col-sm-4">

                                                <label class="form-control-label">State</label>

                                                <input type="text" name="filter[state]" id="filter_state" class="form-control m-input" placeholder="" value="<?php echo isset($filter['state'])?$filter['state']:''; ?>">

                                            </div>

                                            <div class="col-lg-2 col-md-4 col-sm-4">

                                                <label class="form-control-label">Country</label>

                                                <select class="form-control countryCode" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="filter[country]" id="filter_country">

                                                    <option data-tokens="Menu1" value="">--Select Country--</option>

                                                    <?php

                                                        foreach ($country as $showCountry) {

                                                        ?>

                                                    <option value="<?php echo $showCountry['nicename'];?>" <?php echo (isset($filter['country']) && $filter['country']==$showCountry['nicename'])?'selected':''; ?> ><?php echo $showCountry['nicename']." (+".$showCountry['phonecode'].")";?></option>

                                                    <?php

                                                        }?>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row" style="padding:0 2rem">

                                        <div class="" style="padding-bottom: 30px;">

                                            <input type="hidden" name="filter[company_type]" id="filter_company_type" value="<?php echo $companyType;?>">

                                            <input type="hidden" name="filter[saved_filter_id]" id="saved_filter_id" value="">

                                            <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>

                                            <a href="<?php echo base_url().'company/'.$companyType; ?>" id="resetButton" class="btn  m-btn btn-black m-btn--custom grey">Reset</a>

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

                                if (isset($internalPermissions) && $internalPermissions !='') {

                                ?>

                                    <li class="nav-item m-tabs__item black-height">

                                        <a class="nav-link m-tabs__link black-pad <?php if(isset($companyType) && $companyType =='internal') { echo "active show";}?>" href="internal">

                                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Internal Company 

                                        </a>

                                    </li>

                            <?php } 

                                if (isset($supplierPermissions) && $supplierPermissions !='') {

                                ?>

                                <li class="nav-item m-tabs__item black-height">

                                    <a class="nav-link m-tabs__link black-pad <?php if(isset($companyType) && $companyType =='supplier') { echo "active show";}?>" href="supplier">

                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Suppliers

                                    </a>

                                </li>

                                <?php } 

                                if (isset($customerPermissions) && $customerPermissions !='') {

                                ?>

                                <li class="nav-item m-tabs__item black-height">

                                    <a class="nav-link m-tabs__link black-pad <?php if(isset($companyType) && $companyType =='customer') { echo "active show";}?>"  href="customer">

                                    Customer

                                    </a>

                                </li>

                            <?php }?>

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

        <form name="formgrid" id="feedInput" action="<?php echo base_url().'warranty/createGrid/'?>" method="POST" enctype="multipart/form-data">

            <div class="modal-body">

                <!--Div for Success/Alert message-->

               <table class="table table-bordered">

                <tr align="center">

                    <th>Company Name</th><td><input type="checkbox" name="internal[]" value="1"></td>

                </tr>

                <tr align="center">

                    <th>Parent Company</th><td><input type="checkbox" name="internal[]" value="2"></td>

                </tr>

                <tr align="center">

                    <th>Business Contact</th><td><input type="checkbox" name="internal[]" value="3"></td>

                </tr>

                <tr align="center">

                    <th>Street Address</th><td><input type="checkbox" name="internal[]" value="4"></td>

                </tr>

                <tr align="center">

                    <th>City</th><td><input type="checkbox" name="internal[]" value="5"></td>

                </tr>

                <tr align="center">

                    <th>State</th><td><input type="checkbox" name="internal[]" value="6"></td>

                </tr>

                <tr align="center">

                    <th>Country</th><td><input type="checkbox" name="internal[]" value="7"></td>

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

    window.moduleTabs = <?php echo json_encode($tabs); ?>;

    window.column = <?php echo json_encode($companyColumn); ?>;

    window.customeFilter = '?q=<?php echo json_encode($filter ); ?>';

    window.moduleType = 'warranty';

    

</script>