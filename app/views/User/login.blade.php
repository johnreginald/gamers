@extends('User.layout')

@section('content')
<div class="container wrapper">
    <div class="row">
        <div class="col-md-7 login-form">
            <div class="col-md-7 col-md-offset-1">
                <h3>Login Form</h3>
                <hr>
                {{ Form::open(array('url' => 'login', 'method' => 'POST', 'class' => 'form')) }}

                @if ($errors->has('username'))
                <div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus><span class="text-danger">{{ $errors->first('username') }}</span></div>
                @else
                <div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus></div>
                @endif

                @if ($errors->has('password'))
                <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required><span class="text-danger">{{ $errors->first('password') }}</span></div>
                @else
                <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                @endif                

                <input type="submit" class="col-md-12 btn btn-primary" value="Login">

                {{ Form::close() }}
                <br>
                <div class="wrapper">
                    <div class="pull-left"><a href="{{ URL::to('register') }}">Register an Account</a></div>
                    <div class="pull-right"><a href="{{ URL::to('reset') }}">Forgot Password?</a> </div>
                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>

                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>
</div>	
@stop