@extends('Administrator.layout')

@section('content')
<section class="content-header">
    <h1>Order Management</h1>
</section>

<section class="content">
    <div class="box">
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
                @forelse($order as $o)
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
                        <div class="pull-left">
                        {{ Form::open(array('url' => 'administrator/order/accept/' . $o->id, 'method' => 'POST', 'class' => 'form')) }}
                            <input type="submit" class="btn btn-success btn-xs" value="Accept">
                        {{ Form::close() }}
                        </div>
                        <div class="pull-right">
                        {{ Form::open(array('url' => 'administrator/order/cancel/' . $o->id, 'method' => 'POST', 'class' => 'form')) }}
                            <input type="submit" class="btn btn-danger btn-xs" value="Cancel">
                        {{ Form::close() }}  
                        </div>   
                    </td>
                </tr>
                @empty
                <tr>
                    <td>No Order Yet</td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>   
    </div> 
</section>
@stop