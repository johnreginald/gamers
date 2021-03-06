<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ Config::get('settings.title') }}</title>
        @include('User.css')
    </head>
    <body>

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ URL::to('/') }}"><img src="{{ URL::to('assets/img/logo.png') }}" id="logo"></a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ URL::to('/')}}">Home</a></li>
                        <li><a href="{{ URL::to('shop') }}">Shop</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(Sentry::check())
                            @if(Sentry::getUser()->inGroup(Sentry::findGroupByName('Reseller')))
                            <li><a href="{{ URL::to('reseller') }}">Reseller Panel</a></li>
                            @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ URL::to('dashboard') }}#profile">Your Balance : ${{ Sentry::getUser()->credit }}</a></li>
                        @else
                        <li><a href="{{ URL::to('register')}}">Register</a></li>
                        <li><a href="{{ URL::to('login')}}">Sign In</a></li>
                        @endif                    
                        <li><a href="{{ URL::to('shopping-cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span> {{ Cart::count(); }} items - ${{ Cart::total(); }}</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="wrapper">
            @yield('content')
        </div>

        <footer>
            <div class="col-md-4">
                <p>{{ Config::get('settings.left-footer') }}</p>
            </div>

            <div class="col-md-4">
                <p>Copyright &copy; For Gamers By Gamers 2015 - 2016</p>
            </div>

            <div class="col-md-4" id="social">
                <a href="http://facebook.com/{{ Config::get('settings.facebook') }}"><span class="fa fa-facebook"></span></a>
                <a href="http://twitter.com/{{ Config::get('settings.twitter') }}"><span class="fa fa-twitter"></span></a>
            </div>
        </footer>
    </body>
</html>