$(document).ready(function() {
    $('form#signIn').submit(function(e) {
        var form = $(this);
        e.preventDefault();
        //alert(form.serialize());
        var email = $("#emaillogin").val();
        var password = $( "#password").val();
        var confirm_password = $( "#confirm_password").val();
        if(password =="") {
            $('#errPass').html('Error:Password is missing');
            return false;
        } else if(confirm_password =="") {
            $('#errConfPass').html('Error:Confirm Password is missing');
            return false;
        } else if(email=="") {
            $('#errEmail').html('Error:Email is missing');
            return false;
        } else if(password != confirm_password) {
            $('#errConfPass').html('Error: Confirm Password Does Not Match With Password');
            return false;
        } else {
            var hash = CryptoJS.MD5(password);
            $( "#password" ).val(hash);
            $( "#confirm_password").val(hash);
            $( "#hash" ).val(password);
            $.ajax({
            type: "POST",
            url: 'setpassword/authenticate',
            data: form.serialize(), // <--- THIS IS THE CHANGE
            dataType: "html",
            success: function(data){
                var newData = JSON.parse(data);
                if (newData.message == 'Success') {
                    var msg = "<div class='alert-login-success'><strong>Success!</strong> Password Reset Successfully !</div>";
                    $('#validation_errors').html(msg);
                   window.location.href = window.baseUrl+'login';
                } else {
                    var msg = "<div class='alert-login-danger'><strong>Oops! </strong>Email Id not registered with us for Login!<br/>Please Contact Adminitrator</div>";
                    $('#validation_errors').html(msg);
                    $("#password").val('');
                    $("#confirm_password").val('');
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
