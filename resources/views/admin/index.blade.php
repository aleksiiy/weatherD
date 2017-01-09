<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <title>Holidays</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ url('/master/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/jquery.navobile.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <link href="{{ url('/master/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/bootstrap-table.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/check.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/chosen.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/jquery.jgrowl.min.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/jquery.navobile.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/holiday.css') }}" rel="stylesheet">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/switchery.min.css') }}" rel="stylesheet">
    @yield('styles')

</head>

<body>
<div class="wrapper" id="content">
    <header class="header">
        <nav class="header-nav">
            <ul class="f-left">
                <li class="f-left">
                    <a href="#" id="show-sidebar" class="animated slideInLeftSmall"><i class="fa fa-bars fa-2x"></i></a>
                </li>
            </ul>
            <ul class="mainnav f-right">
                <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>
                </li>

            </ul>
        </nav>
    </header><!-- .header-->

    <nav class="left-sidebar">
        <div><p class="logo_pointer">Праздники</p></div>
        <ul>
            <li class={{ Request::segment(2) == '' ? "active" : "" }}>
                <a href="/home"><i class="fa fa-info fa-2x"></i><span>Общая информация</span></a></li>
            <li class={{ Request::segment(2) == 'category' ? "active" : "" }}>
                <a href="/admin/category"><i class="fa fa-list-ol fa-2x"></i><span>Категории празника</span></a></li>
            <li class={{ Request::segment(2) == 'show' ? "active" : "" }}>
                <a href="/admin/show"><i class="fa fa-book fa-2x" aria-hidden="true"></i><span>Праздники</span></a></li>
</ul>
        <!-- <a href="" class="copyright">Created by Drews</a> -->
    </nav>

    @yield('content')
</div><!-- .wrapper -->
<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ url('/master/js/bootstrap.min.js') }}"></script>
<!--<script src="js/modernizer.min.js"></script>-->
<script src="{{ url('/master/js/jquery.navobile.min.js') }}"></script>
<script src="{{ url('/master/js/app.js') }}"></script>

@yield('scripts')
</body>
</html>