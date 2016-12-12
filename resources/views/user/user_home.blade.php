@extends('user.user_master')

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image:url( {{asset('developer/pic/home-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>News Stand</h1>
                        <hr class="small">
                        <span class="subheading">A news portal by news Stand</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

@section('content')


            <!-- Blog Entries Column -->

            <div class="col-md-8">
                <h1 class="page-header">
                    Latest News
                    <small>news for all </small>
                </h1>

                
                @foreach($categoryList as $rowData)
                        <!--  Blog Post -->
                        <h2>
                            <a href="#">Blog Post Title</a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php">Start Bootstrap</a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                        <hr>
                        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                @endforeach

            </div>




        <!-- /.row -->

        <hr>

@endsection