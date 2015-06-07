@extends('User.layout')

@section('content')
<div class="container">
    <div class="row wrapper">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li class="active">{{ $post->title }}</li>
        </ol>        
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>{{ $post->title }}</h4>
                <small>Posted on {{ Carbon::parse($post->created_at)->toFormattedDateString() }} by {{ ucfirst(strtolower($post->author)) }}</small> | Categories : 
                @forelse ($post->categories as $category)
                    <a href="{{ URL::to('/')}}/categories/{{ $category->slug }}">{{ $category->name }}</a>
                @empty
                    None
                @endforelse
                <br><br>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
</div>
@stop