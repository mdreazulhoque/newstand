<!DOCTYPE html>
<html>
<head>
    <title>User-Registration</title>
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
                    <a href="{{\Illuminate\Support\Facades\URL::to('user/login/view')}}">
                        <strong>Login</strong>
                    </a>
                </span>
        <div class="clr"></div>
    </div><!--/ freshdesignweb top bar -->
    <header>
        <h1>User Registration</h1>
    </header>
    <div  class="form">
        <div id="contactform">
            <p class="contact"><label for="name">First Name</label></p>
            <input id="first_name" name="first_name" placeholder="First name" required="" tabindex="1" type="text">

            <p class="contact"><label for="name">Last Name</label></p>
            <input id="last_name" name="last_name" placeholder="Last name" required="" tabindex="1" type="text">

            <p class="contact"><label for="name">Phone</label></p>
            <input id="phone" name="phone" placeholder="Phone" required="" tabindex="1" type="text">

            <p class="contact"><label for="email">Email</label></p>
            <input id="email" name="email" placeholder="example@domain.com" required="" type="email">

            <fieldset>
                <label>Birthday</label>
                <label class="month">
                    <select class="select-style" id="birth_month" name="birth_month">
                        <option value="">Month</option>
                        <option  value="01">January</option>
                        <option value="02">February</option>
                        <option value="03" >March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12" >December</option>
                </label>
                </select>
                <label>Day<input class="birthday" maxlength="2" id="birth_day" name="birth_day"  placeholder="Day" required=""></label>
                <label>Year <input class="birthyear" maxlength="4" id="birth_year" name="birth_year" placeholder="Year" required=""></label>
            </fieldset>

            <p class="contact"><label for="name">Address</label></p>
            <input id="address" name="address" placeholder="Address" required="" tabindex="1" type="text">
            <br>
            <input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="button" onclick="register()">
        </div>
        <div id="notification"></div>
    </div>
</div>
<input type="hidden" id="baseUrl" value="{{url('/')}}/"/>
</body>

<script>

    function register() {

        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'user/register',
            data: {

                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                birth_month: $("#birth_month option:selected").val(),
                birth_day: $('#birth_day').val(),
                birth_year: $('#birth_year').val(),
                address: $('#address').val()


            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                    window.setTimeout(function() {
                        window.location.href = $('#baseUrl').val() + 'home';
                    }, 3000);

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
