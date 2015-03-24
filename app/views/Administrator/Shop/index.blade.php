@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Shop Management
        </h3>
    </div>
    <div class="container-fluid">
		<div class="pull-right">
			<input value="Search">
		</div>
		<div class="pull-left">
			<a href="{{ URL::to('administrator/shop/create') }}" class="btn btn-primary btn-sm">New Item</a>
		</div>    	
    </div>
</div>
<br>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Price</th>
			<th class="col-md-2">Actions</th>
		</tr>
	</thead>

	<tbody class="">
		@foreach ($shops as $s)
		<tr>
			<td><img class="media-object img-responsive" src="{{ asset('assets/img/logo.png') }}" alt="..."></td>
			<td><a href="{{ URL::to('administrator/shop/' . $s->id . '/edit') }}">{{ $s->name }}</a></td>
			<td>{{ $s->price }}</td>
			<td>
				<div class="pull-left">
				{{ Form::open(array('url' => 'administrator/shop/' . $s->id, 'method' => 'POST', 'class' => 'form')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					<input class="btn btn-danger btn-sm" name="delete" type="submit" value="Delete">
				{{ Form::close() }}
				</div>
				<div class="pull-right">
					<a href="{{ URL::to('administrator/shop/' . $s->id) }}" class="btn btn-primary btn-sm">View</a>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop