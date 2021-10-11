<div class="m-subheader displaynone">

    <div class="d-flex align-items-center">

        <!-- <div class="mr-auto">

            <a class="m-subheader__title m-subheader__title--separator" href="#"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsive" style="width: 300px; height: 75px;"></a>           

        </div> -->

        <!-- display message -->

        <?php //echo componentMsg(); ?>

        <!-- Alert for Delete & Import Excel -->

        <?php

            $msg = '';

            $msg = $this->session->userdata('setMessage');

             if (isset($msg) && $msg == 'Added') { ?>

        <div id="deleteMsg">

            <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> <?php if(isset($module_name)) { echo ucwords($module_name); }?> Added Successfully</div>

        </div>

        <?php 

            } if (isset($msg) && $msg == 'Updated') { ?>

        <div id="deleteMsg">

            <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> <?php if(isset($module_name)) { echo ucwords($module_name);; }?> Updated Successfully</div>

        </div>

        <?php 

            } if (isset($msg) && $msg == 'Imported') { ?>

        <div id="deleteMsg">

            <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> <?php if(isset($module_name)) { echo ucwords($module_name);; }?> Data Imported Successfully</div>

        </div>

        <?php 

            } if (isset($msg) && $msg == 'deleted') { ?>

        <div id="deleteMsg">

            <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> <?php if(isset($module_name)) { echo ucwords($module_name);; }?> Deleted Successfully</div>

        </div>

   		 <?php }  if (isset($msg) && $msg == 'UpdatedConverted') { ?>

        <div id="deleteMsg">

            <div class='alert alert-success delete'  style='width:336px'><strong>Success!</strong> <?php if(isset($module_name)) { echo ucwords($module_name);; }?> Updated And Converted To Job Successfully</div>

        </div>

         <?php }

            $this->session->unset_userdata('setMessage');?>

        <div>

        </div>

    </div>

</div>