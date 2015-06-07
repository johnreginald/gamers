<div class="tab-pane" id="product">
    <h5>Your Products</h5>
    <hr>    
    <a href="{{ URL::to('reseller/product') }}" class="btn btn-primary">Create New Product</a>
    <br><br>
    <h5>Approved Products</h5>
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
                <input class="btn btn-danger btn-sm" name="delete" type="submit" value="Remove">
                {{ Form::close() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach    
</div>