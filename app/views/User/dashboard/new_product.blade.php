<div class="tab-pane active" id="whatsnew">
    <h5>Check out What is New on Our Shop</h5>
    <hr>
    <div class="row">                             
        @forelse($new_products as $product)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="assets/img/1.jpg">
                <div class="caption">
                    <h5><a href="{{ URL::to('item/') }}/{{ $product->id }}">{{ $product->name }}</a></h5>
                    <p>
                        {{ Product::readmore($product->id) }}
                    </p>
                    <p>
                        {{ Form::open(array('url' => 'shop-add/', 'method' => 'POST', 'class' => 'form')) }}
                        <input type="hidden" name="id" value="{{ $product->id * 51235 }}">
                        <input type="submit" value="Add to Cart" class="btn btn-primary">
                        {{ Form::close() }}
                    </p>
                </div>
            </div>
        </div>
        @empty 
        <div class="col-md-12">
            <p>Nothing Here Yet!</p>
        </div>       
        @endforelse            
    </div>
</div>