<!DOCTYPE html>
<html>

@include('admin.include.admin_head')

<body class="theme-red">
<input type="hidden" id="baseUrl" value="{{url('/')}}/" />

@include('admin.include.admin_search_bar')

@include('admin.include.admin_top_nav')


@include('admin.include.admin_left_side_bar')


<section class="content">
    <div class="container-fluid">

        @yield('content')


    </div>
</section>

@include('admin.include.admin_footer')
</body>

</html>