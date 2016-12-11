@extends('admin.admin_layout_master')
@section('content')


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Lab Reports
                    </h2>

                </div>
                <div class="body">
                    @if($catList->isEmpty())
                        <h5>Currently There is no Lab Test category is enlisted in the system.</h5>
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
                                @if($cat->status!='Deleted')
                                <tr>
                                    <td>{{$cat->category_name}}</td>

                                    @if($cat->status==='Active')
                                        <td id="{{$cat->id}}" style="color: green">Active</td>
                                    @else
                                        <td id="{{$cat->id}}" style="color: red">Deactivate</td>
                                    @endif

                                    @if($cat->status==='Active')
                                        <td ><button type="button" class="btn btn-danger">Deactivate</button></td>
                                    @else
                                        <td><button type="button" class="btn btn-success">Activate</button></td>
                                    @endif

                                    <td><button type="button" class="btn btn-primary">Edit</button></td>

                                    <td><button type="button" class="btn btn-danger">Delete</button> </td>

                                </tr>
                                @endif
                            @endforeach


                            </tbody>
                        </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->

    <script type="text/javascript" src="{{asset('developer/admin/js/pages/tables/jquery-datatable.js')}}" ></script>

    <script>



    </script>
@stop