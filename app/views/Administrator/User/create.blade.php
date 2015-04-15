@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            New User
        </h3>
    </div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-1">
		<h4>Add a new user to your website</h4>
		<br>
		{{ Form::open(array('url' => 'administrator/user', 'method' => 'POST', 'class' => 'form')) }}

		@if ($errors->has('username'))
		<div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus><span class="text-danger">{{ $errors->first('username') }}</span></div>
		@else
		<div class="form-group"><input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus></div>
		@endif

		@if ($errors->has('email'))
		<div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ Input::old('email') }}" required><span class="text-danger">{{ $errors->first('email') }}</span></div>
		@else
		<div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ Input::old('email') }}" required></div>
		@endif

		@if ($errors->has('password'))
		<div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required><span class="text-danger">{{ $errors->first('password') }}</span></div>
		@else
		<div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
		@endif                

		@if ($errors->has('password_confirmation'))
		<div class="form-group"><input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password" required><span class="text-danger">{{ $errors->first('password_confirmation') }}</span></div>
		@else
		<div class="form-group"><input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password" required></div>
		@endif

		<input type="submit" class="col-md-5 btn btn-primary" value="Add New User">

		{{ Form::close() }}
	</div>
</div>
@stop