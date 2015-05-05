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
        $validator = Validator::make(Input::all(), Config::get('validation.login'));

        if ($validator->fails()) {
            return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
        } else {
            try
            {
                $credentials = array(
                    'username' => Input::get('username'),
                    'password' => Input::get('password')
                );

                Sentry::authenticate($credentials, false);
                return Redirect::to('dashboard');
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                return Redirect::to('login')->withMessage(Lang::get('message.login-wrong'))->withStatus('info');
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return Redirect::to('login')->withMessage(Lang::get('message.login-not-found'))->withStatus('danger');
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                return Redirect::to('login')->withMessage(Lang::get('message.login-not-activated'))->withStatus('danger');
            }
            catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
            {
                return Redirect::to('login')->withMessage(Lang::get('message.login-suspended'))->withStatus('danger');
            }
            catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
            {
                return Redirect::to('login')->withMessage(Lang::get('message.login-banned'))->withStatus('danger');
            }
        }
    }

    // REGISTRATION MECHANISM

    public function getRegister() {
        return View::make('User.register');
    }

    public function postRegister() {

        $validator = Validator::make(Input::all(), Config::get('validation.register'));

        if ($validator->fails()) {
            return Redirect::to('register')->withErrors($validator)->withInput(Input::except('password', 'password_confirmation'));
        } else {
            $user = Sentry::register(array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'email' => Input::get('email')
            ));
            // TODO
            // $activationCode = $user->getActivationCode();
            Mail::send('emails.welcome', array('key' => 'value'), function($message)
            {
                $message->to(Input::get('email'), Input::get('username'))->subject('Welcome!');
            });
            return Redirect::to('login')->withMessage(Lang::get('message.register-success'))->withStatus('success');
        }
    }

    // LOGOUT FUNCTION

    public function getLogout() {
        Sentry::logout();
        return Redirect::to('/');
    }

    // FORGOT PASSWORD MECHANISM

    public function getReset() {
        return View::make('User.reset');
    }

    public function postReset() {
        $validator = Validator::make(Input::all(), Config::get('validation.reset'));

        if ($validator->fails()) {
            return Redirect::to('reset')->withErrors($validator);
        } else {
            $sentry = Sentry::getUserProvider()->getEmptyUser();
            if($sentry->where('email', '=', Input::get('email'))->first()) {
                Mail::send('emails.welcome', array('key' => 'value'), function($message)
                {
                    $message->to(Input::get('email'), Input::get('email'))->subject('Welcome!');
                });
                return Redirect::to('reset')->withMessage(Lang::get('message.reset-success'))->withStatus('success');
            } else {
                return Redirect::to('reset')->withMessage(Lang::get('message.reset-fail'))->withStatus('info');
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

// TODO FUNCTIONS
    public function postEmail() {
        $user = Auth::user();
        $validator = Validator::make(Input::all(), Config::get('validation.email'));

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
