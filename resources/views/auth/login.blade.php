<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
    <!-- Styles -->
    <link href="{{ url('master/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('master/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('master/css/jquery.navobile.css') }}" rel="stylesheet">
    <link href="{{ url('master/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('master/css/check.css') }}" rel="stylesheet">
    <link href="{{ url('master/css/switchery.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('master/css/chosen.css') }}" rel="stylesheet"/>
    <link href="{{ url('master/css/jquery.jgrowl.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('master/css/style.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{ url('master/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('master/js/bootstrap-filestyle.min.js') }}"> </script>
    <script src="{{ url('master/js/jquery.navobile.min.js') }}"></script>
    <script src="{{ url('master/js/switchery.min.js') }}"></script>
    <script src="{{ url('master/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('master/js/jquery.jgrowl.min.js') }}"></script>
    <script src="{{ url('master/js/app.js') }}"></script>
</head>
<body>
<div class="page-container">
    <div class="content-container">
        <div class="login-container">
            <div class="content">
                <div class="panel panel-default login-form">
                    <div class="logo"><a href="">Cantex</a></div>
                    <div class="form-group">
                        <div class="alert danger">The username or password you entered is incorrect</div>
                    </div>
                    <div class="panel-body">
                        <form method="POST">
                            <div class="form-group"><input class="form-control" type="text" name="email" placeholder="E-mail"></div>
                            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                            <div class="form-group"><input class="btn btn-brand" type="submit" value="Sign in"></div>
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        </form>
                        <div class="text-center">
                            <a target="_blank" href="http://a2-lab.com">Need help?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    © 2016 <a href="">admin panel</a>
</footer>
</body>
</html>