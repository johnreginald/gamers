@extends('Administrator.layout')

@section('content')

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

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
			Content Management
		</h3>
		<hr>
	</div>
	<div class="container-fluid">
		<div class="pull-right">
			{{ Form::open(array('url' => 'administrator/contents/search', 'method' => 'POST', 'class' => 'form')) }}
			<input class="form-control input-sm" name="search" placeholder="Search Posts" >
			{{ Form::close() }}
		</div>
		<div class="pull-left">
			<a href="{{ URL::to('administrator/contents/create') }}" class="btn btn-primary btn-sm">New Post</a>
		</div>    	
	</div>
</div>
<br>
<div>
	<a href="{{ URL::to('administrator/contents') }}">All</a>@if( Content::where('status', '!=', 'trash')->count() > 0 ) <span class="badge">{{ Content::where('status', '!=', 'trash')->count() }}</span> @endif |
	<a href="{{ URL::to('administrator/contents/sort/publish') }}">Published</a>@if( Content::where('status', '=', 'publish')->count() > 0 ) <span class="badge">{{ Content::where('status', '=', 'publish')->count() }}</span> @endif |
	<a href="{{ URL::to('administrator/contents/sort/draft') }}">Draft</a>@if( Content::where('status', '=', 'draft')->count() > 0 ) <span class="badge">{{ Content::where('status', '=', 'draft')->count() }}</span> @endif |
	<a href="{{ URL::to('administrator/contents/sort/trash/') }}">Trash</a>@if( Content::where('status', '=', 'trash')->count() > 0 ) <span class="badge">{{ Content::where('status', '=', 'trash')->count() }}</span> @endif
</div>
<br>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>Post</th>
			<th>Author</th>
			<th>Date</th>
			<th class="col-md-2">Actions</th>
		</tr>
	</thead>

	<tbody>
		@forelse ($contents as $c)
		<tr>
			<td>
				@if ($c->status == 'trash')
					{{ $c->title }}
				@else
					<a href="{{ URL::to('administrator/contents/' . $c->id . '/edit') }}">{{ $c->title }}</a>
				@endif
				@if ($c->status == 'draft') <small class="text-muted"> - {{ ucfirst($c->status) }}</small> @endif
			</td>
			<td>{{ $c->author }}</td>
			<td>{{ $c->created_at }}</td>
			<td class="col-md-3">
				<div class="pull-left">
					@if (Request::segment(4) == 'trash') 
					<a href="{{ URL::to('administrator/contents/restore/') }}/{{ $c->id }}/{{ md5($c->id) }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-refresh"></span> Restore</a>
					<a href="{{ URL::to('administrator/contents/delete/') }}/{{ $c->id }}/{{ md5($c->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-ban-circle"></span> Delete</a>
					@elseif (Request::segment(4) == 'draft')
					<a href="{{ URL::to('administrator/contents/' . $c->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
					<a href="{{ URL::to('post/' . $c->id) }}" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Preview</a> 
					<a href="{{ URL::to('administrator/contents/trash/') }}/{{ $c->id }}/{{ md5($c->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Trash</a>					
					@else
					<a href="{{ URL::to('administrator/contents/' . $c->id . '/edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
					<a href="{{ URL::to('post/' . $c->id) }}" target="_blank" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View</a> 
					<a href="{{ URL::to('administrator/contents/trash/') }}/{{ $c->id }}/{{ md5($c->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Trash</a>
					@endif
				</div>
			</td>
		</tr>
		@empty
		<tr>
			<td>There's no Posts to show.</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endforelse
	</tbody>
</table>
@stop