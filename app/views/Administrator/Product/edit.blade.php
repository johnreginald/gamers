@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Edit Product</h1>
</section>

<section class="content">
    <div class="row">
        {{ Form::open(array('url' => 'administrator/product/' . $product->id, 'method' => 'POST', 'class' => 'form')) }}
        {{ Form::hidden('_method', 'PUT') }}

        <div class="col-md-9">
            <div class="form-group">
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required autofocus>
            </div>

            <div class="form-group">
                <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <textarea name="description" id="ide">{{ $product->description }}</textarea>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Options</div>

                <div class="panel-body">
                    <button type="submit" name="submit" class="btn btn-success pull-left" />Update Product</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>    
</section>
@include('Administrator.script')
@stop