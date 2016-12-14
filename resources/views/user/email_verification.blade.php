<!DOCTYPE html>
<html>
<head>
    <title>User-Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="{{asset('developer/user/css/reg.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('developer/user/css/reg_demo.css')}}" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <!-- freshdesignweb top bar -->
    <div class="freshdesignweb-top">
        <a href="{{\Illuminate\Support\Facades\URL::to('home')}}">Home</a>
                <span class="right">
                    <a href="{{\Illuminate\Support\Facades\URL::to('user/register/view')}}">
                        <strong>Register</strong>
                    </a>
                </span>
        <div class="clr"></div>
    </div><!--/ freshdesignweb top bar -->
    <header>
        <h1>Email Verification</h1>
        <div>Your Email is successfully verified. Set your Password</div>

    </header>

    <div  class="form">
        <div id="contactform">

            <p class="contact"><label for="name">Password</label></p>
            <input id="password" name="password" placeholder="Password" required="" tabindex="1" type="password">

            <p class="contact"><label for="name">Confirm Password</label></p>
            <input id="confirm_password" name="password" placeholder="Confirm Password" required="" tabindex="1" type="password">

            <br>
            <input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="button" onclick="setPassword()">
        </div>
        <div id="notification"></div>
    </div>
</div>
<input type="hidden" id="baseUrl" value="{{url('/')}}/"/>
<input type="hidden" id="token" value="{{Session::get('token')}}"/>
</body>

<script>

    function setPassword() {

        if($('#token').val() ==""){
            $('#notification').html("Go back to your verification link and try again!");
            window.setTimeout(function() {
                window.location.href = $('#baseUrl').val() + 'home';
            }, 3000);
            return;
        }

        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'user/password/set/'+$('#token').val(),
            data: {
                password: $('#password').val(),
                confirm_password: $('#confirm_password').val(),
            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                    window.location.href = $('#baseUrl').val() + 'user/login/view';

                } else {
                    $('#notification').html(data.responseStat.msg);
                }


            },
            error: function () {
                alert('Error occured');
            }
        });

    }


</script>
</html>
