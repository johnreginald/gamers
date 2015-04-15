<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = array(
			'published' => Post::onlyPublish(),
			'trashed' => Post::onlyTrashed()->get(),
			'drafted' => Post::onlyDraft(),
			'all' => Post::All(),
			);
		return View::make('Administrator.Post.index', $posts);
	}

	/**
	 * Show the form for creating a new content
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Administrator.Post.create');
	}

	/**
	 * Store a newly created content in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
			'title' => Input::get('title'),
			'author' => Auth::user()->username,
			'content' => Input::get('content'),
			'status' => Input::get('status') 
		);
		$validator = Validator::make($data, Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$content = Post::create($data);

		return Redirect::action('PostsController@edit', ['content' => $content->id])->with('content', Post::find($content->id));
	}

	public function view($id)
	{
		$content = Post::findOrFail($id);

		return View::make('Administrator.Post.show', compact('content'));
	}

	/**
	 * Show the form for editing the specified content.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$content = Post::find($id);

		// if ($content->status == 'trash') {
		// 	return Redirect::action('PostsController@index')->with('message', Lang::get('message.trash-edit'));
		// } else {
			return View::make('Administrator.Post.edit', compact('content'));
		// }
	}

	/**
	 * Update the specified content in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$content = Post::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post = Post::find($id);
		$content->update($data);

		if(Request::ajax()) {
			return Response::json('success', 200);
		} else {
			return Redirect::action('PostsController@edit', ['content' => $id])->withContent($post)->withMessage(Lang::get('message.post-update'))->withStatus('info');
		}
	}

	/**
	 * Remove the specified content from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);

		return Redirect::action('PostsController@index')->withMessage(Lang::get('message.post-trash'))->withStatus('info');;
	}

	public function search() 
	{
		$posts = array(
			'published' => Post::onlyPublish(),
			'trashed' => Post::onlyTrashed()->get(),
			'drafted' => Post::onlyDraft(),
			'all' => Post::search(Input::get('search')),
			);
		return View::make('Administrator.Post.index', $posts);
	}

	public function trash($id, $salt)
	{
		if ($salt != md5($id)) {
			return Redirect::action('PostsController@index');
		} else {
			DB::table('posts')->where('id', '=', $id)->update(array('status' => 'trash'));
			return Redirect::action('PostsController@index')->with('message', Lang::get('message.post-trash'))->with('status', 'info');
		}
	}

	public function emptytrash() 
	{
		DB::table('posts')->where('status', '=', 'trash')->delete();
		return Redirect::action('PostsController@index');
	}
}
