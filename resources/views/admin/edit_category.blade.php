@extends('admin.admin_layout_master')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>

                       Edit Category
                    </h2>


                </div>
                <div class="body">
                    <form role="form" class="form-horizontal" onsubmit="return updateCategory({{$cat->id}});">
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="fname">Category Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="cat_name" name="cat_name" class="form-control"
                                               value="{{$cat->category_name}}">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Category
                                </button>
                            </div>
                        </div>

                        <br>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <label id="errorMessage" style="color: red"></label>
                                <label id="alertMsg" style="color: green"></label>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function updateCategory(catid) {


            var cat_name = $('#cat_name').val();

            var flag = true;
            var message = "";

            if (!cat_name) {
                message = "Category Name is empty";
                flag = false;
            }


            if (flag == false) {
                $('#errorMessage').text(message);
                message = "";

                return false;
            } else {
                $('#errorMessage').hide();

            }


            $.ajax({
                type: "POST",
                url: $('#baseUrl').val() + 'admin/category/edit',
                data: {

                    cat_name: cat_name,
                    id:catid

                },
                success: function (data) {


                    if (data.responseStat.status == true) {
                        $("#alertMsg").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500, function () {
                            window.location.replace($('#baseUrl').val() + "admin/category/all")
                        });


                    } else {
                        $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                    }


                },
                error: function () {
                    $("#errorMessage").html(data.responseStat.msg).fadeIn(500).delay(2000).fadeOut(500);
                }
            });


            return false;


        }

    </script>
@endsection
