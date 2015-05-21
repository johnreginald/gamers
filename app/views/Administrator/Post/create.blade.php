@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>New Post</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
                {{ Form::open(array('url' => 'administrator/post', 'method' => 'POST', 'class' => 'form')) }}
                <div class="col-md-9">
                    @if ($errors->has('title'))
                    <div class="form-group"><input type="text" name="title" class="form-control" placeholder="Enter Title Here..." value="{{ Input::old('title') }}" required><span class="text-danger">{{ $errors->first('title') }}</span></div>
                    @else
                    <div class="form-group"><input type="text" name="title" class="form-control" placeholder="Enter Title Here..." value="{{ Input::old('title') }}" required></div>
                    @endif

                    <div class="form-group">
                        <textarea id="ide" name="content"></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">Post Options</div>

                        <div class="panel-body">
                            <button type="submit" name="status" class="btn btn-info btn-sm pull-left" value="0"/>Save as Draft</button>
                            <button type="submit" name="status" class="btn btn-success btn-sm pull-right" value="1"/>Publish Now</button>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">Categories</div>

                        <div class="panel-body">
                            @foreach($category as $c)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="category[]" value="{{ $c->id }}"> {{ $c->name }}                        
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>        
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>

@include('Administrator.script')
@stop