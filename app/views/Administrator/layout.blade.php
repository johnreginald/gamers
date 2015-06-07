<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration Panel</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @include('Administrator.css')
</head>
<body class="skin-blue">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ URL::to('/')}}" class="logo">Gamers</a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#"><span class="hidden-xs">{{ ucfirst(strtolower(Sentry::getUser()->username)) }}</span></a></li>
                        <li><a href="{{ URL::to('/') }}" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> View website</a></li>
                        <li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>                                    
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @include('Administrator.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- <div class="pull-right hidden-xs"></div> -->
            <!-- Default to the left --> 
            <strong>Copyright &copy; 2015 <a href="{{ URL::to('/') }}">{{ Config::get('settings.title') }}</a>.</strong> All rights reserved.
        </footer>

    </div><!-- ./wrapper -->
</body>
</html>