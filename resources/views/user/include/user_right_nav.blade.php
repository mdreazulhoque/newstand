<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control" value='@if(isset($searchVal)) {{$searchVal}}@endif ' name="search" onkeydown="if (event.keyCode == 13) submit_search()" id="search" placeholder='wirte and click search icon'>
            <span id='error' style='color: red;' ></span>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="submit_search();">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>
    <script>
        function submit_search(){
            var search_val=$('#search').val();
            if(search_val == ''){
                $('#search').focus();
                $('#error').html('Write Something For Search');
                return false;
            }
            window.location.assign($('#base_url').val()+'/news/search/'+search_val);
        }
    </script>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>News Categories</h4>
        <div class="row">
            <?php $cont = 0; ?>
            @foreach($categoryList as $rowData)
            @if($cont%4 == 0)
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    @endif 
                    <li><a href="{{ url('/news/category/' . $rowData->id) }}">{{$rowData->category_name}}</a>
                    </li>
                    <?php $cont++; ?>
                    @if($cont%4 == 0)
                </ul>
            </div>
            @endif 
            @endforeach
            
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>About Copyright News</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>