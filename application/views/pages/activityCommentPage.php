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