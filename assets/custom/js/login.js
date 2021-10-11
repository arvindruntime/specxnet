$(document).ready(function() {

    $('form#signIn').submit(function(e) {

        var form = $(this);

        e.preventDefault();

        //alert(form.serialize());

        var email = $("#emaillogin").val();

        var password = $("#password").val();

        if (password == "") {

            $('#errPass').html('Error:Password is missing');

            return false;

        } else if (email == "") {

            $('#errEmail').html('Error:Email is missing');

            return false;

        } else {

            // var hash = CryptoJS.MD5(password);

            // $("#password").val(password);

            // $( "#hash" ).val(password);

            $.ajax({

                type: "POST",

                url: 'login/authenticate',

                data: form.serialize(), // <--- THIS IS THE CHANGE

                dataType: "html",

                success: function(data) {

                    var newData = JSON.parse(data);

                    if (newData.message == 'Success') {

                        var msg = "<div class='alert-login-success'><strong>Success!</strong> Access Granted !</div>";

                        $('#validation_errors').html(msg);

                        window.location.href = 'dashboard';

                    } else if (newData.message == 'No Access') {

                        var msg = "<div class='alert-login-danger'><strong>You do not have enough permissions to login. Please contact Administrator !</strong></div>";

                        $('#validation_errors').html(msg);

                        $("#password").val(password);

                    } else {

                        var msg = "<div class='alert-login-danger'><strong>Oops! </strong>Invalid Username Or Password.</div>";

                        $('#validation_errors').html(msg);

                        $("#password").val(password);

                    }



                },

                error: function() { alert("Error posting feed."); }

            });

        }





    });



    //=================Forgot Password=====================================



    $('form#forgotPassword').submit(function(e) {

        var form = $(this);

        e.preventDefault();



        var email = $("#m_email").val();

        $('#request').html('Requesting..');

        //console.log(email);

        if (email == "") {

            $('#errEmailForgot').html('Error:Email is missing');

            $('#request').html('Reset Password');

            return false;

        } else {

            $.ajax({

                type: "POST",

                url: 'login/forgotpassword',

                data: form.serialize(), // <--- THIS IS THE CHANGE

                dataType: "html",

                success: function(data) {

                    var newData = JSON.parse(data);

                    if (newData.message == 'Success') {

                        var msg = "<div class='alert-login-success'><strong>Cool! </strong>Password recovery instruction has been sent to your email.</div>";

                        $('#validation_errors2').html(msg);

                        $('#request').html('Request');

                        //window.location.href = "<?php echo base_url().'Company/internal'; ?>";

                    } else if (newData.code == 404) {

                        var msg = "<div class='alert-login-danger'><strong>Oops! </strong>This Email is not registered with us.</div>";

                        $('#validation_errors2').html(msg);

                        $('#request').html('Request');

                    } else {

                        $('#validation_errors2').html(data);

                    }



                },

                error: function() { alert("Error posting feed."); }

            });

        }





    });



    $("#signup").click(function() {

        $("#first").slideUp("slow", function() {

            $("#second").slideDown("slow");

        });

    });

    // On Click SignIn It Will Hide Registration Form and Display Login Form

    $("#signin").click(function() {

        $("#second").slideUp("slow", function() {

            $("#first").slideDown("slow");

        });

    });

});