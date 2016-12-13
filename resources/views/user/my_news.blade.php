@extends('user.user_signup')

@section('content')
    <div class="col-lg-12">
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                        <h2>Basic Table</h2>
                        <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>News Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($newsList))
                                @foreach($newsList as $key=>$rowData)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$rowData->news_title}}</td>
                                    <td>{{$rowData->status}}</td>
                                    <td><a class="btn btn-primary" href="{{url('mynews/'.$rowData->news_slug)}}">Details</a> <a class="btn btn-danger" href="{{url('delete_news/'.$rowData->id)}}">Delete</a></td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection