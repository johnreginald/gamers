@extends('User.layout')

@section('content')
<div class="container wrapper">
    <div class="row">
        @include('User.message')
        
        <div class="col-md-7 login-form">
            <div class="col-md-7 col-md-offset-1">
                <h3>Forgot Password</h3>
                <hr>
                {{ Form::open(array('url' => 'reset', 'method' => 'POST', 'class' => 'form')) }}

                @if ($errors->has('email'))
                <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Recovery Email Address" value="{{ Input::old('email') }}" required autofocus><span class="text-danger">{{ $errors->first('email') }}</span></div>
                @else
                <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Recovery Email Address" value="{{ Input::old('email') }}" required autofocus></div>
                @endif         

                <input type="submit" class="col-md-12 btn btn-primary" value="Reset Account">

                {{ Form::close() }}
                <br>
                <div class="wrapper">
                    <div class="pull-left"><a href="{{ URL::to('register') }}">Register an Account</a></div>
                    <div class="pull-right"><a href="{{ URL::to('login') }}">Already a Member?</a> </div>
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