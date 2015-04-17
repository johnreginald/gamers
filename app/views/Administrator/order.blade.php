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
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order as $o)
        <tr>
            <td>{{ $o->account->username }}</td>
            <td>{{ $o->product->name }}</td>
            <td>{{ $o->quantity }}</td>
            <td>{{ $o->total }}</td>
            <td>
                @if($o->status > 0)
                <span class="text-success">Delivered <small>[ 2012 ]</small></span>
                @else
                <span class="text-info">Wating</span>
                @endif
            </td>
            <td>
                <button class="btn btn-success btn-xs">Mark as Complete</button>
                <button class="btn btn-danger btn-xs">Cancel</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop