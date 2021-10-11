<div id="validation_errors_rfq"></div>
<div class="form-group m-form__group row m--margin-top-20">
    
 <?php if(isset($value['title']) && $value['title'] !='') { ?>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <p for="street_address" style="font-size: 14px; margin-left: 40px;margin-top: 20px;"><strong><?php echo $value['title']; ?></strong></p>
        </div>
        <input type="hidden" name="lead_opportunity_id" id="lead_opportunity_id" value="<?php echo isset($value['lead_opportunity_id'])?$value['lead_opportunity_id']:''; ?>">
    <?php } else { ?>
    <div class="col-lg-3 col-md-3 col-sm-12">
        <label for="street_address"><span style="color:red;">* </span>RFQ For  <span style="color:red">*</span></label>
        <select class="form-control" id="lead_opportunity_id" style="height: 30px !important" required>
            <option value="">---Select Lead Opportunity---</option>
            <?php
                foreach ($leadOpp as $key => $leadOpp) {
            ?>
                <option value="<?php echo $leadOpp['lead_opportunity_id'];?>" <?php echo (isset($value['fk_lead_opportunity_id']) && $value['fk_lead_opportunity_id']==$leadOpp['lead_opportunity_id'])?'selected':''; ?>><?php echo $leadOpp['opportunity_title'];?></option>
        <?php }?>
        </select>
        <span id="lead_id_alert" style="color:red"></span>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 padtop4">
        <label for="street_address">Company Name <span style="color:red">*</span></label>
        <div class="input-group date">
            <input type="text" class="form-control m-input" id="company_name" value="" placeholder="Please select Lead Opportunity" readonly>
        </div>
    </div>
<?php }?>

    <div id="getCompanyOpportunity"></div>
    <div class="col-lg-3 col-md-3 col-sm-12 padtop4">
        <label for="street_address"><span style="color:red;">* </span>Submission Deadline  <span style="color:red">*</span></label>
        <div class="input-group date">
            <!-- <input type="date" class="form-control m-input" id="m_datepicker_3_3modal" name="approval_deadline" value="<?php //echo isset($value['approval_deadline'])?$value['approval_deadline']:''; ?>" placeholder="dd-mm-yyyy"> -->
             <?php
                if(isset($value['approval_deadline']) && $value['approval_deadline'] != '') {
            ?>
            <input type="text" class="form-control m-input datepicker" name="approval_deadline" id="m_datepicker_3_3modal" value="<?php echo isset($value['approval_deadline'])?$value['approval_deadline']:''; ?>" required>
        <?php } else {?>
            <input type="text" class="form-control m-input datepicker" name="approval_deadline" id="m_datepicker_3_3modal" value="" required>
        <?php }?>
            <div class="input-group-append">
                <span class="input-group-text">
                <i class="la la-calendar"></i>
                </span>
            </div>
        </div>
        <span id="deadline_alert" style="color:red"></span>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-12">
        <label for="street_address">Supplier</label>
        <select class="form-control select2" id="supplier_id" name="supplier_id[]" multiple style="height: 80px !important; width: 100%" required>
            <?php
                foreach ($supplier as $key => $supplierperson) {
            ?>
                <option value="<?php echo $supplierperson['user_id'];?>" <?php echo (isset($value['supplier_id']) && (in_array($supplierperson['user_id'], explode(',', $value['supplier']))))?'selected':''; ?>><?php echo $supplierperson['supplier_people'];?></option>
        <?php }?>
        </select>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12" style="margin-top: 35px;">  
        <input type="radio" id="radio" name="markuptypeCheck" value="fixed" style="margin-left: 10px" onclick="markUpCheck()" <?php if(isset($value['markup_type']) && $value['markup_type'] == 'fixed') {echo 'checked';}?>/> Fixed Markup
        <input type="radio" id="radio" name="markuptypeCheck" value="line" onclick="markUpCheck()" <?php if(isset($value['markup_type']) && $value['markup_type'] == 'line') {echo 'checked';}?>/> Line Markup
        <div class="fixedInbox" style="width: 229px;margin-top: 10px;<?php if(isset($value['markup_type']) && $value['markup_type'] == 'fixed') {echo "visibility: visible"; } else { echo "visibility: hidden"; } ?>;">
            <div class="input-group date">
                <input type="text" class="form-control m-input" name="markup_type_value_ex_factory" value="<?php echo isset($value['markup_type_value_ex_factory'])?$value['markup_type_value_ex_factory']:''; ?>" id="fixedInputBox_ex_factory" <?php echo isset($value['markup_type_value_ex_factory'])?'':'disabled'; ?>>
                <div class="input-group-append">
                    <span class="input-group-text" style="height: 30px;">
                    %
                    </span>
                </div>
            </div>
        </div>
        <div class="fixedInbox" style="width: 229px;margin-top: 10px;<?php if(isset($value['markup_type']) && $value['markup_type'] == 'fixed') {echo "visibility: visible"; } else { echo "visibility: hidden"; } ?>;">
            <div class="input-group date">
                <input type="text" class="form-control m-input" name="markup_type_value_fabric" value="<?php echo isset($value['markup_type_value_fabric'])?$value['markup_type_value_fabric']:''; ?>" id="fixedInputBox_fabric" <?php echo isset($value['markup_type_value_fabric'])?'':'disabled'; ?>>
                <div class="input-group-append">
                    <span class="input-group-text" style="height: 30px;">
                    %
                    </span>
                </div>
            </div>
        </div>
        <div class="fixedInbox" style="width: 229px;margin-top: 10px;<?php if(isset($value['markup_type']) && $value['markup_type'] == 'fixed') {echo "visibility: visible"; } else { echo "visibility: hidden"; } ?>;">
            <div class="input-group date">
                <input type="text" class="form-control m-input" name="markup_type_value_leather" value="<?php echo isset($value['markup_type_value_leather'])?$value['markup_type_value_leather']:''; ?>" id="fixedInputBox_leather" <?php echo isset($value['markup_type_value_leather'])?'':'disabled'; ?>>
                <div class="input-group-append">
                    <span class="input-group-text" style="height: 30px;">
                    %
                    </span>
                </div>
            </div>
        </div>
        <input type="hidden" name="markup_type" value="" id="markup_type">
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">  
        <label for="street_address">Notes</label>    
        <textarea class="form-control m-input" id="notes" name="notes" maxlength="1000" placeholder="" rows="6" style="height: 50px!important"><?php echo isset($value['notes'])?$value['notes']:''; ?></textarea>
    </div>
