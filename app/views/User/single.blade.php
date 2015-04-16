@extends('User.layout')

@section('content')
<div class="container wrapper">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">{{ $post->title }}</li>
        </ol>        
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>{{ $post->title }}</h4>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
</div>	
@stop