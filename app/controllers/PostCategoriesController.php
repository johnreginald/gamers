<?php

class PostCategoriesController extends \BaseController {

	/**
	 * Display a listing of postcategories
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = PostCategory::all();

		return View::make('Administrator.PostCategories.index', compact('categories'));
	}

	/**
	 * Store a newly created postcategory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
			'name' => strip_tags(Purifier::clean(Input::get('name'))),
			'slug' => strtolower(str_replace(' ', '-', strip_tags(Purifier::clean(Input::get('slug'))))),
			);
		$rules = array(
			'name' => 'unique:PostCategories,name|required',
			'slug' => 'unique:PostCategories,slug',
			);
		$validator = Validator::make($data, $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$category  = new PostCategory;
		$category->name = Input::get('name');
		$category->description = Input::get('description');
		$category->slug = strtolower(str_replace(' ', '-', Input::get('name')));
		$category->save();
		return Redirect::to('administrator/categories')->withMessage('Added New Category!')->withStatus('success');
	}

	/**
	 * Show the form for editing the specified postcategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array(
			'category' => PostCategory::find($id),
			'categories' => PostCategory::All(),
			);
 
		return View::make('Administrator.PostCategories.edit', $data);
	}

	/**
	 * Update the specified postcategory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = array(
			'name' => strip_tags(Purifier::clean(Input::get('name'))),
			'slug' => strtolower(str_replace(' ', '-', strip_tags(Purifier::clean(Input::get('slug'))))),
			);
		$rules = array(
			'name' => 'unique:PostCategories,name|required',
			'slug' => 'unique:PostCategories,slug',
			);

		$validator = Validator::make($data, $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$category = PostCategory::findOrFail($id);
		$category->name = Input::get('name');
		$category->description = Input::get('description');
		$category->slug = strtolower(str_replace(' ', '-', Input::get('name')));
		$category->save();

		return Redirect::to('administrator/categories');
	}

	/**
	 * Remove the specified postcategory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PostCategory::destroy($id);

		return Redirect::to('administrator/categories');
	}

}
