<!-- <div class="form-group  m-form__group row">
        <div class=" col-lg-4 col-md-4 col-sm-12">
            <label for="street_address"><strong>Contact Details</strong></label>
        </div>
        <div class=" col-lg-4 col-md-4 col-sm-12">
            <label for="street_address"><strong>Contact Type</strong></label>
        </div>
    </div> -->

    <div id="myRepeatingFields">
    </div>
    <div id="myRepeatingFieldsforNewUser">

        <div class="form-group  m-form__group row" style="padding-left:15px">
            <div class="entry input-group form-group  m-form__group row">
                <div class="entry-row entry input-group form-group  m-form__group row" id="oldData"> 
                    <input type="hidden" name="userConactId[]" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>">
                    <div class=" col-lg-4 col-md-4 col-sm-12">
                        <input type="text" id="conatctInfoU" name="contact_detail[]" value="<?php echo isset($ContactInfo['contact_info'])?$ContactInfo['contact_info']:''; ?>" class="form-control m-input pages_titleDetails" required>
                    </div>
                    <div class=" col-lg-4 col-md-4 col-sm-12">
                        <select id="conatctTypeUsr" name="contact_type[]" class="form-control m-input pages_titleType" style="height: 30px !important">
                            <option value="0"> --Please Select--</option>
                            <option value="Email" >Email</option>
                            <option value="Phone">Phone</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <span class="input-group-btn">
                        <button type="button" class="btn-sm btn m-btn--icon m-btn--pill btn-danger btn-remove delete_top2" value="<?php echo isset($ContactInfo['user_contact_id'])?$ContactInfo['user_contact_id']:''; ?>">
                        <!-- <span> <i class="la la-plus"></i> <span>Add</span> </span> -->
                        <span><i class="la la-trash-o btn-danger btn-remove"></i><span>Delete</span></span>
                        </button>
                        </span>
                    </div>
                </div>
            
            <div id="newClondedContact" style="width: 100%;">
                
            </div>
            <div class="col-lg-2 col-md-2">
                    <span class="input-group-btn">
                    <button type="button" class="btn-sm btn m-btn--icon m-btn--pill btn-success btn-update">
                    <span> <i class="la la-plus"></i> <span>Add</span> </span>
                    <!-- <span><i class="la la-trash-o btn-danger"></i><span>Delete</span></span> -->
                    </button>
                    </span>
            </div>
            </div>
        </div>

    </div> 
        </div>