<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>

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
                    <li><a href="{{ url('/category') }}">{{$rowData->category_name}}</a>
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
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>