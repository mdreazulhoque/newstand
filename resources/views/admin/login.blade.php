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
        <div class="clr"></div>
    </div><!--/ freshdesignweb top bar -->
    <header>
        <h1>Admin Login</h1>
    </header>
    <div  class="form">
        <div id="contactform">

            <p class="contact"><label for="email">Email</label></p>
            <input id="email" name="email" placeholder="example@domain.com" required="" type="email">

            <p class="contact"><label for="name">Password</label></p>
            <input id="password" name="password" placeholder="Password" required="" tabindex="1" type="password">

            <br>
            <span id="notification" style="color: red;"></span><br><br>
            <input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="button" onclick="adminlogin()">
        </div>
    </div>
</div>
<input type="hidden" id="baseUrl" value="{{url('/')}}/"/>
</body>

<script>

    function adminlogin() {

        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'login',
            data: {
                email: $('#email').val(),                
                role: "Admin",
                password: $('#password').val()
            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                    window.location.href = $('#baseUrl').val() + 'admin/home';

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
