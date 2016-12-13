<!-- Footer -->
<a style="margin-left: 102px;" target="_blank" href="{{ url('rss?output=rss') }}">
    <span class="fa-stack fa-lg">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
    </span>
    Subscribe For RSS Feed
</a>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <a  target="_blank" href="{{ url('rss?output=rss') }}">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
<!--                    <li>
                        <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>-->
                </ul>
                <p class="copyright text-muted">Copyright &copy; News Stand 2016</p>
            </div>
        </div>
    </div>
</footer>



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

<!-- Bootstrap Core Js -->
<script src="{{asset('developer/admin/plugins/bootstrap/js/bootstrap.js')}}"></script>



<!-- Theme JavaScript -->
<script src="{{asset('developer/user/js/clean-blog.min.js')}}"></script>


