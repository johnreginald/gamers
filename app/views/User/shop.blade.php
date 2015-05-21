@extends('User.layout')

@section('content')
<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="active">Shop</li>
    </ol>
    <div class="well">
        {{ Form::open(array('url' => 'search', 'method' => 'POST', 'class' => 'form form-inline')) }}
        <div class="form-group">
            <input class="form-control" type="text" name="item-name" placeholder="Search Your Item">
        </div>

        <div class="form-group">
            <select class="form-control">
                <option>Game Item</option>
                <option>Game Key</option>
                <option>RIG</option>
                <option>Dota 2</option>
            </select>
        </div>

        <button class="btn btn-primary">Filter</button>
        {{ Form::close() }}
    </div>

    {{ $products->links() }}

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
                    <a href="{{ URL::to('item/') }}/{{ $product->id }}">{{ $product->name }}</a>
                    <p>
                        {{ Product::readmore($product->id) }}
                    </p>
                    <p>Price: {{ $product->price }}</p>
                    <p>
                        {{ Form::open(array('url' => 'shop-add/', 'method' => 'POST', 'class' => 'form')) }}
                        <input type="hidden" name="id" value="{{ $product->id * 51235 }}">
                        <input type="submit" value="Add to Cart" class="btn btn-primary">
                        {{ Form::close() }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>	
@stop