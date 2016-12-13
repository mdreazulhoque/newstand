Dear {{ $last_name }},
<br>
Click this link to verify your email address : {{\Illuminate\Support\Facades\URL::to('email/verify/'.$token)  }}