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
                                <th>Short Description</th>
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
                                <th>Short Description</th>
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
                                        <td>{{$news->news_title}}</td>
                                        <td>{{$news->news_content}}</td>
                                        <td>{{$news->user->first_name}} {{$news->user->last_name}}</td>
                                        <td>{{$news->category->category_name}}</td>
                                        <td>{{$news->status}}</td>
                                        @if($news->status==$news->unpublished || $news->status==$news->pending)
                                            <td><button id="btn{{$news->id}}"  type="button" class="btn btn-success">Publish</button></td>

                                        @else
                                            <td ><button id="btn{{$news->id}}"   type="button" class="btn btn-danger">Unpublish</button></td>
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


        function activationCategory(catid) {
            var operation=$('#btn'+catid).text();
            var url;
            if (operation=='Activate'){
                url='admin/category/activate/'+catid;

            }else if (operation=='Deactivate'){
                url='admin/category/deactivate/'+catid;

            }

            $.ajax({
                type: "POST",
                url: $('#baseUrl').val() + url,

                success: function (data) {


                    if (data.responseStat.status == true) {


                        if (operation=='Activate'){
                            $('#'+catid).text('Activate');
                            $('#'+catid).css('color','green');
                            $('#btn'+catid).text('Deactivate');
                            $('#btn'+catid).removeClass('btn btn-success');
                            $('#btn'+catid).addClass('btn btn-danger');
                            $("#alertMsg").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);


                        }else if(operation=='Deactivate'){
                            $('#'+catid).text('Deactivate');
                            $('#'+catid).css('color','red');

                            $('#btn'+catid).text('Activate');
                            $('#btn'+catid).removeClass('btn btn-danger');
                            $('#btn'+catid).addClass('btn btn-success');
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