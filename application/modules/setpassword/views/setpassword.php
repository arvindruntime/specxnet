<h1 class="title-agile text-center"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png"></h1>
<div class="content-w3ls">
    <div class="content-top-agile">
        <h2>Log in</h2>
    </div>
    <div class="content-bottom">
        <div id="main">
           <div id="first">
                <form class="m-login__form m-form" id="signIn" action="<?php echo base_url();?>setpassword/authenticate">
                    <div id="validation_errors"></div>
                    <span id="errEmail"></span>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input id="text1" type="email" id="emaillogin" placeholder="Registered Email" name="email" required>
                        </div>
                        
                    </div>
                    <span id="errPass"></span>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="password" type="Password" placeholder="Password" id="password" name="password" required>
                        </div>

                    </div>
                    <span id="errConfPass"></span>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="confirm_password" type="Password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" required>
                        </div>

                    </div>
                    <div class="wthree-field">
                        <input type="hidden" id="hash" name="hash">
                        <input type="submit" id="m_login_signin_submit" value="Set Password" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.baseUrl = <?php echo base_url(); ?>
</script>