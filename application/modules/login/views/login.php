<h1 class="title-agile text-center"><img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" style="height: 109px;
width: 445px;"></h1>
<div class="content-w3ls">
    <div class="content-top-agile">
        <h2>Log in</h2>
    </div>
    <div class="content-bottom">
        <div id="main">
            <div id="first">
                <form class="m-login__form m-form" id="signIn" action="<?php echo base_url();?>login/authenticate">
                    <div id="validation_errors"></div>
                    <span id="errEmail"></span>
                    <div class="field-group">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input id="text1" type="text" id="emaillogin" placeholder="Username" name="username" required>
                        </div>

                    </div>
                    <span id="errPass"></span>
                    <div class="field-group">
                        <span class="fa fa-lock" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="password" type="Password" placeholder="Password" id="password" name="password" required>
                        </div>

                    </div>
                    <ul class="list-login">
                        <li class="switch-agileits">
                            <p id="two"><a class="signup" href="#" id="signup">Forgot Password ?</a></p>
                        </li>

                        <li class="clearfix"></li>
                    </ul>
                    <div class="wthree-field">
                        <input type="hidden" id="hash" name="hash">
                        <input type="submit" id="m_login_signin_submit" value="Log in" />
                    </div>
                </form>
            </div>
            <!-- Create Div Second For Signup Form-->
            <div id="second">
                <form class="m-login__form m-form" id="forgotPassword" action="<?php echo base_url();?>login/forgotPassword">
                    <h3 class="forgot-text">Forgotten Password ?</h3>
                    <h5 class="enter-text">Enter your email to reset your password:</h5>
                    <div id="validation_errors2"></div>
                    <div class="field-group">
                        <span class="fa fa-envelope" aria-hidden="true"></span>
                        <div class="wthree-field">
                            <input name="email" id="email" type="email" value="" placeholder="Email" required>
                        </div>
                    </div>
                    <button type="submit" id="request" class="btn m-btn--square  btn-primary">Reset Password</button>
                    <p id="two" class="already-text">Already have an account? <a class="signin" href="#" id="signin">Sign in</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
