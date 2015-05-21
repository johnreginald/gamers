<div class="panel-body posts">
    @foreach ($posts as $post)
    <h4><a href="{{ URL::to('post/') }}/{{ $post->id }}">{{ $post->title }}</a></h4>
    <small>Posted on {{ Carbon::parse($post->created_at)->toFormattedDateString() }} by {{ ucfirst(strtolower($post->author)) }}</small> | Categories : 
	@forelse ($post->categories as $category)
		<a href="{{ URL::to('/')}}/categories/{{ $category->slug }}">{{ $category->name }}</a>
	@empty
		None
	@endforelse
    <p>{{ Post::readmore($post->id) }}</p>
    <hr>
    @endforeach
    {{ $posts->links() }}
</div>