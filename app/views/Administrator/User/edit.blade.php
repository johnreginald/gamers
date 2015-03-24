@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Edit User Detail
        </h3>
        <hr>
    </div>
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-1">
		@if ( Session::get('message') )
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-{{ Session::get('status') }} alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('message') }}
				</div>
			</div>
		</div>
		@endif

		{{ Form::open(array('url' => 'administrator/user/' . $user->id, 'method' => 'POST', 'class' => 'form')) }}
		{{ Form::hidden('_method', 'PUT') }}
		
		<div class="form-group">
			<small>Usernames cannot be changed.</small><input class="form-control" name="username" type="text" placeholder="{{ $user->username }}" disabled>
		</div>

		@if ($errors->has('email'))
		<div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ Input::old('email') }}"><span class="text-danger">{{ $errors->first('email') }}</span></div>
		@else
		<div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ $user->email }}"></div>
		@endif

		@if ($errors->has('password'))
		<div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password"><span class="text-danger">{{ $errors->first('password') }}</span></div>
		@else
		<div class="form-group"><input type="password" name="password" class="form-control" placeholder="Password"></div>
		@endif                

		@if ($errors->has('password_confirmation'))
		<div class="form-group"><input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password"><span class="text-danger">{{ $errors->first('password_confirmation') }}</span></div>
		@else
		<div class="form-group"><input type="password" name="password_confirmation" class="form-control" placeholder="Verify Password"></div>
		@endif

		<input type="submit" class="col-md-5 btn btn-primary" value="Update User Detail">

		{{ Form::close() }}
	</div>
</div>
@stop