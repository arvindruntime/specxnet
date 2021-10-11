<?php

$user_type = $this->session->userdata('user_type');

?>


<div id="validation_errors_proposal"></div>

<div class="form-group m-form__group row m--margin-top-20">




    <div class="col-lg-6 col-md-6 col-sm-12" style="font-size: 14px; margin-left: 40px;margin-top: 20px;">
        <label><strong>Proposal Title</strong></label>

        <span></span>

        <p for="street_address"><?php echo $value['title']; ?></p>

    </div>

    <input type="hidden" name="lead_opportunity_id" id="lead_opportunity_id" value="<?php echo isset($value['lead_opportunity_id']) ? $value['lead_opportunity_id'] : ''; ?>">


    <div id="getCompanyOpportunity"></div>



    <div class="col-lg-3 col-md-3 col-sm-12 padtop4">

        <label><strong>Approval Deadline</strong></label>

        <span></span>

        <div class="input-group date">

            <p><?php echo isset($value['approval_deadline']) ? $value['approval_deadline'] : ''; ?></p>

        </div>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 padtop4" style="font-size: 14px; margin-left: 40px;margin-top: 20px;">

        <label><strong>Notes</strong></label>

        <span></span>

        <div class="input-group date">

            <p><?php echo isset($value['notes']) ? $value['notes'] : ''; ?></p>

        </div>

    </div>

</div>



</div>

