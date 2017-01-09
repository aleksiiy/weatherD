<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
    <title>Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <![endif]-->
</head>
<body>
<div class="page-container">
    <div class="content-container">
        <div class="login-container">
            <div class="content">
                <div class="panel panel-default login-form">
                    <div class="logo">
                        <a href="{{ url('/login') }}">Holidays</a>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input class="form-control" required type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="form-control" required type="password" name="password" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group"><input class="btn btn-brand" type="submit" value="Sign in"></div>
                        </form>
                        <div class="text-center">
                            <a href={{ url('/password/reset') }}>Forgot your password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>