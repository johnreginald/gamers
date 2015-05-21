@extends('User.layout')

@section('content')
<div class="container">
    <div class="row wrapper">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">{{ $categories->name }}</li>
        </ol>        
        <div class="panel panel-default">
            <div class="panel-body">
                @forelse($categories->posts as $post)
                <h4><a href="{{ URL::to('post/') }}/{{ $post->id }}">{{ $post->title }}</a></h4>
                <small>Posted on {{ Carbon::parse($post->created_at)->toFormattedDateString() }} by {{ ucfirst(strtolower($post->author)) }}</small> | Categories : {{ $categories->name }}
                <p>{{ Post::readmore($post->id) }}</p>
                <hr>
                @empty
                <p>No Posts in This Category</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@stop