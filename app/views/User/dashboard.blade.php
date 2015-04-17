@extends('User.layout')

@section('content')

<div class="container wrapper">

    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}">Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
    
    @include('User.message')
    
    <div class="row">

        <div class="col-md-3" role="navigation" id="myTab">
            <div class="list-group">
                <a href="#whatsnew" class="list-group-item" data-toggle="tab">What's New on Shop</a>
                <a href="#profile" class="list-group-item" data-toggle="tab">User Profile</a>
                <a href="#settings" class="list-group-item" data-toggle="tab">Account Settings</a>
                <a href="#prepaid" class="list-group-item" data-toggle="tab">Prepaid</a>
                <a href="#order" class="list-group-item" data-toggle="tab">Your Order</a>
                <a href="#history" class="list-group-item" data-toggle="tab">Account History</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tab-content">
                        @include('User.dashboard.new_product')

                        @include('User.dashboard.profile')

                        @include('User.dashboard.settings')

                        @include('User.dashboard.prepaid')
                        
                        @include('User.dashboard.order')
                        
                        @include('User.dashboard.history')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
@stop