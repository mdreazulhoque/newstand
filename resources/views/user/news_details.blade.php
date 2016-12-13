@extends('user.user_master')

@section('content')
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=1648526795437995";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Blog Post Content Column -->
<div class="col-lg-8">
    @if(count($newsDetails) == 0) 
    <h1 style='margin-top: 250px;' >No post found !Please check URL</h1>
    @else        
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$newsDetails[0]->news_title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$newsDetails[0]->user->first_name}} {{$newsDetails[0]->user->last_name}}</a>        
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{date( 'F d,Y   h:i A', strtotime( $newsDetails[0]->created_at ) )}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$baseUrl}}/{{$rowData->photo_url}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">
        <?php
        echo $newsDetails[0]->news_content;
        ?>
    </p>
    <p>
    <a href="{{url('/news/download/' . $newsDetails[0]->news_slug)}}">
        <span class="fa-stack fa-lg">
            <i class="fa fa-download"></i>
        </span>
        Click Here Download PDF for this 
    </a></p>
    <hr>
    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
        <div class="fb-comments" data-href="{{url('/news/' . $newsDetails[0]->news_slug)}}" data-numposts="5"></div>
    </div>
    @endif 


</div>
@endsection