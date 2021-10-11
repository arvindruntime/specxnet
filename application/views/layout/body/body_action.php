<style>

    .datetimepicker-dropdown-bottom-right {

        top: 856.75px !important; 

    }

</style>

<div class="col-lg-2 col-md-2 col-sm-12 col-12">

   <div class="m-input glow-on-hover">

      <select class="form-control checked_action" name="" id="checkedAction" disabled="disabled">

        <option value="Checked Action" selected=""> Checked Action</option>

    <?php if (isset($deletePermission) || ($this->uri->segment(1) == 'opportunities')) {?>
        <option id="deleteRows" value="">Delete</option>
     <?php }?>

    <?php if (($this->session->userdata('adminAccess') == 'Yes') && (isset($module_name) && ($module_name == 'users' || $module_name == 'user'|| $module_name == 'lead'|| $module_name == 'activity'))) { ?>
        <option id="permanentDeleteRows" value="">Permanent Delete</option>
    <?php } ?>

    <?php if (isset($sendEmailPermission) && $sendEmailPermission && isset($module_name) && ($module_name == 'users' || $module_name == 'user')) { ?>
        <option id="sendEmail" value="">Send Email</option>
    <?php }?>

    <?php if (isset($assignTo)) { ?>
        <option id="AssignUser" value="">Assign Lead Opportunity</option>
    <?php }?>

      </select>

   </div>

</div>



<?php

if(isset($module_name) && ($module_name == 'users' || $module_name == 'user')) {

?>

<!-- User Send Email Popup -->



<div class="modal fade" id="role_new_modal" role="dialog" aria-labelledby="" aria-hidden="true" style="z-index:10000">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

        	<div id="validation_errors"> </div>

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">×</span>

                </button>

            </div>

            <form name="form" id="createRoleAjax" action="<?php echo base_url().$module_name;?>/sendBulkEmail" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-10 col-md-10 col-sm-12">

                            <label for="street_address">To</label>

                            <input type="text" name="usrEmail" id="emailIdUsr" class="form-control m-input" required="" readonly>

                        </div>

                    </div>

                    <!-- <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <label for="street_address">Cc</label>

                            <input type="text" name="userEmailCC" id="add_cc" class="form-control m-input">

                        </div>

                    </div>

                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <label for="street_address">Bcc</label>

                            <input type="text" name="userEmailBCC" id="add_bcc" class="form-control m-input">

                        </div>

                    </div> -->

                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <label for="street_address" style="margin-top:5px">Subject</label>    

                            <input type="text" name="usrSub" id="emailSubject" class="form-control m-input" required="">

                        </div>

                    </div>

                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <label for="street_address" style="margin-top:5px">Message</label>    

                            <textarea id="txtEditor" name="usrMsg"></textarea>

                        </div>

                    </div>



                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-2 col-md-4 col-sm-12" id="role_button_create">

                            <input type="checkbox" name="setDateTime" id="setDateTime"> Set Date Time ?



                            <!-- <div class="form-group">

                                <div class="input-group date form_datetime col-md-5" data-date="<?php echo date('Y-m-d')?>" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">

                                    <input class="form-control" size="16" type="text" value="" readonly>

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>

                                </div>

                                <input type="hidden" name="emailSetTime" id="dtp_input1" value="" /><br/>

                            </div> -->

                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12" id="draft_time" style="display: none;">

                            <input class="form-control m-input datepicker" style="width: 100%;" id="datepicker" type="datetime-local" name="draft_time" placeholder="eg: 23-Oct-2019" value="<?php echo isset($value['activity_end_datetime'])?$value['activity_end_datetime']:''; ?>">

                        </div>

                    </div>



                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-12 col-md-12 col-sm-12" id="role_button_create">

                            <button type="submit" id="sendmailtousers" class="btn btn-success m-btn"style="font-family: sans-serif, Arial;">Send</button>

                        </div>

                    </div>



            </form>

            </div>     

        </div>

    </div>

<?php } else { ?>

<!-- Assign Opportunity Popup -->



<div class="modal fade" id="role_new_modal" role="dialog" aria-labelledby="" aria-hidden="true" style="z-index:10000">

    <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">

            <div id="validation_errors"> </div>

            <div class="modal-header">

                <h5 class="modal-title">Assign Opportunity To User</h5>

                <button type="button" class="close" onclick="location.reload()" aria-label="Close">

                <span aria-hidden="true">×</span>

                </button>

            </div>

            <form name="form" id="createRoleAjax" action="<?php echo base_url().$module_name;?>/assignUser" method="POST" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="form-group m-form__group row m--margin-top-20">

                        <div class="col-lg-10 col-md-10 col-sm-12" id="salesperson">

                            

                        </div>

                    </div>

                    

                



                <div class="form-group m-form__group row m--margin-top-20">

                    <div class="col-lg-12 col-md-12 col-sm-12" id="role_button_create">

                        <button type="submit" class="btn btn-success m-btn"style="font-family: sans-serif, Arial;">Send</button>

                    </div>

                </div>

                



            </form>

            </div>     

        </div>

    </div>

<?php }?>

</div>