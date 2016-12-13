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
                <p class="copyright text-muted">Copyright &copy; News Stand 2016</p>
            </div>
        </div>
    </div>
</footer>

<script>

    function login() {

        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'login',
            data: {
                email: $('#email').val(),
                password: $('#password').val(),
            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                    window.setTimeout(function () {
                        window.location.href = $('#baseUrl').val() + 'home';
                    }, 3000);

                } else {
                    $('#notification').html(data.responseStat.msg);
                }


            },
            error: function () {
                alert('Error occured');
            }
        });

    }


    function register() {

        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'user/register',
            data: {

                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                phone: $('#phone').val(),
                email: $('#email').val(),
                birth_month: $("#birth_month option:selected").val(),
                birth_day: $('#birth_day').val(),
                birth_year: $('#birth_year').val(),
                address: $('#address').val()


            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                    window.setTimeout(function () {
                        window.location.href = $('#baseUrl').val() + 'home';
                    }, 3000);

                } else {
                    $('#notification').html(data.responseStat.msg);
                }


            },
            error: function () {
                alert('Error occured');
            }
        });

    }

    function submit_search() {
        var search_val = $('#search').val();
        if (search_val == '') {
            $('#search').focus();
            $('#error').html('Write Something For Search');
            return false;
        }
        window.location.assign($('#baseUrl').val() + '/news/search/' + search_val);
    }
</script>

<!-- Bootstrap Core Js -->
<script src="{{asset('developer/admin/plugins/bootstrap/js/bootstrap.js')}}"></script>



<!-- Theme JavaScript -->
<script src="{{asset('developer/user/js/clean-blog.min.js')}}"></script>


