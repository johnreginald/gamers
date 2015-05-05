@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Edit User Detail</h1>
</section>

<section class="content">
	@include('Administrator.message')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				{{ Form::open(array('url' => 'administrator/user/' . $user->id, 'method' => 'POST', 'class' => 'form')) }}
				{{ Form::hidden('_method', 'PUT') }}
				<div class="box-body">
					<div class="form-group">
						<label>Username</label>
						<small>Usernames cannot be changed.</small>
						<input class="form-control" name="username" type="text" placeholder="{{ $user->username }}" disabled>
					</div>

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
					<input type="submit" class="btn btn-primary" value="Update User Detail">
				</div>
				{{ Form::close() }}
			</div>
		</div>	
	</div>
</section>
@stop