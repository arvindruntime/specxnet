<div id="validation_errors"></div>
<form action="<?php echo base_url().'company/create/myprofile/'.$this->session->userdata('user_id'); ?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right">
    <div class="form-group m-form__group row m--margin-top-20 padtop3">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <label for="street_address">Email</label>
            <input type="text" name="email_id" id="email_id" class="form-control m-input" placeholder="Email Id" value="<?php echo isset($data[0]['email_id'])?$data[0]['email_id']:''; ?>" required>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <label for="street_address">Password</label>
            <input type="password" name="password" id="password" class="form-control m-input" placeholder="Password of your email ID" value="<?php echo isset($data[0]['password'])?$data[0]['password']:''; ?>" required>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <label for="street_address">Message Signature</label>
            <textarea class="form-control m-input" name="message_signature" id="message_signature" style="height: 100px !important;"><?php echo isset($data[0]['message_signature'])?$data[0]['message_signature']:''; ?></textarea>
        </div>
        <?php
        if (isset($data[0]['file'])) {
        ?>
        <!-- <div class="col-lg-8 col-md-8 col-sm-12" style="margin-top: 15px;margin-bottom: 15px;">
            <label for="street_address">Signature Image: </label>
            <img src="<?php echo base_url().'upload/'.$data[0]['file']?>">
        </div> -->
    <?php }?>
        <!-- <div class="col-lg-8 col-md-8 col-sm-12" style="margin-top: 10px;">
            <label for="street_address">Message Signature Image</label>
            <input type="file" name="message_signature_image" id="signature_iamge" class="form-control m-input">
        </div> -->

    </div>
    <div class="form-group m-form__group row m--margin-top-20 padtop3">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="submit" data-type="save" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;">Save</button>
            <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button>
        </div>
    </div>

                                