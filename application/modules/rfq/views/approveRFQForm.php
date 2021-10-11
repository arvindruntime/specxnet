<div id="validation_errors_rfq"></div>
<div class="form-group m-form__group row m--margin-top-20">
    <div class="col-lg-12 col-md-12 col-sm-12">  
        <label for="street_address">Signature</label>    
        <textarea class="form-control m-input" id="notes" name="signature"  placeholder="" rows="6" style="height: 50px!important">
            
        </textarea>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">  
        <label for="street_address">Remark</label>    
        <textarea class="form-control m-input" id="notes" name="remark"  placeholder="" rows="6" style="height: 50px!important">
            
        </textarea>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12" style="margin-top: 10px;">
        <input type="hidden" name="rfq_id" value="<?php echo $b_id;?>">
        <button type="submit" class="btn btn-success">Approve</button>
    </div>
</div>