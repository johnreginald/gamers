@extends('User.layout')

@section('content')
<div class="container wrapper">
    <div class="row">
        <div class="col-md-7 login-form">
            <div class="col-md-12">
                <h1>{{ $content->title }}</h1>
                <p>{{ $content->content }}</p>
            </div>
        </div>
    </div>
</div>
@stop