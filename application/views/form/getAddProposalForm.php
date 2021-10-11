    <?php
if($newValue == 'ShowData') { ?>
<input type="hidden" id="propid" value="<?php echo $fk_lead_opportunity_id; ?>">
<div id="tableList">
    <table class="table table-bordered" id="proposalTable">
    </table>
</div>
<script type="text/javascript">
    var lop_id = $("#propid").val();
    datastring = {lead_opportunity_id : lop_id};
    table.leadproposalPopupTable(datastring);
</script>
<?php } else { ?>
    <input type="hidden" id="propid" value="<?php echo $id; ?>">
    <div id="validation_errors_proposal"></div>
    <div class="form-group m-form__group row m--margin-top-20" style="width: 100%;">
        
        <div class="col-lg-8 col-md-8 col-sm-12">
            <p for="street_address" style="font-size: 14px; margin-left: 40px;margin-top: 20px;">Opportunity Title - <strong><?php echo $value[0]['opportunity_title']; ?></strong></p>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-12 padtop4">
            <p for="street_address" style="font-size: 14px; margin-left: 40px;margin-top: 20px;">Customer Name - <strong><?php echo $value[0]['full_name']; ?></strong></p>
        </div>
    </div>

    </div>
        <div class="m-portlet m-portlet--tabs" id="showUL">
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
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_18_tab_content" role="tab" aria-selected="true">
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
            <div class="m-portlet__body margin-top2" style="width: 100%;">
                <div class="tab-content">
                    <!-- <div class="modal-body"> -->
                        
                        <div class="tab-pane active show" id="m_portlet_base_demo_16_tab_content" role="tabpanel">
                            <table class="table table-borderless">
                                <tr>
                                    <td colspan="4" >
                                        <button type="button" id="addButton" class="btn btn-success active" data-toggle="modal" data-target="#addmodal" style="height: 30px;padding: .45rem 1.15rem;float: right;">Add</button>
                                        <button type="button" id="importButton" class="btn btn-primary" data-toggle="modal" data-target="#import-excel-modal" style="height: 30px;padding: .45rem 1.15rem;float: right;margin-right: 10px;">Import Items</button>
                                        <a type="button" href="<?php echo base_url()?>upload/sampleItemList.xlsx" class="btn btn-default" style="height: 30px;padding: .45rem 1.15rem;float: right;margin-right: 10px;">Sample Excel</a>
                                    </td>
                                </tr>
                            </table>
                            <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                                <div id="tableList" style="width: 100%;">
                                    <p align="right"><strong>Total FOB: <?php echo isset($getFobCif[0]['fob'])?'$ '.$getFobCif[0]['fob']:'N/A'; ?> | Total CIF: <?php echo isset($getFobCif[0]['cif'])?'$ '.$getFobCif[0]['cif']:'N/A'; ?></strong></p>
                                    <table class="table table-bordered" id="itemTable">

                                   </table>
                                   <script type="text/javascript">
                                        var lop_id = $("#propid").val();
                                        datastring = {fk_pid : lop_id};
                                        table.proposalPopupTable(datastring);
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_portlet_base_demo_17_tab_content" role="tabpanel">
                            <div class="form-group m-form__group row m--margin-top-20" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                                <div id="validation_errors_proposal_format"></div>
                                <?php
                                if (isset($getFormat[0])) {
                                    $format = $getFormat[0];
                                }
                                    // foreach ($getFormat as $key => $format) { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                                    <textarea name="format_header" id="format_header" placeholder="Add Format Header Here..." style="width: 100%;margin-bottom: 10px"><?php echo isset($format['format_header'])?$format['format_header']:'Add Format Header Here...'; ?></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12"  style="margin-bottom: 10px;">
                                    <textarea name="format_footer" id="format_footer" placeholder="Add Format Footer Here..." style="width: 100%;margin-top: 10px"><?php echo isset($format['format_footer'])?$format['format_footer']:'Add Format Footer Here...'; ?></textarea>
                                </div>
                                        
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="pf_id" id="pf_id" value="<?php echo isset($format['pf_id'])?$format['pf_id']:''; ?>">
                                    <button class="btn btn-success" id="add_format"><?php if (isset($format['pf_id']) && $format['pf_id'] !='') { echo 'Update Format';} else { echo 'Add Format';}?></button>
                                </div>
                                
                                <?php //} ?>
                                
                            </div>
                        </div>
                        <div class="tab-pane" id="m_portlet_base_demo_18_tab_content" role="tabpanel">
                            <button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>
                            <div class="form-group m-form__group row" id="printdiv" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
                                <table class="table table-borderless">
                                    <!-- <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="4">
                                            <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">
                                                <?php echo isset($format['format_header'])?$format['format_header']:''; ?>
                                            </span><br></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="center">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 18px">
                                                        <th>Sr No</th>
                                                        <th>Item</th>
                                                        <th>Item Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if (isset($getItemList)) {
                                                            $i=1;
                                                            foreach ($getItemList as $item) { 
                                                                if ($item['item_name'] !='') {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i?></td>
                                                                    <td><?php echo $item['item_name']?></td>
                                                                    <td><?php echo $item['id_code']?></td>
                                                                </tr>
                                                        <?php
                                                            $i++; }}
                                                        } else { ?>
                                                            <tr>
                                                                <td colspan="3">No Data Available</td>
                                                            </tr>
                                                       <?php }
                                                        ?>
                                                        
                                                </tbody>
                                           </table>
                                        </td>
                                    </tr>
                                    <!-- <tr><td colspan="4" align="center"><?php echo isset($format['format_footer'])?$format['format_footer']:''; ?></td></tr> -->
                                    <tr>
                                        <td>
                                            <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">
                                                <?php echo isset($format['format_footer'])?$format['format_footer']:''; ?>
                                            </span><br></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_portlet_base_demo_19_tab_content" role="tabpanel">
                            <div class="form-group m-form__group row" style="padding-right: 10px;">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="validation_errors_upload_tab"></div>
                                    <form enctype="multipart/form-data" method="post" id="excelUpload" onsubmit="excelUpload()">
                                        <div class="modal-body">
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
                    <h5 class="modal-title">
                        Add Item
                    </h5>
                    <button type="button" class="close" id="closeItemButton" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                    </button>
                </div>
                <form action="<?php echo base_url().'lead/addWorksheet'?>"   enctype="multipart/form-data" method="post" class="m-form m-form--fit m-form--label-align-right">
                    <div id="replaceItemForm">
                        <div class="modal-body"><div id="validation_errors_worksheet"></div>
                            <input type="hidden" id="fk_pid" name="fk_pid" value="<?php echo $id; ?>">
                            <input type="hidden" id="pw_id" name="pw_id" value="<?php echo $itemId; ?>">
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
                                    <label for="company_name">Item Name</label>
                                    <input type="text" name="item_name" id="add_item_name" class="form-control m-input" value="" placeholder="Item Name" required="">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Item Ref</label>
                                    <input type="text" name="item_type" id="add_item_type" class="form-control m-input" placeholder="Item Ref" value="" required="">
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
                                    <input type="text" name="technical_description" id="add_technical_description" value="" class="form-control m-input" placeholder="Technical Description" rows="3" cols="3">
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-12 col-md-12 col-sm-12"><strong>Ex Factory Section</strong></div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Quantity</label>
                                    <input type="text" name="quantity" id="add_quantity" value="" class="form-control m-input" placeholder="Quantity" onkeyup="getExFactoryTotalMarkup()">
                                    <span id="quantity_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Price Ex Factory</label>
                                    <input type="text" name="ex_factory_unit_price" id="add_ex_factory_unit_price" value="" class="form-control m-input" placeholder="Unit Price Ex Factory" onkeyup="getExFactoryTotalMarkup()">
                                    <span id="add_ex_factory_unit_price_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Price Mark Up</label>
                                    <select class="form-control markupselect" style="height: 30px !important" name="unit_price_markup" id="add_unit_price_markup" onchange="getExFactoryTotalMarkup()">
                                        <option value="">--</option>
                                        <option value="%">%</option>
                                        <option value="$/unit">$/unit</option>
                                        <option value="Total Markup">Total Markup</option>
                                    </select>
                                    <input type="hidden" id="unit_price_markup1" value=""/>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Price Mark Up Amount</label>
                                    <input type="text" name="ex_factory_mark_up_amt" id="add_ex_factory_mark_up_amt" value="" onkeyup="getExFactoryTotalMarkup()" class="form-control m-input" placeholder="Unit Price Ex Factory">
                                </div>
                            </div>

                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Ex Factory Total Markup</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_ex_factory_total_markup" placeholder="Ex Factory Total Markup" value="" name="ex_factory_total_markup" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Total Price Ex Factory</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_total_price_ex_factory" placeholder="Total Price Ex Factory" value="" name="total_price_ex_factory" aria-describedby="basic-addon1">

                                    </div>
                                    <span id="total_price_ex_factory_alert" style="color:red"></span>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-12 col-md-12 col-sm-12"><strong>Fabrics Section</strong></div>
                            </div>

                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Fabrics Quantity</label>
                                    <input type="text" name="fabric_quantity" id="add_fabric_quantity" value="" class="form-control m-input" placeholder="Fabrics Quantity" onkeyup="getFabricsTotalMarkup()">
                                    <span id="add_fabric_quantity_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Fabrics Price</label>
                                    <input type="text" name="fabric_price" id="add_fabric_price" value="" class="form-control m-input" placeholder="Fabrics Price" onkeyup="getFabricsTotalMarkup()">
                                    <span id="add_fabric_price_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Fabrics Mark Up</label>
                                    <select class="form-control" style="height: 30px !important" name="fabric_markup" id="add_fabric_markup" onchange ="getFabricsTotalMarkup()">
                                        <option value="">--</option>
                                        <option value="%">%</option>
                                        <option value="$/unit">$/unit</option>
                                        <option value="Total Markup">Total Markup</option>
                                    </select>
                                    <input type="hidden" id="unit_price_markup2" value=""/>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Fabrics Mark Up Amount</label>
                                    <input type="text" name="fabric_mark_up_amt" id="add_fabric_mark_up_amt" value="" class="form-control m-input" placeholder="Fabrics Mark Up Amount" onkeyup="getFabricsTotalMarkup()">
                                </div>
                            </div>

                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Fabrics Total Markup</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_fabrics_total_markup" placeholder="Fabrics Total Markup" value="" name="fabrics_total_markup" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Total Price with Fabrics</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_unit_total_price_fabric" placeholder="Unit Total Price with Fabrics" value="" name="unit_total_price_fabric" aria-describedby="basic-addon1" readonly>
                                    </div>
                                    <span id="unit_cost_alert" style="color:red"></span>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-12 col-md-12 col-sm-12"><strong>Leather Section</strong></div>
                            </div>

                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Leather Quantity</label>
                                    <input type="text" name="leather_quantity" id="add_leather_quantity" value="" class="form-control m-input" placeholder="Leather Quantity"onkeyup="getLeatherTotalMarkup()">
                                    <span id="add_leather_quantity_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Leather Price</label>
                                    <input type="text" name="leather_price" id="add_leather_price" value="" class="form-control m-input" placeholder="Leather Price" onkeyup="getLeatherTotalMarkup()">
                                    <span id="add_leather_price_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Leather Mark Up</label>
                                    <select class="form-control" id="leather_markup" style="height: 30px !important" name="leather_markup" onchange ="getLeatherTotalMarkup()">
                                        <option value="">--</option>
                                        <option value="%">%</option>
                                        <option value="$/unit">$/unit</option>
                                        <option value="Total Markup">Total Markup</option>
                                    </select>
                                    <input type="hidden" id="unit_price_markup3" value=""/>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Leather Mark Up Amount</label>
                                    <input type="text" name="leather_mark_up_amt" id="add_leather_mark_up_amt" value="" class="form-control m-input" placeholder="Leather Mark Up Amount" onkeyup="getLeatherTotalMarkup()">
                                </div>
                                
                            </div>

                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Leather Total Markup</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_leather_total_markup" placeholder="Leather Total Markup" value="" name="leather_total_markup" aria-describedby="basic-addon1" readonly>
                                    </div>
                                    <span id="unit_cost_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Total Price with Leather</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_unit_total_price_leather" placeholder="Unit Total Price with Fabrics" value="" name="unit_total_price_leather" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Price FOB</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_unit_price_fob" placeholder="Unit Price FOB" value="" name="unit_price_fob" aria-describedby="basic-addon1" onkeyup="getFOB(this.value)">
                                        <span id="add_unit_price_fob_alert" style="color:red"></span>
                                    </div>
                                    <span id="unit_cost_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Unit Price CIF</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" placeholder="Unit Price CIF" value="" name="unit_price_cif" id="add_unit_price_cif" aria-describedby="basic-addon1" onkeyup="getCIF(this.value)">
                                        <span id="add_unit_price_cif_alert" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Total Price FOB</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" id="add_total_price_fob" placeholder="Total Price FOB" value="" name="total_price_fob" aria-describedby="basic-addon1" readonly>
                                    </div>
                                    <span id="unit_cost_alert" style="color:red"></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Total Price CIF</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" placeholder="Total Price CIF" value="" name="total_price_cif" id="add_total_price_cif" aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">CBM</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control m-input" placeholder="CBM" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="company_name">Notes</label>
                                    <div class="input-group m-input-group m-input-group--square">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1" style="padding: 0">
                                           <i class="fa fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <textarea class="form-control m-input" placeholder="Note" id="add_note" value="" name="note" aria-describedby="basic-addon1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-20">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="company_type"></div>
                                    <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->
                                    <button type="submit" class="btn btn-primary m-btn" style="font-family: sans-serif, Arial;">Save &amp; New</button>
                                    <span id="itemSuccessMessageUpdate" style="color: green;margin-left: 20px;"></span>
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
    <div class="modal fade" id="import-excel-modal" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Import Excel</h3>
                    <a href="<?php echo base_url().'proposal';?>" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </a>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data" action="<?php echo $importAction?>" method="post" id="excelUpload">
                    <div class="modal-body" style="height: 250px;">
                        <div id="importMsg"></div>
                        <div class="form-group m-form__group row m--margin-top-20 import-excel-margin">
                            <label for="exampleInputEmail1">File Browser</label>
                            <div class="custom-file">
                                <input type="file" name="uploadFile" id="customFile">
                            </div>
                        </div>
                        <div class="" style="display:inline;">
                            <input type="hidden" name="module" value="Proposal">
                            <input type="hidden" name="fk_pid" value="<?php echo isset($p_id)?$p_id:''; ?>">
                            <input type="hidden" name="redirectAction" value="<?php echo $redirectAction;?>">
                            <button type="submit" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

