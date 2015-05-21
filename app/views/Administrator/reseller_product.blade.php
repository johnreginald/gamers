@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Reseller Product waiting for Approval</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">

        </div>
        
        <div class="box-body">
            @forelse($products->chunk(4) as $p)
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
                            <div class="pull-left">
                            {{ Form::open(array('url' => 'administrator/reseller/product/accept/' . $product->id, 'method' => 'POST', 'class' => 'form')) }}
                                <input type="submit" class="btn btn-success btn-sm" value="Approve">
                            {{ Form::close() }}
                            </div>
                            <div class="pull-right">
                            {{ Form::open(array('url' => 'administrator/reseller/product/cancel/' . $product->id, 'method' => 'POST', 'class' => 'form')) }}
                                <input type="submit" class="btn btn-danger btn-sm" value="Cancel">
                            {{ Form::close() }}  
                            </div><br><br>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @empty
                <p>Nothing Yet</p>
            @endforelse
        </div>        
    </div>    
</section>
@stop