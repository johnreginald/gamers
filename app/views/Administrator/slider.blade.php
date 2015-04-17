@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Image Slider Code Management
        </h3>
    </div>
    <div class="container-fluid">
        <div class="pull-left">
            <button class="btn btn-primary btn-sm" id="add">New Slider</button>
        </div>		    	
    </div>
</div><hr>
<!-- New Slider Form - Hidden on Window Load -->
<div class="row" id="newform">
    {{ Form::open(array('url' => 'administrator/slider', 'method' => 'POST', 'class' => 'form')) }}
    <div class="col-md-9">
        <div class="form-group">
            @include('File.basic-form')
            <input type="hidden" name="url" id="url"><br>
            <button class="btn btn-primary btn-xs" id="remove">Remove Image</button><br><br>
            <small class="text-danger">*** Image Size of Slider must have at least 1000x400 pixel. ***</small>
        </div>

        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Slider Name" required>
        </div>

        <div class="form-group">
            <label>Select Slider Order</label>
            <input type="text" name="order" class="form-control" placeholder="You can use 1 to 10 or Over 10">
        </div>

        <div class="form-group">
            <textarea name="description" rows="10" class="form-control" placeholder="Description..."></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success" />Add Slider</button>
        </div>

    </div>
    {{ Form::close() }}
</div>

<!-- Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>  
            <th>Name</th>
            <th>Description</th>
            <th>Order</th>
        </tr>
    </thead>

    <tbody>
        @foreach($slider as $s)
        <tr>    
            <td class="col-md-1"><img src="{{ URL::to('/uploads/') }}/250x75_{{ $s->url }}"></td>
            <td>{{ $s->title }}</td>
            <td>{{ $s->description }}</td>
            <td>{{ $s->order }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        $('#newform').hide();

        $('#add').click(function () {
            $('#newform').toggle();
        });
    });
</script>
@include('File.slider-script')    
@stop