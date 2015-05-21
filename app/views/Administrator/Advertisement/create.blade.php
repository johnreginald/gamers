@extends('Administrator.layout')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Create New Advertisement</h3>
        </div>

        <div class="box-body">
            <!-- New Advertisement Form - Hidden on Window Load -->
            <div class="row" id="newform">
                {{ Form::open(array('url' => 'administrator/advertisement/create', 'method' => 'POST', 'class' => 'form')) }}
                <div class="col-md-9">
                    <div class="form-group">
                        @include('File.basic-form')
                        <input type="hidden" name="url" id="url"><br>
                        <button class="btn btn-primary btn-xs" id="remove">Remove Image</button><br><br>
                        <small class="text-danger">*** Image Size of Advertisement must have at least 1000x400 pixel. ***</small>
                    </div>

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Advertisement Name">
                    </div>

                    <div class="form-group">
                        <label>Select Advertisement Order</label>
                        <input type="text" name="order" class="form-control" placeholder="You can use 1 to 10 or Over 10">
                    </div>

                    <div class="form-group">
                        <textarea name="description" rows="10" class="form-control" placeholder="Description..."></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-success" />Add Advertisement</button>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div> <!-- Box Body end -->
    </div> <!-- Box End -->
</section>

@include('File.slider-script')
@stop