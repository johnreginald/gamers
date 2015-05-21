@extends('User.layout')

@section('content')

<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="active">Reseller Panel</li>
    </ol>
    
    @include('User.message')
    
    <div class="row">

        <div class="col-md-3" role="navigation" id="myTab">
            <div class="list-group">
                <a href="#account" class="list-group-item" data-toggle="tab">Account Static</a>
                <a href="#product" class="list-group-item" data-toggle="tab">Product</a>
                <a href="#order" class="list-group-item" data-toggle="tab">Customer Order</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tab-content">
                        @include('User.reseller.account')

                        @include('User.reseller.product')

                        @include('User.reseller.order')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@stop