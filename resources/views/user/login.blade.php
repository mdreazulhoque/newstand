@extends('user.user_signup')


@section('content')

<div class="col-md-4 col-md-offset-4" style="margin-top: 100px;min-height: 365px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">
                        SIGN IN</h5>
                    <form class="form form-signup" role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" id="password" name="password"   class="form-control" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <span id="notification" style="color: red;"></span>
                <a onclick="login()" class="btn btn-sm btn-primary btn-block" role="button">
                    SUBMIT</a> </form>
            </div>
        </div>
@endsection
