<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
*/

Route::get('post/{id}', 'ContentsController@view');

Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@getLogout'));

// Route::filter('loggedin', function() {
//     if (Auth::check()) {
//         return Redirect::to('administrator');
//     }
// });

// Route::group(array('before' => 'loggedin'), function() {

    Route::get('login', 'AccountController@getLogin');
    Route::post('login', 'AccountController@postLogin');

    Route::get('register', 'AccountController@getRegister');
    Route::post('register', 'AccountController@postRegister');

    Route::get('reset', 'AccountController@getReset');
    Route::post('reset', 'AccountController@postReset');

    Route::post('password', 'AccountController@postPassword');

    Route::post('email', 'AccountController@postEmail');

    Route::post('prepaid', 'AccountController@postPrepaid');

    Route::get('shop', 'AccountController@getShop');

// });

// Route::filter('auth_check', function() {
//     if (!Auth::check()) {
//         return Redirect::to('login');
//     }
// });

// Route::group(array('before' => 'auth_check'), function(){

    Route::get('dashboard', 'AccountController@getIndex');

// });

// Route::group(array('prefix' => 'administrator', 'before' => 'auth_check',), function() {

//     Route::get('/', 'AdministratorController@getIndex');

// // User Administration Controller Route

//     Route::post('user/search', 'UAController@search');

//     Route::resource('user', 'UAController');

// // Shop Controller Route

//     Route::resource('shop', 'ShopsController');

// // Media Controller Route

//     Route::get('media', 'AdministratorController@getMedia');
//     Route::post('media', 'AdministratorController@postMedia');

// // Prepaid Controller Route

//     Route::post('prepaid/search', 'AdministratorController@prepaid_search');

//     Route::get('prepaid', 'AdministratorController@getPrepaid');
//     Route::post('prepaid', 'AdministratorController@postPrepaid');

//     Route::post('prepaid/generate', 'AdministratorController@postPrepaidGenerate');

// // TODO ROUTE

//     Route::get('order', 'AdministratorController@getOrder');

//     Route::get('settings', 'AdministratorController@getSettings');

// });

Route::any('/', 'HomeController@index');