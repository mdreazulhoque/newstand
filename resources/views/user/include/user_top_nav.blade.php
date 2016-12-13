<!-- Navigation -->
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" style='font-weight: bold;    font-size: 40px;' href="{{ url('') }}">News Stand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ url('') }}">Home</a>
                </li>
                                 
                <li>
                    <a href="{{ url('/about') }}">About Us</a>
                </li>
                @if(!\Illuminate\Support\Facades\Auth::check())
                    
                    <li>
                        <a href="{{\Illuminate\Support\Facades\URL::to('user/login/view')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{\Illuminate\Support\Facades\URL::to('user/register/view')}}">Register</a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/allnews') }}">All News</a>
                    </li>
                    <li>
                        <a href="{{ url('/mynews') }}">My News</a>
                    </li>
                    <li>
                        <a href="{{ url('/createnews') }}">Create News</a>
                    </li>
                    <li>
                        <a href="">{{@\Illuminate\Support\Facades\Auth::user()->email}}</a>
                    </li>
                    <li>
                        <a href="{{URL::to('logout')}}">Logout</a>
                    </li>
                @endif 
            </ul>
            <div> </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<input type="hidden" id="baseUrl" value="{{url('/')}}/"/>
