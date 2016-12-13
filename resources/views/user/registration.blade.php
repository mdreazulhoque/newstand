@extends('user.user_signup')


@section('content')

<div class="col-md-5 col-md-offset-3" style="margin-top: 20px;">
    <div class="panel panel-default">
        <div class="panel-body">
            <h5 class="text-center">
                SIGN UP</h5>
            <form class="form form-signup" role="form">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" />
                    </div>
                </div>    
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name"  />
                    </div>
                </div>    
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                        </span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" />
                    </div>
                </div>    
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <select class="form-control" id="birth_month" name="birth_month">
                                <option value="">Select Birth Month</option>
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
                        </select>
                        <select class="form-control" id="birth_day" name="birth_day" >
                                <option value="">Select Birth Day</option>
                                @for($i=1;$i<32;$i++)
                                <option  value="<?php if($i>10){ echo '0'.$i;} else{ echo $i;} ?>"><?php if($i>10){ echo '0'.$i;} else{ echo $i;} ?></option>                                
                                @endfor
                        </select>
                        <select class="form-control" id="birth_year" name="birth_year">
                                <option value="">Select Birth Year</option>
                                @for($i=1960;$i<2017;$i++)
                                <option  value="{{$i}}">{{$i}}</option>                                
                                @endfor
                        </select>
                    </div>
                </div>    
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                    </div>
                </div>   

                
        </div>
        <span id="notification" style="color: red;"></span>
        <a onclick="register()" class="btn btn-sm btn-primary btn-block" role="button">
            SUBMIT</a> </form>
    </div>
</div>
@endsection

