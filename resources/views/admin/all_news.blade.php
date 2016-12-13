@extends('admin.admin_layout_master')
@section('content')


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        News
                    </h2>

                </div>
                <div class="body">
                    @if($newsList->isEmpty())
                        <h5>No news was found in the system</h5>
                    @else

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>News title</th>
                                <th>Content</th>
                                <th>Published by</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>News title</th>
                                <th>Content</th>
                                <th>Published by</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>


                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach ($newsList as $news)
                                @if($news->status!=$news->deleted)
                                    <tr id="row{{$news->id}}">
                                        <td><a target="_blank" href="{{url('/news/' . $news->news_slug)}}">{{$news->news_title}}</a></td>
                                        <td>{{$news->news_content}}</td>
                                        <td>{{$news->user->first_name}} {{$news->user->last_name}}</td>
                                        <td>{{$news->category->category_name}}</td>
                                        <td id="status{{$news->id}}">{{$news->status}}</td>
                                        @if($news->status==$news->unpublished || $news->status==$news->pending)
                                            <td><button id="btn{{$news->id}}" onclick="operationNews({{$news->id}})" type="button" class="btn btn-success">Publish</button></td>

                                        @else
                                            <td ><button id="btn{{$news->id}}" onclick="operationNews({{$news->id}})"  type="button" class="btn btn-danger">Unpublish</button></td>
                                        @endif

                                        <td><button onclick="deleteNewsPost({{$news->id}})"  type="button" class="btn btn-danger">Delete</button></td>
                                    </tr>
                                @endif
                            @endforeach


                            </tbody>
                        </table>

                    @endif

                    <br>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <label id="errorMessage" style="color: red"></label>
                            <label id="alertMsg" style="color: green"></label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

    <script type="text/javascript" src="{{asset('developer/admin/js/pages/tables/jquery-datatable.js')}}" ></script>

    <script>

        function deleteNewsPost(newsId) {
            $.ajax({
                type: "POST",
                url: $('#baseUrl').val() + 'admin/news/delete/'+newsId,
                success: function (data) {


                    if (data.responseStat.status == true) {
                        $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                        $('#row'+newsId).hide();


                    } else {
                        $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                    }


                },
                error: function () {
                    $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                }
            });
        }


        function operationNews(newsId) {
            var operation=$('#btn'+newsId).text();
            var url;
            if (operation=='Publish'){
                url='admin/news/publish/'+newsId;

            }else if (operation=='Unpublish'){
                url='admin/news/unpublish/'+newsId;

            }


            $.ajax({
                type: "POST",
                url: $('#baseUrl').val() + url,

                success: function (data) {


                    if (data.responseStat.status == true) {


                        if (operation=='Publish'){
                            $('#status'+newsId).text('Publish');

                            $('#status'+newsId).css('color','green');
                            $('#btn'+newsId).text('Unpublish');
                            $('#btn'+newsId).removeClass('btn btn-success');
                            $('#btn'+newsId).addClass('btn btn-danger');
                            $("#alertMsg").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);





                        }else if(operation=='Unpublish'){
                            $('#status'+newsId).text('Unpublished');
                            $('#status'+newsId).css('color','red');

                            $('#btn'+newsId).text('Publish');

                            $('#btn'+newsId).removeClass('btn btn-danger');
                            $('#btn'+newsId).addClass('btn btn-success');
                            $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);

                        }



                    } else {
                        $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);

                    }


                },
                error: function () {
                    $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                }
            });


        }


    </script>
@stop