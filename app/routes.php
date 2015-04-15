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

// Route::get('post/{id}', 'ContentsController@view');

Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@getLogout'));

Route::group(array('before' => 'logged_in'), function() {

    Route::get('login', 'AccountController@getLogin');
    Route::post('login', 'AccountController@postLogin');

    Route::get('register', 'AccountController@getRegister');
    Route::post('register', 'AccountController@postRegister');

    Route::get('reset', 'AccountController@getReset');
    Route::post('reset', 'AccountController@postReset');

});

Route::post('password', 'AccountController@postPassword');

Route::post('email', 'AccountController@postEmail');

Route::post('prepaid', 'AccountController@postPrepaid');

// Frontend Shopping Cart Route

Route::get('shop', 'ShopsController@the_shop');

Route::post('shop-add', 'ShopsController@add_item');

Route::get('shopping-cart', 'ShopsController@shopping_cart');

Route::post('checkout', 'ShopsController@checkout');

// Dashboard Route

Route::get('dashboard', 'AccountController@getIndex');


Route::group(array('prefix' => 'administrator', 'before' => 'auth',), function() {

    // Posts Management Route
    Route::post('post/search', function(){
        // $posts = Post::search(Input::get('search'));

        $q = Input::get('search');
        $posts = Post::where('title', 'LIKE', '%'. $q .'%')
        ->orWhere('content', 'LIKE', '%'. $q .'%')
        ->orWhere('author', 'LIKE', '%'. $q .'%')
        ->get();

        foreach ($posts as $p) {
            echo $p->title . '<br>';
            echo $p->author . '<br>';
            echo $p->content . '<hr>';
        }
    });
    Route::resource('post', 'PostsController');

    // Users Management Route

    Route::post('user/search', 'UAController@search');

    Route::resource('user', 'UAController');

    // Shop Controller Route

    Route::resource('shop', 'ShopsController');

    // Prepaid Controller Route

    Route::post('prepaid/search', 'AdministratorController@prepaid_search');

    Route::get('prepaid', 'AdministratorController@getPrepaid');
    Route::post('prepaid', 'AdministratorController@postPrepaid');

    Route::post('prepaid/generate', 'AdministratorController@postPrepaidGenerate');

    // Order Management Route

    Route::get('order', 'AdministratorController@getOrder');

    // Advertisement Management Route TODO

    Route::get('advertisement', 'AdministratorController@getAdvertisement');
    Route::post('advertisement', 'AdministratorController@postAdvertisement');

    // Sponsor Management Route

    Route::get('sponsor', 'AdministratorController@getSponsor');
    Route::post('sponsor', 'AdministratorController@postSponsor');

    // Slider Management Route

    Route::get('slider', 'AdministratorController@getSlider');
    Route::post('slider', 'AdministratorController@postSlider');

    // Webstie Settings Management Route

    Route::get('settings', 'AdministratorController@getSettings');

    // Other Route
    Route::post('upload_basic', 'AdministratorController@upload_basic');

    Route::post('upload_plus', 'AdministratorController@upload_plus');

    Route::post('upload_ide', 'AdministratorController@upload_ide');

    // Root Route
    Route::get('/', 'AdministratorController@getIndex');

});

Route::any('/', 'HomeController@index');