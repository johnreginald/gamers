@extends('Administrator.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Order Management
        </h3>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Delivery Status</th>
        </tr>
    </thead>

    <tbody>
		@foreach($order as $o)
        <tr>
            <td>{{ $o->account->username }}</td>
            <td>{{ $o->shop->name }}</td>
            <td>{{ $o->quantity }}</td>
            <td>$50,000</td>
            <td>
                @if($o->completed > 0)
                    <span class="text-success">Delivered</span>
                @else
                    <span class="text-info">Wating</span>
                @endif
            </td>
       </tr>
		@endforeach
    </tbody>
</table>

@stop