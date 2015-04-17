@extends('User.layout')

@section('content')

<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="active">Shopping Cart</li>
    </ol>

    @include('User.message')

    <div class="row">
        <div class="col-md-12">
            @if( Cart::count() > 0 )
            <h4>Shopping Cart</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Item Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($cart as $c)
                    <tr>
                        <td>
                            <p><strong>{{ $c->name }}</strong></p>
                        </td>
                        <td><input type="text" value="{{ $c->qty }}"></td>
                        <td>${{ $c->price }}</td>
                        <td>${{ $c->subtotal }}</td>
                    </tr>

                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><strong>Grand Total</strong></td>
                        <td><strong>${{ Cart::total() }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="col-md-12">
            {{ Form::open(array('url' => 'checkout', 'method' => 'POST', 'class' => 'form  pull-right')) }}
            <input type="submit" value="Checkout" class="btn btn-primary">
            {{ Form::close() }}

            {{ Form::open(array('url' => 'clear-cart', 'method' => 'POST', 'class' => 'form')) }}
            <input type="submit" value="Clear Cart" class="btn btn-danger">
            {{ Form::close() }}
        </div>
        @else
        <div class="well">
            <p>Your Shopping Cart is Empty. Why Don't you take a look at Our <a href="{{ URL::to('shop') }}">Shop</a>.</p>
        </div>
        @endif        
    </div>
</div>
@stop