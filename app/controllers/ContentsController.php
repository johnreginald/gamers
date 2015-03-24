<?php

class ContentsController extends \BaseController {

	/**
	 * Display a listing of contents
	 *
	 * @return Response
	 */
	public function index()
	{
		$contents = Content::orderBy('id', 'DESC')->where('status', '!=', 'trash')->get();

		return View::make('Administrator.Content.index', compact('contents'));
	}

	/**
	 * Show the form for creating a new content
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Administrator.Content.create');
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
		$validator = Validator::make($data, Content::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$content = Content::create($data);

		return Redirect::action('ContentsController@edit', ['content' => $content->id])->with('content', Content::find($content->id));
	}

	public function view($id)
	{
		$content = Content::findOrFail($id);

		return View::make('Administrator.Content.show', compact('content'));
	}

	/**
	 * Show the form for editing the specified content.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$content = Content::find($id);

		if ($content->status == 'trash') {
			return Redirect::action('ContentsController@index')->with('message', Lang::get('message.trash-edit'));
		} else {
			return View::make('Administrator.Content.edit', compact('content'));
		}
	}

	/**
	 * Update the specified content in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$content = Content::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Content::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post = Content::find($id);
		$content->update($data);

		return Redirect::action('ContentsController@edit', ['content' => $id])->with('content', $post)->with('message', Lang::get('message.post-update'))->with('status', 'info');
	}

	/**
	 * Remove the specified content from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Content::destroy($id);

		return Redirect::action('ContentsController@index');
	}

	public function sort($name)
	{
		if ($name == 'trash' || $name == 'publish' || $name == 'draft') {
			$contents = DB::table('contents')->where('status', '=', $name)->orderby('updated_at', 'desc')->get();
			return View::make('Administrator.Content.index', compact('contents'));
		} else {
			return Redirect::action('ContentsController@index');
		}
	}

	public function search() {
		$contents = DB::table('contents')
				->where('status', '!=', 'trash')
				->where(function($query){
					$query->orWhere('title', 'LIKE', '%' . Input::get('search') . '%')
					->orWhere('content', 'LIKE', '%' . Input::get('search') . '%')
					->orWhere('author', 'LIKE', '%' . Input::get('search') .'%');
				})
				->get();
		return View::make('Administrator.Content.index', compact('contents'));
	}

	public function trash($id, $salt)
	{
		if ($salt != md5($id)) {
			return Redirect::action('ContentsController@index');
		} else {
			DB::table('contents')->where('id', '=', $id)->update(array('status' => 'trash'));
			return Redirect::action('ContentsController@index')->with('message', Lang::get('message.post-trash'))->with('status', 'info');
		}
	}

	public function restore($id, $salt)
	{
		if ($salt != md5($id)) {
			return Redirect::action('ContentsController@index');
		} else {
			DB::table('contents')->where('id', '=', $id)->update(array('status' => 'publish'));
			return Redirect::action('ContentsController@index')->with('message', Lang::get('message.post-restore'))->with('status', 'info');
		}
	}

	public function delete($id, $salt)
	{
		if ($salt != md5($id)) {
			return Redirect::action('ContentsController@index');
		} else {
			DB::table('contents')->where('id', '=', $id)->delete();
			return Redirect::action('ContentsController@index')->with('message', Lang::get('message.post-delete'))->with('status', 'info');
		}
	}

	public function emptytrash() 
	{
		DB::table('contents')->where('status', '=', 'trash')->delete();
		return Redirect::action('ContentsController@index');
	}
}
