<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public static $rules = [
		'username' => 'unique:users|required|min:4',
		'email' => 'unique:users|required|email',
		'password' => 'required|alpha_num|between:4,30|confirmed',
		'password_confirmation' => 'required|alpha_num|between:4,30'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['username', 'email', 'password'];

}
