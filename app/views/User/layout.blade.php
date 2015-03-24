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
                <div class="col-md-6"><a href="#"><img src="{{ asset('assets/img/logo.png') }}"></a></div>
            </div>
        </div>

        <div class="navi-bar">
            <ul>
                <li><a href="{{ URL::to('/')}}">Home</a></li>
                <li><a href="{{ URL::to('register')}}">Game</a></li>
                <li><a href="{{ URL::to('dashboard') }}">Payment Method</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="{{ URL::to('login')}}">Sign In</a></li>
                <li><a href="{{ URL::to('register')}}">Register</a></li>
            </ul>
        </div>

        @yield('content')

        <footer>
            <div class="col-md-4">
                <p>qweruqowieurpqowiuerpqiowuerpqiwuep</p>
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