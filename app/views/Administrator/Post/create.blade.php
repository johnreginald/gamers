@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>New Post</h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    {{ Form::open(array('url' => 'administrator/post', 'method' => 'POST', 'class' => 'form')) }}
    <div class="col-md-9">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Enter Title Here..." required autofocus>
        </div>

        <div class="form-group">
            <textarea id="ide" name="content"></textarea>
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
</section>

@include('Administrator.script')
@stop