</div>
<div class="form-group m-form__group row m--margin-top-20">
    <div class="col-lg-12 col-md-12 col-sm-12">
      
        <?php if (!isset($b_id)) {?>
            <!-- <p>Check If you want to Add Worksheet data : <input type="checkbox" id="checkWorkshhet"/></p> -->
        <p>Check If you want to Add Worksheet data : <input type="checkbox" id="checkWorkshhet" <?php if (isset($b_id)){ echo "checked disabled"; }?>/></p>
        <?php } ?>
            
            <?php if (isset($b_id)){?>           
            <button class="btn btn-outline-primary m-btn m-btn--custom" id="saveRFQ">Update</button>
            <?php } ?>
            <button type="button" id="save" class="btn btn-outline-success m-btn m-btn--custom" style="font-family: sans-serif, Arial;">Save and Send Email</button>
            <a type="button" href="<?php echo base_url().'upload/sampleRfqItemList.xlsx'?>" class="btn btn-default m-btn m-btn--custom">Download Sample Excel</a>
            <!-- </div> -->
    </div>
</div>
</div>
<div class="modal-body">
    <div class="m-portlet m-portlet--tabs" id="showUL" style="<?php if (!isset($b_id)) { echo "display:none"; }?>;">
       
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_portlet_base_demo_16_tab_content" role="tab" aria-selected="false">
                        Worksheet 
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_17_tab_content" role="tab" aria-selected="false">
                        Format
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" onclick="get_preview();" href="#m_portlet_base_demo_18_tab_content" role="tab" aria-selected="true">
                        Preview
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_19_tab_content" role="tab" aria-selected="true">
                        Upload Item(s)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body margin-top2" style="">

            <div class="tab-content">
               
                <!-- <div class="modal-body"> -->
                    <div id="validation_errors_delete"></div>
                    <div class="tab-pane active show" id="m_portlet_base_demo_16_tab_content" role="tabpanel">
                         <table class="table table-borderless">
                            <tr>
                                <td colspan="4" >
                                     <!-- <button type="button" id="importButton" class="btn btn-primary" data-toggle="modal" data-target="#import-excel-modal" style="height: 30px;padding: .45rem 1.15rem;float: right;margin-right: 10px;">Upload Items</button> -->

                                    

                                    <button type="button" id="deleteButton" class="btn btn-primary" style="height: 30px;padding: .45rem 1.15rem;float: right; margin-right:10px;">Delete</button>
                                    
                                    <button type="button" id="addButton" class="btn btn-success active" data-toggle="modal" data-target="#addModal" style="height: 30px;padding: .45rem 1.15rem;float: right; margin-right:10px;">Add</button>

                                </td>
                            </tr>
                        </table>
                        <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                            <div id="tableList" style="width: 100%;">
                                <table class="table table-bordered" id="itemTable">
                               </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_portlet_base_demo_17_tab_content" role="tabpanel">
                        <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                            <div id="validation_errors_rfq_format"></div>
                            <?php
                            if (isset($getFormat[0])) {
                                $format = $getFormat[0];
                            }?>
                             <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                                <textarea name="format_header" class="form-control m-input" id="format_header" placeholder="Add Format Header Here..." style="width: 100%;margin-bottom: 10px;height: 90px !important"><?php echo isset($format['format_header'])?$format['format_header']:'Add Format Header Here...'; ?></textarea>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12"  style="margin-bottom: 10px;">
                                <textarea name="format_footer" class="form-control m-input" id="format_footer" placeholder="Add Format Footer Here..." style="width: 100%;margin-top: 10px;height: 90px !important;"><?php echo isset($format['format_footer'])?$format['format_footer']:'Add Format Footer Here...'; ?></textarea>
                            </div>
                                    
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="hidden" name="bf_id" id="bf_id" value="<?php echo isset($format['bf_id'])?$format['bf_id']:''; ?>">
                                <button class="btn btn-success" id="add_format"><?php if (isset($format['bf_id']) && $format['bf_id'] !='') { echo 'Update Format';} else { echo 'Add Format';}?></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="m_portlet_base_demo_18_tab_content" role="tabpanel">
                        <button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>
                        <div class="form-group m-form__group row" id="printdiv" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                           
                        </div>
                    </div>
                    <div class="tab-pane" id="m_portlet_base_demo_19_tab_content" role="tabpanel">
                        <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                            <div id="validation_errors_upload_tab"></div>
                            <form enctype="multipart/form-data" method="post" id="excelUpload" onsubmit="excelUpload()">
                                <div class="modal-body" style="height: 250px;">
                                    <div class="alert hide excel-upload-response" style="color:#ff0000;"></div>
                                    <input type="file" name="uploadFile" id="customFile">
                                    <div class="" style="display:inline;">
                                        <input type="hidden" name="redirectAction" value="<?php echo $redirectAction;?>">
                                        <button type="submit" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>   
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        
    </div>

    <!-- Add Button Model -->

    <div class="modal fade" id="addModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;max-width: 1100px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item_header">
                    Add Item
                </h5>
                <button type="button" class="close" id="closeItemButton" data-dismiss="addModal" aria-label="Close">
                <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div id="validation_errors_rfq_worksheet"></div>
            <form enctype="multipart/form-data" method="post" id="addWorksheet" class="m-form m-form--fit m-form--label-align-right" onsubmit ="AddUpdateItem()">
                <div id="replaceItemForm">
                    <div class="modal-body"><div id="validation_errors_worksheet"></div>

                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Room Type</label>
                                <input type="text" name="room_type" id="add_room_type" class="form-control m-input" value="" placeholder="Room Type" required="">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name"><span style="color:red;">* </span>ID Code</label>
                                <input type="text" name="id_code" id="add_id_code" class="form-control m-input" value="" placeholder="ID Code" required="">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name"><span style="color:red;">* </span>Item Type</label>
                                <input type="text" name="item_type" id="add_item_type" class="form-control m-input" value="" placeholder="Item Type" required="">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name"><span style="color:red;">* </span>Item Ref.</label>
                                <input type="text" name="item_name" id="add_item_name" class="form-control m-input" placeholder="Item Ref" value="" required="">
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-12 col-md-12 col-sm-12"><strong>Item Description</strong></div>
                        </div>
                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Photo</label>
                                <input type="file" name="photo" id="add_photo" value="" class="form-control m-input">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Width</label>
                                <input type="text" name="width" id="add_width" value="" class="form-control m-input" placeholder="Width">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Depth</label>
                                <input type="text" name="depth" id="add_depth" value="" class="form-control m-input" placeholder="Depth">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Height</label>
                                <input type="text" name="height" id="add_material" value="" class="form-control m-input" placeholder="Height">
                            </div>
                        </div>
                        <div class="form-group m-form__group row m--margin-top-20">
                           <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Short Height</label>
                                <input type="text" name="short_height" id="add_short_height" value="" class="form-control m-input" placeholder="Short Height">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="company_name">Technical Description</label>
                                <textarea name="technical_description" id="add_technical_description" value="" class="form-control m-input" placeholder="Technical Description" rows="3" cols="3"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-12 col-md-12 col-sm-12"><strong>Item Quantity Details</strong></div>
                        </div>
                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name"> Ex-Factory Quantity</label>
                                <input type="text" name="quantity" id="add_quantity" value="" class="form-control m-input" placeholder="Quantity">
                                <span id="quantity_alert" style="color:red"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Fabrics Quantity (meter)</label>
                                <input type="text" name="fabric_quantity" id="add_fabric_quantity" value="" class="form-control m-input" placeholder="Quantity">
                                <span id="add_fabric_quantity_alert" style="color:red"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">Leather Quantity (meter)</label>
                                <input type="text" name="leather_quantity" id="add_leather_quantity" value="" class="form-control m-input" placeholder="Quantity">
                                <span id="add_leather_quantity_alert" style="color:red"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <label for="company_name">CBM</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <input type="text" class="form-control m-input" placeholder="CBM" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="company_name">Notes</label>
                                <div class="input-group m-input-group m-input-group--square">
                                    <textarea class="form-control m-input" placeholder="Note" id="add_note" value="" name="note" aria-describedby="basic-addon1" rows="3" cols="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <input type="hidden" name="fk_b_id" id="fk_b_id" value="<?php echo isset($b_id)?$b_id:''; ?>">
                        <input type="hidden" name="bw_id" id="bw_id" value="">
                        <div class="form-group m-form__group row m--margin-top-20">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="company_type"></div>
                                <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->
                                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save &amp; New</button>
                                <span id="itemSuccessMessage"  style="color: green;margin-left: 20px;"></span>
                                <!-- <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button> -->
                            </div>
                        </div>
                    </div>
                </div>    
            </form>
            
        </div>
     </div>
