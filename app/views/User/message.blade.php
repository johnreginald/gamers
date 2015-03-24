@extends('User.layout')

@section('content')
<div class="container wrapper">
    <div class="row">
        <div class="col-md-7 login-form">
            <div class="col-md-12">
                <div class="alert alert-{{ $status }}">{{ $message }}</div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>
</div>	
@stop