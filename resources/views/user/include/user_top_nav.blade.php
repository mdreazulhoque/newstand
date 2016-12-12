<!-- Navigation -->
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.html">Start Bootstrap</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
                <li>
                    <a href="post.html">Sample Post</a>
                </li>
                <li>
                    <a href="contact.html">Contact</a>
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
                        <a href="">{{@\Illuminate\Support\Facades\Auth::user()->first_name}}</a>
                    </li>
                @endif
            </ul>
            <div> </div>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
