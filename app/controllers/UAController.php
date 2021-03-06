<?php

class UAController extends \BaseController {

	public function index() 
	{
		$user = Sentry::findAllUsers();

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
            'username' => 'unique:accounts|required|min:4',
            'email' => 'unique:accounts|required|email',
            'password' => 'required|alpha_num|between:4,30|confirmed',
            'password_confirmation' => 'required|alpha_num|between:4,30'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::except('password', 'password_confirmation'));
        } else {

            $user = Sentry::create(array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'email' => Input::get('email'),
                'activated' => true,
            ));

		    $group = Sentry::findGroupByName('Administrator');
		    $user->addGroup($group);
		    
            return View::make('User.message')->with(array('message' => Lang::get('message.success'), 'status' => 'success'));
        }		
	}

	public function view($id)
	{
		$content = Account::findOrFail($id);

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
		$user = Sentry::findUserById($id);

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
		$user = Account::findOrFail($id);

		$rules = array(
            'email' => 'email|unique:accounts,email,' . $id,
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
		Account::destroy($id);

		return Redirect::action('UAController@index')->with('message', Lang::get('message.post-update'))->with('status', 'info');;
	}	

	public function search() {
		$user = DB::table('accounts')
				->where(function($query){
					$query->orWhere('username', 'LIKE', '%' . Input::get('search') . '%')
					->orWhere('email', 'LIKE', '%' . Input::get('search') . '%');
				})
				->get();
		return View::make('Administrator.User.index')->with('user', $user);
	}
}
