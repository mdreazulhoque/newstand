function login() {
        $('#notification').html('');
        $.ajax({
            type: "POST",
            url: $('#baseUrl').val() + 'login',
            data: {
                email: $('#email').val(),
                role: "User",
                password: $('#password').val()
            },
            success: function (data) {


                if (data.responseStat.status == true) {

                    $('#notification').html(data.responseStat.msg);
                        window.location.href = $('#baseUrl').val() + 'home';

                } else {
                    $('#notification').html(data.responseStat.msg);
                }


            },
            error: function () {
                alert('Error occured');
            }
        });

    }

    $('#submitBtn').click(function () {

        if($('#category').val()==""){
            $('#notification').html("Category Can Be Empty");
            return false;
        }
        if($('#news_title').val()==""){
            $('#notification').html("News Title Can Be Empty");
            return false;
        }
        if($('#photo_url').val()==""){
            $('#notification').html("Photo Must Be Uploaded");
            return false;
        }
        if(tinyMCE.activeEditor.getContent({format : 'text'})==""){
            $('#notification').html("News Content Title Can Be Empty");
            return false;
        }
        $('#news_content').val(tinyMCE.activeEditor.getContent({format : 'text'}));

        $('#formSubmit').submit();

    });

    function register() {
        $('#notification').html('');
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