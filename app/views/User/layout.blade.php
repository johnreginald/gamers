<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap 101 Template</title>
        @include('User.css')
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                 <div class="col-md-4 text-center"><a href="#"><img src="{{ asset('assets/img/logo.png') }}" style="height: 150px; margin-top: 20px;"></a></div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <div class="navi-bar">
            <ul>
                <li><a href="{{ URL::to('/')}}">Home</a></li>
                @if(Auth::check())
                <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ URL::to('logout') }}">Logout</a></li>
                @else
                <li><a href="{{ URL::to('register')}}">Register</a></li>
                <li><a href="{{ URL::to('login')}}">Sign In</a></li>
                @endif
                <li><a href="{{ URL::to('shop') }}">Shop</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="{{ URL::to('shopping-cart')}}"><span class="glyphicon glyphicon-shopping-cart"></span> {{ Cart::count(); }} items - ${{ Cart::total(); }}</a></li>
            </ul>
        </div>

        @yield('content')

        <footer>
            <div class="col-md-4">
                <p>qweruqowieurpqowiuerpqiowuerpqiwuep</p>
                <button id="check">Check This Out</button>
            </div>

            <div class="col-md-4">
                <p>Copyright &copy; For Gamers By Gamers 2015 - 2016</p>
            </div>

            <div class="col-md-4">
                <h4>Follow Us</h4>
                <span class="glyphicon glyphicon-bold"></span>
                <span class="glyphicon glyphicon-bold"></span>
                <span class="glyphicon glyphicon-bold"></span>
                <span class="glyphicon glyphicon-bold"></span>
            </div>
        </footer>
    </body>
</html>