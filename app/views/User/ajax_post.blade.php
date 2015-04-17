<div class="panel-body posts">
    @foreach ($posts as $post)
    <h4><a href="{{ URL::to('post/') }}/{{ $post->id }}">{{ $post->title }}</a></h4>
    <p>{{ Post::readmore($post->id) }}</p>
    <hr>
    @endforeach
    {{ $posts->links() }}
</div>