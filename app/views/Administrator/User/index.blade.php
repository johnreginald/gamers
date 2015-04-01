@extends('Administrator.layout')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
			User Management
		</h3>
		<hr>
	</div>
	<div class="container-fluid">
		<div class="pull-right">
			{{ Form::open(array('url' => 'administrator/user/search', 'method' => 'POST', 'class' => 'form')) }}
			<input class="form-control input-sm" name="search" placeholder="Search Users" >
			{{ Form::close() }}
		</div>
		<div class="pull-left">
			<a href="{{ URL::to('administrator/user/create') }}" class="btn btn-primary btn-sm">New User</a>
		</div>    	
	</div>
</div>

<br>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
			<th class="col-md-2">Actions</th>
		</tr>
	</thead>

	<tbody>
		@forelse ($user as $u)
		<tr>
			<td>
				<a href="{{ URL::to('administrator/user/' . $u->id . '/edit') }}">{{ $u->username }}</a>
			</td>
			<td>{{ ucfirst($u->username) }}</td>
			<td>{{ $u->email }}</td>
			<td>Administrator</td> <!-- TODO -->
			<td class="col-md-3">
				<div class="pull-left">
					{{ Form::open(array('url' => 'administrator/user/' . $u->id, 'method' => 'DELETE', 'class' => 'form')) }}
						<a href="{{ URL::to('administrator/user/' . $u->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
						<button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-ban-circle"></span> Delete</button>	
					{{ Form::close() }}				
				</div>
			</td>
		</tr>
		@empty
		<tr>
			<td>There's no user account to show.</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endforelse
	</tbody>
</table>
@stop