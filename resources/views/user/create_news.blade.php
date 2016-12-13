@extends('user.user_master')

@section('content')
    <div class="col-lg-8">
        <div class="col-md-8 col-md-offset-1" style="margin-top: 20px;">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5 class="text-center">
                        Create News</h5>
                    <form class="form form-signup" id="formSubmit" method="post" action="{{url('/newsPost')}}" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <label>Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">Select Category</option>
                                    @if(count($category)>0)
                                        @foreach($category as $itemCate)
                                         <option  value="{{$itemCate->id}}">{{$itemCate->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label  for="title">Title</label>
                                <input type="text" class="form-control" id="news_title" name="news_title" placeholder="Title"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label>Upload Image</label>
                        </span>
                                <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                               <label for="news_content">News Content</label>
                                <input type="hidden" name="news_content" id="news_content" value="">
                                <textarea class="form-control" id="content" name="content" placeholder="News Content" ></textarea>
                            </div>
                        </div>
                </div>
                <span id="notification" style="color: red;"></span>
                <button class="btn btn-sm btn-primary btn-block" id="submitBtn" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection