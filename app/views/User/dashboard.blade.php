@extends('User.layout')

@section('content')
<div class="container wrapper">
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
                        <div class="tab-pane" id="whatsnew">Check out What is New on Our Shop</div>

                        <div class="tab-pane active" id="profile">
                            <h3>Account Profile</h3>
                            <hr>
                            <dl class="dl-horizontal">
                                <dt>Username : </dt>
                                <dd>{{ ucfirst(Auth::user()->username) }}</dd>
                            </dl>

                            <dl class="dl-horizontal">
                                <dt>Email Address : </dt>
                                <dd>{{ Auth::user()->email }}</dd>
                            </dl>  

                            <dl class="dl-horizontal">
                                <dt>Gamer Credit : </dt>
                                <dd>$500</dd>
                            </dl> 
                            <dl class="dl-horizontal">
                                <dt>Last Sign In : </dt>
                                <dd>Today</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Account Status : </dt>
                                <dd>Active</dd>
                            </dl>
                            </dl>
                        </div>

                        <div class="tab-pane" id="settings">
                            <h3>Change Password</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-1">
                                    {{ Form::open(array('url' => 'password', 'method' => 'POST', 'class' => 'form')) }}

                                    @if ($errors->has('oldpassword'))
                                    <div class="form-group"><input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required><span class="text-danger">{{ $errors->first('oldpassword') }}</span></div>
                                    @else
                                    <div class="form-group"><input type="password" name="oldpassword" class="form-control" placeholder="Old Password" required></div>
                                    @endif

                                    @if ($errors->has('newpassword'))
                                    <div class="form-group"><input type="password" name="newpassword" class="form-control" placeholder="New Password" required><span class="text-danger">{{ $errors->first('newpassword') }}</span></div>
                                    @else
                                    <div class="form-group"><input type="password" name="newpassword" class="form-control" placeholder="New Password" required></div>
                                    @endif    

                                    @if ($errors->has('newpassword_confirmation'))
                                    <div class="form-group"><input type="password" name="newpassword_confirmation" class="form-control" placeholder="Verify New Password" required><span class="text-danger">{{ $errors->first('newpassword_confirmation') }}</span></div>
                                    @else
                                    <div class="form-group"><input type="password" name="newpassword_confirmation" class="form-control" placeholder="Verify New Password" required></div>
                                    @endif 

                                    <input type="submit" class="col-md-12 btn btn-primary" value="Change Password">

                                    {{ Form::close() }}
                                </div>
                            </div>
                            <br>
                            <h3>Change Email</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-1">
                                    {{ Form::open(array('url' => 'email', 'method' => 'POST', 'class' => 'form')) }}

                                    @if ($errors->has('newemail'))
                                    <div class="form-group"><input type="email" name="newemail" class="form-control" placeholder="New Email Address" value="{{ Input::old('newemail') }}" required autofocus><span class="text-danger">{{ $errors->first('newemail') }}</span></div>
                                    @else
                                    <div class="form-group"><input type="email" name="newemail" class="form-control" placeholder="New Email Address" value="{{ Input::old('newemail') }}" required autofocus></div>
                                    @endif

                                    <input type="submit" class="col-md-12 btn btn-primary" value="Change Email Address">

                                    {{ Form::close() }} 
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="tab-pane" id="prepaid">
                            <h3>Prepaid Card</h3>
                            <hr>
                            <div class="col-md-6 col-md-offset-1">
                                {{ Form::open(array('url' => 'prepaid', 'method' => 'POST', 'class' => 'form')) }}

                                @if ($errors->has('serial'))
                                <div class="form-group"><input type="text" name="serial" class="form-control" placeholder="Serial Number" value="{{ Input::old('serial') }}" required autofocus><span class="text-danger">{{ $errors->first('serial') }}</span></div>
                                @else
                                <div class="form-group"><input type="text" name="serial" class="form-control" placeholder="Serial Number" value="{{ Input::old('serial') }}" required autofocus></div>
                                @endif

                                @if ($errors->has('code'))
                                <div class="form-group"><input type="text" name="code" class="form-control" placeholder="Prepaid Code" required><span class="text-danger">{{ $errors->first('code') }}</span></div>
                                @else
                                <div class="form-group"><input type="text" name="code" class="form-control" placeholder="Prepaid Code" required></div>
                                @endif                

                                <input type="submit" class="col-md-12 btn btn-primary" value="Submit">

                                {{ Form::close() }}  
                            </div>
                        </div>
                        <div class="tab-pane" id="order">order</div>
                        <div class="tab-pane" id="history">history</div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function () {
                $('#myTab a:last').tab('show')
            })
        </script>
    </div>
</div>	
@stop