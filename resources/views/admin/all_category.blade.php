@extends('admin.admin_layout_master')
@section('content')


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Category List
                    </h2>

                </div>
                <div class="body">
                    @if($catList->isEmpty())
                        <h5>Currently There is no news category is enlisted in the system.</h5>
                    @else

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>


                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach ($catList as $cat)
                                @if($cat->status!=$cat->deleted)
                                <tr id="row{{$cat->id}}">
                                    <td>{{$cat->category_name}}</td>

                                    @if($cat->status==='Active')
                                        <td id="{{$cat->id}}" style="color: green">Active</td>
                                    @else
                                        <td id="{{$cat->id}}" style="color: red">Deactivate</td>
                                    @endif

                                    @if($cat->status==$cat->active)
                                        <td ><button id="btn{{$cat->id}}"  onclick="activationCategory({{$cat->id}});" type="button" class="btn btn-danger">Deactivate</button></td>
                                    @else
                                        <td><button id="btn{{$cat->id}}" onclick="activationCategory({{$cat->id}});" type="button" class="btn btn-success">Activate</button></td>
                                    @endif

                                    <td><a class="btn btn-primary" href="{{url('admin/category/edit/view/'.$cat->id)}}" role="button">Edit</a></td>

                                    <td><button onclick="deleteCategory({{$cat->id}})" type="button" class="btn btn-danger">Delete</button> </td>

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

        function deleteCategory(catid) {
            $.ajax({
                type: "POST",
                url: $('#baseUrl').val() + 'admin/category/delete/'+catid,
                success: function (data) {


                    if (data.responseStat.status == true) {
                        $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                        $('#row'+catid).hide();


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