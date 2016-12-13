@extends('user.user_signup')


@section('content')

<div class="col-md-4 col-md-offset-4" style="margin-top: 100px;min-height: 365px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">
                        Enter your email address to send link:</h5>
                    <form class="form form-signup" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                        </div>
                    </div>
                </div>
                <span id="notification" style="color: red;"></span>
                <a onclick="sendResendVerificationLink()" class="btn btn-sm btn-primary btn-block" role="button">
                    SUBMIT</a> </form>
            </div>
   
        </div>
<script>
    function sendResendVerificationLink(){
        
        $('#notification').html('');
        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'resend_verification',
            data: {
                email: $('#email').val(),
                role: "User",
            },
            success: function (data) {

                if (data.responseStat.status == true) {
                    $('#notification').html(data.responseStat.msg)
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

@endsection