<div class="modal-body">

    <div class="m-portlet m-portlet--tabs" id="showUL" style="<?php if (!isset($p_id)) {
                                                                    echo "display:none";
                                                                } ?>;">

        <div class="m-portlet__head">

            <div class="m-portlet__head-tools">

                <ul class="nav nav-tabs m-tabs-line m-tabs-line-left" role="tablist">

                    <li class="nav-item m-tabs__item">

                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_portlet_base_demo_16_tab_content" role="tab" aria-selected="false">

                           Proposal Worksheet

                        </a>

                    </li>

                    <li class="nav-item m-tabs__item">

                        <a class="nav-link m-tabs__link" data-toggle="tab" onclick="get_preview();" href="#m_portlet_base_demo_18_tab_content" role="tab" aria-selected="true">

                            Preview

                        </a>

                    </li>

                    <li class="nav-item m-tabs__item">

                        <a class="nav-link m-tabs__link" data-toggle="tab" onclick="get_remark();" href="#m_portlet_base_demo_17_tab_content" role="tab" aria-selected="false">

                            Remark

                        </a>

                    </li>

                    <!-- <li class="nav-item m-tabs__item">

                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_demo_19_tab_content" role="tab" aria-selected="true">

                            Upload Item(s)

                            </a>

                        </li> -->

                </ul>

            </div>

        </div>

        <div class="m-portlet__body margin-top2" style="">

            <div class="tab-content">

                <!-- <div class="modal-body"> -->



                <div class="tab-pane active show" id="m_portlet_base_demo_16_tab_content" role="tabpanel">


                    <div class="form-group m-form__group row" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">

                        <div id="tableList" style="width: 100%;">

                            <!-- <p align="right"><strong>Total FOB: <?php echo isset($getFobCif[0]['fob']) ? '$ ' . $getFobCif[0]['fob'] : 'N/A'; ?> | Total CIF: <?php echo isset($getFobCif[0]['cif']) ? '$ ' . $getFobCif[0]['cif'] : 'N/A'; ?></strong></p> -->

                            <table class="table table-bordered" id="itemTable">
                            </table>

                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="m_portlet_base_demo_17_tab_content" role="tabpanel">

                </div>

                <div class="tab-pane" id="m_portlet_base_demo_18_tab_content" role="tabpanel">

                    <button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>

                    <div class="form-group m-form__group row" id="printdiv" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">



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

                                        <input type="hidden" name="redirectAction" value="<?php echo $redirectAction; ?>">

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

                <form enctype="multipart/form-data" method="post" id="addWorksheet" class="m-form m-form--fit m-form--label-align-right" onsubmit="AddUpdateItem()">

                    <div id="replaceItemForm">

                        <div class="modal-body">
                            <div id="validation_errors_worksheet"></div>



                            <div class="form-group m-form__group row m--margin-top-20">

                                <!-- <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Project Name</label>

                                    <input type="text" name="project_name" id="add_project_name" class="form-control m-input" placeholder="Project Name" value="" required="">

                                </div> -->

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

                                    <input type="text" name="item_name" id="add_item_name_test" class="form-control m-input" value="" placeholder="Item Name" required="">

                                </div>

                            </div>

                            <hr />

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

                            <hr />

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

                                    <input type="hidden" id="unit_price_markup1" value="" />

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

                            <hr />

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

                                    <select class="form-control" style="height: 30px !important" name="fabric_markup" id="add_fabric_markup" onchange="getFabricsTotalMarkup()">

                                        <option value="">--</option>

                                        <option value="%">%</option>

                                        <option value="$/unit">$/unit</option>

                                        <option value="Total Markup">Total Markup</option>

                                    </select>

                                    <input type="hidden" id="unit_price_markup2" value="" />

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

                            <hr />

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-12 col-md-12 col-sm-12"><strong>Leather Section</strong></div>

                            </div>



                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Leather Quantity</label>

                                    <input type="text" name="leather_quantity" id="add_leather_quantity" value="" class="form-control m-input" placeholder="Leather Quantity" onkeyup="getLeatherTotalMarkup()">

                                    <span id="add_leather_quantity_alert" style="color:red"></span>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Leather Price</label>

                                    <input type="text" name="leather_price" id="add_leather_price" value="" class="form-control m-input" placeholder="Leather Price" onkeyup="getLeatherTotalMarkup()">

                                    <span id="add_leather_price_alert" style="color:red"></span>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Leather Mark Up</label>

                                    <select class="form-control" id="leather_markup" style="height: 30px !important" name="leather_markup" onchange="getLeatherTotalMarkup()">

                                        <option value="">--</option>

                                        <option value="%">%</option>

                                        <option value="$/unit">$/unit</option>

                                        <option value="Total Markup">Total Markup</option>

                                    </select>

                                    <input type="hidden" id="unit_price_markup3" value="" />

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

                            <hr />

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

                                        <input type="text" class="form-control m-input" placeholder="CBM" id="add_percentage_units" value="" name="cbm" aria-describedby="basic-addon1">

                                    </div>

                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">

                                    <label for="company_name">Notes</label>

                                    <div class="input-group m-input-group m-input-group--square">

                                        <textarea class="form-control m-input" placeholder="Note" id="add_note" value="" name="note" aria-describedby="basic-addon1"></textarea>

                                    </div>

                                </div>

                            </div>

                            <input type="hidden" name="fk_pid" id="fk_pid" value="<?php echo isset($p_id) ? $p_id : ''; ?>">

                            <input type="hidden" name="pw_id" id="pw_id" value="">

                            <div class="form-group m-form__group row m--margin-top-20">

                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div id="company_type"></div>

                                    <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->

                                    <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save &amp; New</button>

                                    <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>



                                    <span id="itemSuccessMessage" style="color: green;margin-left: 20px;"></span>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>



            </div>

        </div>

    </div>


    <div class="modal fade" id="comment-modal" role="dialog" aria-labelledby="" aria-hidden="true">

        <div class="modal-dialog modal-sm" style="max-width: 80%;" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h3 class="modal-title" id="exampleModalLabel">Status Remarks</h3>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <form class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data" onsubmit="AddComment()" method="post">

                    <div class="modal-body" style="position: relative; overflow-y: auto;  max-height: 400px;  padding: 15px;">

                        <div id="commentMsg"></div>

                        <div class="form-group m-form__group row m--margin-top-20 import-excel-margin">

                            <label for="exampleInputEmail1">Add a Remark</label>

                            <div class="custom-file">

                                <textarea name="comment" id="comment" rows="6" style="width: 700px!important; height: 35px!important;"></textarea>

                            </div>

                        </div>
                        <div class="" style="display:inline;">
                        <input type="hidden" name="commentStatus" id="commentStatus" value="">

                            <input type="hidden" name="module" value="Proposal">

                            <input type="hidden" name="fk_pid" value="<?php echo isset($p_id) ? $p_id : ''; ?>">

                            <button type="submit" id="importExcel" class="btn btn-info m-btn m-btn--custom">Submit</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>