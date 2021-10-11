<?php
//print_r($data);exit;
if (!empty($getItemList)) {
    $newData = $getItemList[0];
    // print_r($getItemList);exit;
    ?>
    <div class="modal-body"><div id="validation_errors_worksheet"></div>
        <div class="form-group m-form__group row m--margin-top-20">
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
                <input type="text" name="item_name" id="add_item_type" class="form-control m-input" value="<?php echo isset($newData['item_type'])?$newData['item_type']:''; ?>" placeholder="Item Name" required="">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Item Type</label>
                <input type="text" name="item_type" id="add_item_name" class="form-control m-input" value="<?php echo isset($newData['item_name'])?$newData['item_name']:''; ?>" placeholder="Item Type" required="">
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
                <label for="company_name">Width(m)</label>
                <input type="text" name="width" id="add_width" value="<?php echo isset($newData['width'])?$newData['width']:''; ?>" class="form-control m-input" placeholder="Width">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Depth(m)</label>
                <input type="text" name="depth" id="add_depth" value="<?php echo isset($newData['depth'])?$newData['depth']:''; ?>" class="form-control m-input" placeholder="Depth">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Height(m)</label>
                <input type="text" name="height" id="add_material" value="<?php echo isset($newData['height'])?$newData['height']:''; ?>" class="form-control m-input" placeholder="Height">
            </div>
        </div>
        <div class="form-group m-form__group row m--margin-top-20">
           <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Short Height(m)</label>
                <input type="text" name="short_height" id="add_short_height" value="<?php echo isset($newData['short_height'])?$newData['short_height']:''; ?>" class="form-control m-input" placeholder="Short Height">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="company_name">Technical Description</label>
                <input type="text" name="technical_description" id="add_technical_description" value="<?php echo isset($newData['technical_description'])?$newData['technical_description']:''; ?>" class="form-control m-input" placeholder="Technical Description" rows="3" cols="3">
            </div>
        </div>
        <hr/>
        <div class="form-group m-form__group row m--margin-top-20">
            <div class="col-lg-12 col-md-12 col-sm-12"><strong>Item Quantity Details</strong></div>
        </div>
        <div class="form-group m-form__group row m--margin-top-20">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Ex-Factory Quantity</label>
                <input type="text" name="quantity" id="add_quantity" value="<?php echo isset($newData['quantity'])?$newData['quantity']:''; ?>" class="form-control m-input" placeholder="Quantity">
                <span id="quantity_alert" style="color:red"></span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Fabrics Quantity (meter)</label>
                <input type="text" name="fabric_quantity" id="add_fabric_quantity" value="<?php echo isset($newData['fabric_quantity'])?$newData['fabric_quantity']:''; ?>" class="form-control m-input" placeholder="Fabrics Quantity">
                <span id="add_fabric_quantity_alert" style="color:red"></span>
            </div>
             <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">Leather Quantity (meter)</label>
                <input type="text" name="leather_quantity" id="add_leather_quantity" value="<?php echo isset($newData['leather_quantity'])?$newData['leather_quantity']:''; ?>" class="form-control m-input" placeholder="Leather Quantity">
                <span id="add_leather_quantity_alert" style="color:red"></span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <label for="company_name">CBM</label>
                <div class="input-group m-input-group m-input-group--square">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1" style="padding: 0">
                       <!-- <i class="fa fa-dollar-sign"></i> -->
                        </span>
                    </div>
                    <input type="text" class="form-control m-input" placeholder="CBM" id="add_percentage_units" value="<?php echo isset($newData['cbm'])?$newData['cbm']:''; ?>" name="cbm" aria-describedby="basic-addon1" >
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="company_name">Notes</label>
                <div class="input-group m-input-group m-input-group--square">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1" style="padding: 0">
                       <!-- <i class="fa fa-dollar-sign"></i> -->
                        </span>
                    </div>
                    <textarea class="form-control m-input" placeholder="Note" id="add_note" name="note" aria-describedby="basic-addon1"><?php echo isset($newData['note'])?$newData['note']:''; ?></textarea>
                </div>
            </div>
        </div>
        <hr/>
        <input type="hidden" name="fk_b_id" id="fk_b_id" value="<?php echo isset($newData['fk_b_id'])?$newData['fk_b_id']:''; ?>">
        <input type="hidden" name="bw_id" id="bw_id" value="<?php echo isset($newData['bw_id'])?$newData['bw_id']:''; ?>">
        <div class="form-group m-form__group row m--margin-top-20">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="company_type"></div>
                <!-- <button type="submit" data-type="save" id="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button> -->
                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Update</button><span id="itemSuccessMessageUpdate" style="color: green;margin-left: 20px;"></span>
                <!-- <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button> -->
            </div>
        </div>
    </div>
<?php } ?>
     
