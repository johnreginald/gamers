<div class="tab-pane" id="order">
    <h5>Your Order</h5>
    <hr>    
    @forelse($orders as $order)
    <div class="col-md-4">
        <div class="thumbnail">
            <img src="assets/img/1.jpg">
            <div class="caption">
                <h4>Product : {{ $order->product->name }}</h4>
                <p>Quantity : {{ $order->quantity }} Units</p>
                <p>Status : 
                    @if($order->completed > 0)
                    <span class="text-success">Completed</span>
                    @else
                    <span class="text-info">Waiting</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @empty
        You didn't buy anything from us yet! Take a look at Our <a href="{{ URL::to('shop') }}">Shop</a>
    @endforelse
</div>