<?php

class AccountController extends BaseController {

    public function getIndex() {
        $data = array(
            'orders' => Order::where('account_id', '=', Auth::id())->get(),
            'new_products' => Product::orderby('created_at', 'desc')->take(6)->get(),
        );
        return View::make('User.dashboard', $data);
    }

    // LOGIN MECHANISM

    public function getLogin() {
        return View::make('User.login');
    }

    public function postLogin() {
        $rules = array(
            'username' => 'required|min:4',
            'password' => 'required|alpha_num'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
        } else {
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );
            if (Auth::attempt($userdata)) {
                return Redirect::intended();
            } else {
                return Redirect::to('login');
            }
        }
    }

    // REGISTRATION MECHANISM

    public function getRegister() {
        return View::make('User.register');
    }

    public function postRegister() {

        $rules = array(
            'username' => 'unique:accounts|required|min:4',
            'email' => 'unique:accounts|required|email',
            'password' => 'required|alpha_num|between:4,30|confirmed',
            'password_confirmation' => 'required|alpha_num|between:4,30'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('register')->withErrors($validator)->withInput(Input::except('password', 'password_confirmation'));
        } else {
            $account = new Account;
            $account->username = Input::get('username');
            $account->password = Hash::make(Input::get('password'));
            $account->email = Input::get('email');
            $account->save();
            return View::make('User.message')->with(array('message' => Lang::get('message.success'), 'status' => 'success'));
        }
    }

    // LOGOUT FUNCTION

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }

    // FORGOT PASSWORD MECHANISM

    public function getReset() {
        return View::make('User.reset');
    }

    public function postReset() {
        $rules = array(
            'email' => 'required|email'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('reset')->withErrors($validator);
        } else {
            $user = DB::table('users')->where('email', Input::get('email'))->count();
            if ($user == 1) {
                return View::make('portal/message')->with('message', sha1(Input::get('email')));
            } else {
                return View::make('portal/auth/reset')->with('notfound', "Your ->where('password', '=', Hash::make(Input::get('oldpassword')))Email Address is not registered");
            }
        }
    }

    public function postPrepaid() {
        $data = array(
            'used_by' => Auth::id(),
            'status' => TRUE,
        );
        // Set Prepaid Card as Used
        Prepaid::where('serial', Input::get('serial'))->where('code', Input::get('code'))->update($data);
        
        // Add Credit to Account
        $account = Account::find(1);
        $account->credit = $account->credit + 500;
        $account->save();
        return Redirect::to('dashboard')->withMessage(Lang::get('message.prepaid-success'))->withStatus('success');
    }

    public function postEmail() {
        $user = Auth::user();
        $rules = array(
            'newemail' => 'unique:accounts,email|required|email'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            if (Input::get('newemail') == $user->email) {
                echo "Type New Email";
            } else {
                $user->email = Input::get('newemail');
                $user->save();
                return View::make('User.message')->with(array('message' => Lang::get('message.success'), 'status' => 'success'));
            }
        }
    }

    public function postPassword() {
        $user = Auth::user();
        $rules = array(
            'newpassword' => 'required|alpha_num|between:4,30|confirmed',
            'newpassword_confirmation' => 'required|alpha_num|between:4,30'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
//            return Redirect::intended()->withErrors($validator);
            echo "Validator Fail";
        } else {
            if (Hash::check(Input::get('oldpassword'), $user->password) == TRUE) {
                $user->password = Hash::make(Input::get('newpassword'));
                $user->save();
                return View::make('User.message')->with(array('message' => Lang::get('message.success'), 'status' => 'success'));
            } else {
                echo "Your Password is Wrong";
            }
        }
    }

}
