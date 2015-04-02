@extends('User.layout')

@section('content')
<div class="container wrapper">

    <ol class="breadcrumb">
      <li><a href="{{ URL::to('/') }}">Home</a></li>
      <li class="active">Shopping Cart</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <h3>Shopping Cart</h3>
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
            </table>
        </div>

        <div class="col-md-12">
        {{ Form::open(array('url' => 'checkout', 'method' => 'POST', 'class' => 'form')) }}
            <input type="submit" value="Checkout" class="btn btn-primary">
        {{ Form::close() }}
        </div>
    </div>
</div>
@stop