@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>User Management</h1>
</section>

<section class="content">
<div class="box">
	<div class="box-header">
		<a href="{{ URL::to('administrator/user/create') }}" class="btn btn-primary btn-sm">New User</a>
		<div class="box-tools">
			<div class="pull-left">
				{{ Form::open(array('url' => 'administrator/user/search', 'method' => 'POST', 'class' => 'form')) }}
				<input class="form-control input-sm" name="search" placeholder="Search Users" >
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th>Account Type</th>
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
					<td>
						@if(Sentry::getUser()->inGroup(Sentry::findGroupByName('Reseller')))
							Reseller
						@elseif(Sentry::getUser()->inGroup(Sentry::findGroupByName('Administrator')))
							Administrator
						@else
							Member
						@endif
					</td>
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
					<td></td>
				</tr>
				@endforelse
			</tbody>
		</table>			
	</div>
</div>  
</section>
@stop