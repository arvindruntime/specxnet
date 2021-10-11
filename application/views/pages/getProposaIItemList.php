<?php

if (!empty($getItemList)) {

    $newData = $getItemList[0];
    
    ?>

    <div class="modal-body"><div id="validation_errors_worksheet"></div>

        <div class="form-group m-form__group row m--margin-top-20">

            <!-- <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Project Name</label>

                <input type="text" name="project_name" id="add_project_name" class="form-control m-input" placeholder="Project Name" value="<?php echo isset($newData['project_name'])?$newData['project_name']:''; ?>" required="">

            </div> -->

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Room Type</label>

                <input type="text" name="room_type" id="add_room_type" class="form-control m-input" value="<?php echo isset($newData['room_type'])?$newData['room_type']:''; ?>" placeholder="Room Type" required="">

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">ID Code</label>

                <input type="text" name="id_code" id="add_id_code" class="form-control m-input" value="<?php echo isset($newData['id_code'])?$newData['id_code']:''; ?>" placeholder="ID Code" required="">

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Item Name</label>

                <input type="text" name="item_name" id="add_item_name_test" class="form-control m-input" value="<?php echo isset($newData['item_name'])?$newData['item_name']:''; ?>" placeholder="Item Name" required="">

            </div>

        </div>

        <hr/>

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-12 col-md-12 col-sm-12"><strong>Item Description</strong></div>

        </div>

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Photo</label>

                <input type="file" name="photo" id="add_photo" class="form-control m-input">

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Width</label>

                <input type="text" name="width" id="add_width" value="<?php echo isset($newData['width'])?$newData['width']:''; ?>" class="form-control m-input" placeholder="Width">

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Depth</label>

                <input type="text" name="depth" id="add_depth" value="<?php echo isset($newData['depth'])?$newData['depth']:''; ?><?php echo isset($newData['depth'])?$newData['depth']:''; ?>" class="form-control m-input" placeholder="Depth">

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Height</label>

                <input type="text" name="height" id="add_material" value="<?php echo isset($newData['height'])?$newData['height']:''; ?>" class="form-control m-input" placeholder="Height">

            </div>

        </div>

        <div class="form-group m-form__group row m--margin-top-20">

           <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Short Height</label>

                <input type="text" name="short_height" id="add_short_height" value="<?php echo isset($newData['short_height'])?$newData['short_height']:''; ?>" class="form-control m-input" placeholder="Short Height">

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">

                <label for="company_name">Technical Description</label>

                <input type="text" name="technical_description" id="add_technical_description" value="<?php echo isset($newData['technical_description'])?$newData['technical_description']:''; ?>" class="form-control m-input" placeholder="Technical Description" rows="3" cols="3">

            </div>

        </div>

        <hr/>

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-12 col-md-12 col-sm-12"><strong>Ex Factory Section</strong></div>

        </div>

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Quantity</label>

                <input type="text" name="quantity" id="add_quantity" value="<?php echo isset($newData['quantity'])?$newData['quantity']:''; ?>" class="form-control m-input" placeholder="Quantity" onkeyup="getExFactoryTotalMarkup()">

                <span id="quantity_alert" style="color:red" ></span>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Unit Price Ex Factory</label>

                <input type="text" name="ex_factory_unit_price" id="add_ex_factory_unit_price" value="<?php echo isset($newData['ex_factory_unit_price'])?$newData['ex_factory_unit_price']:''; ?>" class="form-control m-input" placeholder="Unit Price Ex Factory" onkeyup="getExFactoryTotalMarkup()">

                <span id="add_ex_factory_unit_price_alert" style="color:red"></span>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Unit Price Mark Up</label>

                <select class="form-control markupselect" style="height: 30px !important" value="<?php echo isset($newData['unit_price_markup'])?$newData['unit_price_markup']:''; ?>"name="unit_price_markup" id="add_unit_price_markup" onchange="getExFactoryTotalMarkup()">

                    <option value="">--</option>

                    <option value="%" <?php if(isset($newData['unit_price_markup']) && $newData['unit_price_markup']=="%")echo "selected"; ?>>%</option>

                    <option value="$/unit" <?php if(isset($newData['unit_price_markup']) && $newData['unit_price_markup']=="$/unit")echo "selected"; ?>>$/unit</option>

                    <option value="Total Markup" <?php if(isset($newData['unit_price_markup']) && $newData['unit_price_markup']=="Total Markup")echo "selected"; ?>>Total Markup</option>

                </select>

                <input type="hidden" id="unit_price_markup1" value="<?php echo isset($newData['unit_price_markup'])?$newData['unit_price_markup']:''; ?>"/>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Unit Price Mark Up Amount</label>

                <input type="text" name="ex_factory_mark_up_amt" id="add_ex_factory_mark_up_amt" value="<?php echo isset($newData['ex_factory_mark_up_amt'])?$newData['ex_factory_mark_up_amt']:''; ?>" onkeyup="getExFactoryTotalMarkup()" class="form-control m-input" placeholder="Unit Price Ex Factory">

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

                    <input type="text" class="form-control m-input" id="add_ex_factory_total_markup" placeholder="Ex Factory Total Markup" value="<?php echo isset($newData['ex_factory_total_markup'])?$newData['ex_factory_total_markup']:''; ?>" name="ex_factory_total_markup" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" id="add_total_price_ex_factory" placeholder="Total Price Ex Factory" value="<?php echo isset($newData['total_price_ex_factory'])?$newData['total_price_ex_factory']:''; ?>" name="total_price_ex_factory" aria-describedby="basic-addon1">



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

                <input type="text" name="fabric_quantity" id="add_fabric_quantity" value="<?php echo isset($newData['fabric_quantity'])?$newData['fabric_quantity']:''; ?>" class="form-control m-input" placeholder="Fabrics Quantity" onkeyup="getFabricsTotalMarkup()">

                <span id="add_fabric_quantity_alert" style="color:red"></span>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Fabrics Price</label>

                <input type="text" name="fabric_price" id="add_fabric_price" value="<?php echo isset($newData['fabric_price'])?$newData['fabric_price']:''; ?>" class="form-control m-input" placeholder="Fabrics Price" onkeyup="getFabricsTotalMarkup()">

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

                <input type="hidden" id="unit_price_markup2" value="<?php echo isset($newData['fabric_markup'])?$newData['fabric_markup']:''; ?>"/>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Fabrics Mark Up Amount</label>

                <input type="text" name="fabric_mark_up_amt" id="add_fabric_mark_up_amt" value="<?php echo isset($newData['fabric_mark_up_amt'])?$newData['fabric_mark_up_amt']:''; ?>" class="form-control m-input" placeholder="Fabrics Mark Up Amount" onkeyup="getFabricsTotalMarkup()">

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

                    <input type="text" class="form-control m-input" id="add_fabrics_total_markup" placeholder="Fabrics Total Markup" value="<?php echo isset($newData['fabrics_total_markup'])?$newData['fabrics_total_markup']:''; ?>" name="fabrics_total_markup" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" id="add_unit_total_price_fabric" placeholder="Unit Total Price with Fabrics" value="<?php echo isset($newData['unit_total_price_fabric'])?$newData['unit_total_price_fabric']:''; ?>" name="unit_total_price_fabric" aria-describedby="basic-addon1" readonly>

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

                <input type="text" name="leather_quantity" id="add_leather_quantity" value="<?php echo isset($newData['leather_quantity'])?$newData['leather_quantity']:''; ?>" class="form-control m-input" placeholder="Leather Quantity" onkeyup="getLeatherTotalMarkup()">

                <span id="add_leather_quantity_alert" style="color:red" ></span>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Leather Price</label>

                <input type="text" name="leather_price" id="add_leather_price" value="<?php echo isset($newData['leather_price'])?$newData['leather_price']:''; ?>" class="form-control m-input" placeholder="Leather Price" onkeyup="getLeatherTotalMarkup()">

                <span id="add_leather_price_alert" style="color:red" ></span>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Leather Mark Up</label>

                <select class="form-control" id="leather_markup" style="height: 30px !important" name="leather_markup" onchange="getLeatherTotalMarkup()">

                    <option value="">--</option>

                    <option value="%">%</option>

                    <option value="$/unit">$/unit</option>

                    <option value="Total Markup">Total Markup</option>

                </select>

                <input type="hidden" id="unit_price_markup3" value="<?php echo isset($newData['leather_markup'])?$newData['leather_markup']:''; ?>"/>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12">

                <label for="company_name">Leather Mark Up Amount</label>

                <input type="text" name="leather_mark_up_amt" id="add_leather_mark_up_amt" value="<?php echo isset($newData['leather_mark_up_amt'])?$newData['leather_mark_up_amt']:''; ?>" class="form-control m-input" placeholder="Leather Mark Up Amount" onkeyup="getLeatherTotalMarkup()">

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

                    <input type="text" class="form-control m-input" id="add_leather_total_markup" placeholder="Leather Total Markup" value="<?php echo isset($newData['leather_total_markup'])?$newData['leather_total_markup']:''; ?>" name="leather_total_markup" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" id="add_unit_total_price_leather" placeholder="Unit Total Price with Fabrics" value="<?php echo isset($newData['unit_total_price_leather'])?$newData['unit_total_price_leather']:''; ?>" name="unit_total_price_leather" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" id="add_unit_price_fob" placeholder="Unit Price FOB" value="<?php echo isset($newData['unit_price_fob'])?$newData['unit_price_fob']:''; ?>" name="unit_price_fob" aria-describedby="basic-addon1" onkeyup="getFOB(this.value)">

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

                    <input type="text" class="form-control m-input" placeholder="Unit Price CIF" value="<?php echo isset($newData['unit_price_cif'])?$newData['unit_price_cif']:''; ?>" name="unit_price_cif" id="add_unit_price_cif" aria-describedby="basic-addon1" onkeyup="getCIF(this.value)">

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

                    <input type="text" class="form-control m-input" id="add_total_price_fob" placeholder="Total Price FOB" value="<?php echo isset($newData['total_price_fob'])?$newData['total_price_fob']:''; ?>" name="total_price_fob" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" placeholder="Total Price CIF" value="<?php echo isset($newData['total_price_cif'])?$newData['total_price_cif']:''; ?>" name="total_price_cif" id="add_total_price_cif" aria-describedby="basic-addon1" readonly>

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

                    <input type="text" class="form-control m-input" placeholder="CBM" id="add_percentage_units" value="<?php echo isset($newData['cbm'])?$newData['cbm']:''; ?>" name="cbm" aria-describedby="basic-addon1" >

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

                    <textarea class="form-control m-input" placeholder="Note" id="add_note" name="note" aria-describedby="basic-addon1"><?php echo isset($newData['note'])?$newData['note']:''; ?></textarea>

                </div>

            </div>

        </div>

        <input type="hidden" name="fk_pid" id="fk_pid" value="<?php echo isset($newData['fk_pid'])?$newData['fk_pid']:''; ?>">

        <input type="hidden" name="pw_id" id="pw_id" value="<?php echo isset($newData['pw_id'])?$newData['pw_id']:''; ?>">

        <div class="form-group m-form__group row m--margin-top-20">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div id="company_type"></div>

                <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->

                <button type="submit" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save</button>

                <!-- <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button> -->

                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>



                <span id="itemSuccessMessageUpdate"  style="color: green;margin-left: 20px;"></span>

            </div>

        </div>

    </div>

<?php } ?>

