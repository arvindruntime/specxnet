<div id="validation_errors"></div>

<form action="<?php echo base_url().'warranty/create/'.$warrantyId; ?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">

    <div class="form-group m-form__group row m--margin-top-20 padtop3">

        <div class="col-md-6 col-sm-6 col-6">

            <h5 class="modal-title padtop5">General Info</h5>

        </div>

        <div class="col-sm-12 col-12" style="border:1px groove #000000"></div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="claim"><span style="color: red">* </span>Claim</label>

            <input type="text" name="claim" class="form-control m-input" id="claim" style="" value="<?php echo $value['claim']??''; ?>" required>

            <div id="tagsname"></div>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="title">Title</label>

            <input type="text" name="title" class="form-control m-input" id="title" style="" value="<?php echo $value['title']??''; ?>" required>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="priority"><span style="color: red">* </span>Priority</label>

            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="priority" id="priority" required>

                <option data-tokens="Menu1" value="">--Select To Priority--</option>

                <?php 
                 if(!empty($value['priority'])){   
                foreach ($priorities as $key => $priority) { ?>

                    <option value="<?php echo $key;?>" <?php if($key==$value['priority']){ echo 'selected';} ?>><?php echo $priority;?></option>

                <?php } } else {
                    foreach ($priorities as $key => $priority) { 
                 ?>
                    <option value="<?php echo $key;?>"><?php echo $priority;?></option>
                <?php } } ?>

            </select>

            <div id="tagsname"></div>

        </div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-6 col-md-6 col-sm-12">

            <label for="dop"> Description of Problem</label>

            <textarea class="form-control m-input" style="padding:.46rem 1.15rem !important; height:120px !important" name="dop" id="dop"><?php echo ($value['description_of_problem'])??''; ?></textarea>

            <div id="tagsname"></div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">

            <label for="in"> Internal Note</label>

            <textarea class="form-control m-input" maxlength="4000" rows="6" style="padding:.46rem 1.15rem !important; height:120px !important" name="in" id="in"><?php echo ($value['description_of_problem'])??''; ?></textarea>

            <div id="tagsname"></div>

        </div>

    </div>

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="service_co"><span style="color: red">* </span>Service Co-Ordinator</label>

            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:60px !important" name="service_co[]" id="service_co" multiple>

                <?php
                $co_service = explode(",",$value['service_co']);
                 foreach ($service_co as $key => $row) { ?>

                    <option value="<?php echo $row['user_id'];?>" <?php if(in_array($row['user_id'],$co_service)){ echo 'selected';} ?> ><?php echo $row['full_name'];?></option>

                <?php } ?>

            </select>

            <div id="tagsname"></div>

        </div>

        <div class="col-lg-1 col-md-1 col-sm-12">

            <label for="show_owner">Show Owner</label>

            <input type="CheckBox" name="show_owner" class="form-control m-input" id="show_owner" style="" value="1" <?php echo (!empty($value['show_owner']))?'checked':'' ?> >

            <div id="tagsname"></div>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12" style="display: none">

            <label for="org_int"><span style="color: red">* </span>Org. Inter</label>

            <select class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" style="padding:.46rem 1.15rem !important; height:30px !important" name="org_int" id="org_int">

                <?php foreach ($rfq as $key => $row) { ?>

                    <option value="<?php echo $row['b_id'];?>"><?php echo $row['title'];?></option>

                <?php } ?>

            </select>

        </div>

        <div class="col-lg-2 col-md-2 col-sm-12">

            <label for="added_cost"><span style="color: red">* </span>Added Cost</label>

            <input type="number" min="0" step="1" name="added_cost" class="form-control m-input" id="added_cost" style="" value="<?php echo $value['added_cost']??''; ?>" required >

            <div id="tagsname"></div>

        </div>

        <div class="col-lg-3 col-md-3 col-sm-12">

            <label for="followupDate"><span style="color: red">* </span>Follow up date</label>

            <input type="date" min="0" step="1" name="followupDate" class="form-control m-input" id="followupDate" style="" value="<?php echo $value['followupDate']??''; ?>" required>

            <div id="tagsname"></div>

        </div>

    </div>

    <!-- Div to replace identifier -->

    <div class="form-group m-form__group row m--margin-top-20">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <div id="company_type"></div>

            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>

            <?php if(empty($value)) { ?>

                <button type="submit" data-type="save_n_close" class="btn btn-primary m-btn" id="saveAs" style="font-family: sans-serif, Arial;">Save & New</button>

                <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>

            <?php } ?>

        </div>

    </div>

</form>