</div>

<!---- Start Import Excel -->
<!-- <div class="modal fade" id="import-excel-modal" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Import Excel</h3>
                
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data" action="<?php echo $importAction?>/<?=$b_id;?>" method="post" id="excelUpload">
                <div class="modal-body" style="height: 250px;">
                    <div class="excel-upload-response" id="excel_upload_response" style="color:#ff0000;"></div>
                    <div class="form-group m-form__group row m--margin-top-20 import-excel-margin">
                        <label for="exampleInputEmail1">File Browser</label>
                        <div class="custom-file">
                            <input type="file" name="uploadFile" id="customFile">
                        </div>
                    </div>
                    <div class="" style="display:inline;">
                        <input type="hidden" name="module" value="rfq">
                        <input type="hidden" name="fk_b_id" value="<?php echo isset($b_id)?$b_id:''; ?>">
                        <input type="hidden" name="redirectAction" value="<?php echo $redirectAction;?>">
                        <button type="submit" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>   
                        <button type="button" id="closeImportButton" >Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->

 <!-- Add Button Model -->

    <div class="modal fade" id="imageModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">
     <div class="modal-dialog modal-lg" role="document" style="margin-top: 0px;max-width: 1100px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">
                    Add Item
                </h5> -->
                <button type="button" class="close" id="closeItemButton" data-dismiss="imageModal" aria-label="Close">
                <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            
        </div>
     </div>
</div>