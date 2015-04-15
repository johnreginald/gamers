@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            New Post
        </h3>
    </div>
</div>
<div class="row">
	{{ Form::open(array('url' => 'administrator/post', 'method' => 'POST', 'class' => 'form')) }}
	<div class="col-md-9">
		<div class="form-group">
			<input type="text" name="title" class="form-control" placeholder="Enter Title Here..." required autofocus>
		</div>

		<div class="form-group">
			<textarea id="ide" name="content" col="5"></textarea>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">Post Options</div>

			<div class="panel-body">
				<button type="submit" name="status" class="btn btn-info btn-sm pull-left" value="draft"/>Save as Draft</button>
        		<button type="submit" name="status" class="btn btn-success btn-sm pull-right" value="publish"/>Publish Now</button>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>

@include('Administrator.script')
@stop