<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="{{asset('assets/img/favicon.144x144.png')}}" rel="apple-touch-icon" type="image/png" sizes="144x144')}}">
    <link href="{{asset('assets/img/favicon.114x114.png')}}" rel="apple-touch-icon" type="image/png" sizes="114x114')}}">
    <link href="{{asset('assets/img/favicon.72x72.png')}}" rel="apple-touch-icon" type="image/png" sizes="72x72')}}">
    <link href="{{asset('assets/img/favicon.57x57.png')}}" rel="apple-touch-icon" type="image/png">
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon" type="image/png')}}">
    <link href="{{asset('assets/img/favicon.ico')}}" rel="shortcut icon">
    <link rel="stylesheet" href="{{asset('assets/css/separate/pages/login.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lib/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form autocomplete="off" class="sign-box" method="POST" action="{{ route('login') }}">
                   @if($errors->any())
                      <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Maaf, Username / Password Salah
                    </div>
                  @endif
                   @if (session('status'))
                    <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('status') }}
                    </div>
                    @endif
                    @csrf
                    <div class="sign-avatar">
                    
                        <img src="{{asset('assets/img/avatar-sign.png')}}" alt="">
                    </div> 
                    <header class="sign-title">Sign In</header>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Usename" name="username" autocomplete="new-username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" autocomplete="new-password" id="pass" name="password" required>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" id="check-1" onclick="tampilsandi()">
                      <label for="check-1">Tampilkan Sandi</label>
                    </div>
                    <br>
                   <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-rounded" name="submit" >Masuk</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{url('/')}}" class="btn btn-warning btn-rounded">Website Saya</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script src="{{asset('assets/js/lib/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/js/lib/popper/popper.min.js')}}"></script>
<script src="{{asset('assets/js/lib/tether/tether.min.js')}}"></script>
<script src="{{asset('assets/js/lib/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/lib/match-height/jquery.matchHeight.min.js')}}"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
        $('#refresh').click(function(){
  $.ajax({
     type:'GET',
     url:'refreshcaptcha',
     success:function(data){
        $("#captcha span").html(data.captcha);
     }
  });
});
    </script>
    <script>
      
        function tampilsandi() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
    </script>
<script src="{{asset('assets/js/app.js')}}"></script>
</body>
</html>