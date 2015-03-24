@extends('Administrator.layout')

@section('content')
@if ($content->status == 'trash')
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-danger">
			{{ Lang::get('message.trash-edit') }}
		</div>
	</div>
</div>
@else
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
			Edit Post
		</h3>
	</div>
</div>

<div class="row">
	{{ Form::open(array('url' => 'administrator/contents/' . $content->id, 'method' => 'POST', 'class' => 'form')) }}
	{{ Form::hidden('_method', 'PUT') }}
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" name="title" class="form-control" placeholder="Enter Title Here..." value ="{{ $content->title }}" required autofocus>
		</div>

		<div class="form-group">
			<textarea id="ide" name="content">{{ $content->content }}</textarea>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">Post Options</div>

			<div class="panel-body">
				<p>Post Status : <a href="#" id="edit" style="text-transform: capitalize;">{{ ucfirst($content->status) }}</a></p>
				<div id="edit-show">
					<select id="status" class="form-control input-sm">
						<option value="draft">Draft</option>
						<option value="publish">Publish</option>
						<option value="trash">Trash</option>
					</select>
					<br>
					<a class="btn btn-primary btn-sm" id="edit-ok" data-loading-text="Updating...">OK</a>
					<a class="btn btn-primary btn-sm" id="edit-cancel">Cancel</a>
					<br>
					<br>
				</div>
				<span id="yolo"></span>
				<button type="submit" value="submit" class="btn btn-success btn-sm" id="update"/>Update</button>
				<div class="pull-right">
					<a href="{{ URL::to('post/' . $content->id) }}" target="_blank" class="btn btn-info btn-sm">View Post</a> 
				</div>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
@endif
<script type="text/javascript">
	var geturl = "{{ URL::to('administrator/contents/update-options/' . $content->id) }}";
</script>
@include('Administrator.script')
@stop