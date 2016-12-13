<style>
    div.report-container{
        font-family: 'RobotoDraft', sans-serif;
        height: 100%;
        width: 100%;
    }
    .invoice-body .table thead th{
        font-weight: 500;
        font-size: 16px;
    }
    .invoice-body strong{
        font-weight: 500;
    }
    .table-invoice{
        width: 100%;
    }
    .table-invoice > thead > tr > th, .table-invoice > tbody > tr > th, .table-invoice > tfoot > tr > th, .table-invoice > thead > tr > td, .table-invoice > tbody > tr > td, .table-invoice > tfoot > tr > td{
        padding: 3px 10px;
        border: 1px solid black;
        border-collapse: collapse;
        text-align: left;
        font-size: 12px;

    }
    .table-invoice > thead > tr > th{
        font-size:13px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
    }

</style>

<div class="report-container">
    <h2 class="col-md-12 mall-invoice-top clearfix" style="background:transparent;">
        <a href="#" class="company-logo">News Stand</a>
    </h2>
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

    @endif
</div>