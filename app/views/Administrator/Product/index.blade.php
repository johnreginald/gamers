@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Product Management</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <a href="{{ URL::to('administrator/product/create') }}" class="btn btn-primary btn-sm">New Product</a>
            </div>
            <div class="box-tools">
                <div class="pull-right">
                    <input value="Search" class="form-control">
                </div>
            </div>
        </div>
        
        <div class="box-body">
            @foreach($products->chunk(4) as $p)
            <div class="row">
                @foreach($p as $product)
                <div class="col-md-3">
                    <div class="thumbnail">                            
                        @if($product->image == NULL)
                            <img data-src="holder.js/250x100/sky" alt="...">
                        @else
                            <img src="{{ URL::to('uploads/products') }}/{{ $product->image }}">        
                        @endif
                        <div class="caption">
                        <a href="{{ URL::to('administrator/product/' . $product->id . '/edit') }}">{{ $product->name }}</a>
                        <p>Price : {{ $product->price }}</p>
                        <hr>
                        {{ Form::open(array('url' => 'administrator/product/' . $product->id, 'method' => 'POST', 'class' => 'form')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <a href="{{ URL::to('administrator/product/' . $product->id . '/edit') }}" class="btn btn-info btn-sm">Edit</a>
                        <input class="btn btn-danger btn-sm" name="delete" type="submit" value="Delete">
                        {{ Form::close() }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>        
    </div>    
</section>
@stop