<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administration Panel</title>
    @include('Administrator.css')
</head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ Config::get('settings.title') }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::to('/') }}" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> View website</a></li>
                        <li><a href="{{ URL::to('logout') }}"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li @if (Request::segment(2) == '') class="active" @endif><a href="{{ URL::to('administrator') }}">Dashboard <span class="sr-only">(current)</span></a></li>
                        <li @if (Request::segment(2) == 'post') class="active" @endif><a href="{{ URL::action('PostsController@index') }}">Posts</a></li>
                        <li @if (Request::segment(2) == 'user') class="active" @endif><a href="{{ URL::action('UAController@index') }}">Users</a></li>
                        <li @if (Request::segment(2) == 'shop') class="active" @endif><a href="{{ URL::action('ShopsController@index') }}">Product</a></li>
                        <li @if (Request::segment(2) == 'prepaid') class="active" @endif><a href="{{ URL::action('AdministratorController@getPrepaid') }}">Prepaid Cards</a></li>
                        <li @if (Request::segment(2) == 'order') class="active" @endif><a href="{{ URL::action('AdministratorController@getOrder') }}">Customer Orders</a></li>
                        <li @if (Request::segment(2) == 'slider') class="active" @endif><a href="{{ URL::action('AdministratorController@getSlider') }}">Slider</a></li>
                        <li @if (Request::segment(2) == 'sponsor') class="active" @endif><a href="{{ URL::action('AdministratorController@getSponsor') }}">Sponsor</a></li>
                        <li @if (Request::segment(2) == 'settings') class="active" @endif><a href="{{ URL::action('AdministratorController@getSettings') }}">Website Settings</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
