<!DOCTYPE html>
<html>

@include('user.include.user_head')
@include('user.include.user_top_nav')


<body class="theme-red">
<input type="hidden" id="baseUrl" value="{{url('/')}}/"/>


<!-- Page Content -->
<div class="container">

    <div class="row">

            @yield('content')
        </div>
    </div>



@include('user.include.user_footer')
</body>

</html>
