@extends('User.layout')

@section('content')
<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li><a href="{{ URL::to('shop') }}">Shop</a></li>
        <li class="active">{{ ucfirst($product->name) }}</li>
    </ol>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-thumbnail" src="{{ URL::to('uploads/products') }}/{{ $product->image }}">
                    <hr>
                    {{ Form::open(array('url' => 'shop-add/', 'method' => 'POST', 'class' => 'form')) }}
                    <input type="hidden" name="id" value="{{ $product->id * 51235 }}">
                    <input type="submit" value="Add to Cart" class="btn btn-primary">
                    {{ Form::close() }}
                </div>
                <div class="col-md-8">
                    <h5>{{ $product->name }}</h5>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Price</dt>
                        <dd>${{ $product->price }}</dd>

                        <dt>Item Type</dt>
                        <dd>Online</dd>

                        <dt>Item Color</dt>
                        <dd>Red</dd>                        
                    </dl>           
                    <hr>
                    <h4><span class="label label-info">Description</span></h4>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>	
@stop