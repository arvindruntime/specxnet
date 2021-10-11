<?php
// $value = $Contact[0];

// $newval = explode(',', $value['user_info']);
// foreach($newval as $val) {
//     $val = explode('_', $val);
//     if ($val[1] == 'Email') {
//         $emailId[] = $val[0];
//     } else if ($val[1] == 'Phone') {
//         $phoneId[] = $val[0];
//     }
// }
?>
<div id="validation_errors"></div> 
<style type="text/css">
    img{
  max-width:100%;
}
.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #696f9799 none repeat scroll 0 0;
  border-radius: 3px;
  color: #151515;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 98%;
}

 .sent_msg p {
  background: #5867dd none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative; 
  margin-top: 20px;
}

.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { 
  padding: 0 0 50px 0; 
}
.msg_history {
  height: 400px;
  overflow-y: auto;
}
</style>

        <div class="modal-content updateActivity" id="addLeadActivity">
            
            <div class="">
                <div class="">
                    <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >
                            <div class="tab-pane margin-top2" id="m_portlet_base_demo_9_tab_content" role="tabpanel">
                                <div class="col-md-12">
                                    <div class="inbox-body" id="commentBox">
                                        <div class="inbox-content" style="">
                                            <div class="messaging">
                                                <div class="inbox_msg">
                                                    <div class="mesgs">
                                                        <div id="msg_history" class="msg_history">
                                                        <?php
                                                            foreach ($comment as $key => $value) {
                                                                if ($value['sender_id'] != $this->session->userdata('user_id')) {
                                                        ?>
                                                                <div class="incoming_msg">
                                                                    <div class="incoming_msg_img"> <img src="https://raw.githubusercontent.com/strahlistvan/Chatbot/master/robot-chef-cap-pizza-red-2.jpg" alt="sunil">
                                                                    </div>
                                                                    <div class="received_msg">
                                                                        <label><?php echo $value['full_name']?></label>
                                                                        <div class="received_withd_msg">
                                                                            <p><?php echo $value['comment']?></p>
                                                                            <span class="time_date" id="#welcome_time_date"><?php echo $value['created_date']?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php } else { ?>       
                                                                <div class="outgoing_msg">
                                                                    <div class="sent_msg">
                                                                        <p><?php echo $value['comment']?></p>
                                                                        <span class="time_date"><?php echo $value['created_date']?></span>
                                                                    </div>
                                                                </div>
                                                           <?php }} ?>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                    </div>                 
                </div>
            </div>  
        </div>
        <div class="modal-content" style="padding-left: 0px !important;">
            <div class="m-portlet__body margin-top2" style="padding: 5px 0 !important" >
                <form enctype="multipart/form-data" method="post" class="m-form m-form--fit m-form--label-align-right">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="user_type"></div>
                    <input type="hidden" name="lead_activity_id" id="lead_activity_id" value="<?php echo $activity_id;?>">
                    <div class="input-group">
                        <input type="text" class="form-control" id="comment" style="height: 40px !important;">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary m-btn" id="sendComment" style="font-family: sans-serif, Arial;margin-left: 10px;">Comment</button>
                        </span>
                    </div>
                    
                    <!-- <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="location.reload();">Close</button> -->
                </div>
            </form>
            </div>
            
        </div>