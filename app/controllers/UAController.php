<?php

class UAController extends \BaseController {

	public function index() 
	{
		$user = User::all();

		return View::make('Administrator.User.index', compact('user'));
	}

	public function create()
	{
		return View::make('Administrator.User.create');
	}

	/**
	 * Store a newly created content in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'username' => 'unique:users|required|min:4',
            'email' => 'unique:users|required|email',
            'password' => 'required|alpha_num|between:4,30|confirmed',
            'password_confirmation' => 'required|alpha_num|between:4,30'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password', 'password_confirmation'));
        } else {
            $account = new User;
            $account->username = Input::get('username');
            $account->password = Hash::make(Input::get('password'));
            $account->email = Input::get('email');
            $account->save();
            return View::make('User.message')->with(array('message' => Lang::get('message.success'), 'status' => 'success'));
        }		
	}

	public function view($id)
	{
		$content = User::findOrFail($id);

		return View::make('User.content', compact('content'));
	}

	/**
	 * Show the form for editing the specified content.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('Administrator.User.edit', compact('user'));
		
	}

	/**
	 * Update the specified content in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$rules = array(
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'alpha_num|between:4,30|confirmed',
            'password_confirmation' => 'alpha_num|between:4,30'
        );

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if ( Input::get('email') != '') {
	        $user->email = Input::get('email'); 
	    }
	    if ( Input::get('password') != '') {
	        $user->password = Hash::make(Input::get("password")); 
	    }
	    $user->save();

		return Redirect::action('UAController@edit', ['user' => $id])->with('user', $user)->with('message', Lang::get('message.post-update'))->with('status', 'info');
	}

	/**
	 * Remove the specified content from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::action('UAController@index')->with('message', Lang::get('message.post-update'))->with('status', 'info');;
	}	

	public function search() {
		$user = DB::table('users')
				->where(function($query){
					$query->orWhere('username', 'LIKE', '%' . Input::get('search') . '%')
					->orWhere('email', 'LIKE', '%' . Input::get('search') . '%');
				})
				->get();
		return View::make('Administrator.User.index', compact('users'));
	}
}
