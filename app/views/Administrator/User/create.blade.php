@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>New User</h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header"><h4>Add a new user to your website</h4></div>
				{{ Form::open(array('url' => 'administrator/user', 'method' => 'POST', 'class' => 'form')) }}
				<div class="box-body">
					@if ($errors->has('username'))
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus>
						<span class="text-danger">{{ $errors->first('username') }}</span>
					</div>
					@else
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" value="{{ Input::old('username') }}" required autofocus>
					</div>
					@endif

					@if ($errors->has('email'))
					<div class="form-group">
						<label>Email Address</label>
						<input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ Input::old('email') }}" required>
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
					@else
					<div class="form-group">
						<label>Email Address</label>
						<input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ Input::old('email') }}" required>
					</div>
					@endif

					@if ($errors->has('password'))
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
						<span class="text-danger">{{ $errors->first('password') }}</span>
					</div>
					@else
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					@endif                

					@if ($errors->has('password_confirmation'))
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password" required>
						<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
					</div>
					@else
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password" required>
					</div>
					@endif
				</div>

				<div class="box-footer">
					<input type="submit" class="btn btn-primary" value="Add New User">
				</div>
				{{ Form::close() }}
			</div>
		</div>	
	</div>
</section>
@stop