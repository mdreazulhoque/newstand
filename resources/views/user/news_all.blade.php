@extends('user.user_master')


@section('content')


            
@section('content')

            
            <div class="col-md-8">
                <h1 class="page-header">
                    Latest News
                    <small>news for all </small>
                </h1>
            <!-- Blog Entries Column -->
            @if(count($newsList) == 0) 
            <h1 style='margin-top: 250px;' >No post found !Please Another One</h1>
            @else 

                
                @foreach($newsList as $rowData)
                        <!--  Blog Post -->
                        <h2>
                            <a href="{{url('/news/' . $rowData->news_slug)}}">{{$rowData->news_title}}</a>
                        </h2>
                        <p class="lead">
                            by <a href="#">{{$rowData->user->first_name}} {{$rowData->user->last_name}}</a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on {{date( 'F d,Y   h:i A', strtotime( $rowData->created_at ) )}} </p>
                        <hr>
                        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                        <hr>                        
                        <p>
                        <?php
                        $string = strip_tags($rowData->news_content);

                        if (strlen($string) > 500) {

                            // truncate string
                            $stringCut = substr($string, 0, 500);                            
                            // make sure it ends in a word so assassinate doesn't become ass...
                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
                        }
                        echo $string;
                        ?>
                        </p>
                        <a class="btn btn-primary" href="{{url('/news/' . $rowData->news_slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                @endforeach
                @endif 
            </div>





        <!-- /.row -->

        <hr>
        

@endsection