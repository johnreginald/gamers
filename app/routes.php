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
// Route::get('test', function(){
// 
// });


Route::get('post/{id}', 'HomeController@single');

Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@getLogout'));

// Route::group(array('before' => 'logged_in'), function() {

    Route::get('login', 'AccountController@getLogin');
    Route::post('login', 'AccountController@postLogin');

    Route::get('register', 'AccountController@getRegister');
    Route::post('register', 'AccountController@postRegister');

    Route::get('reset', 'AccountController@getReset');
    Route::post('reset', 'AccountController@postReset');
// });

Route::post('password', 'AccountController@postPassword');

Route::post('email', 'AccountController@postEmail');

Route::post('prepaid', 'AccountController@postPrepaid');

// Frontend Shopping Cart Route

Route::get('shop', 'ProductsController@the_shop'); // Shop Route

Route::get('item/{id}', 'ProductsController@detail'); // Single Product Detail

Route::post('shop-add', 'ProductsController@add_item');

Route::get('shopping-cart', 'ProductsController@shopping_cart');

Route::post('checkout', 'ProductsController@checkout');

Route::post('clear-cart', 'ProductsController@clear_cart');

// Dashboard Route

Route::get('dashboard', 'AccountController@getIndex');


Route::group(array('prefix' => 'administrator'), function() {

    // Posts Management Route
    Route::post('post/search', 'PostsController@search');
    Route::post('post/restore', 'PostsController@restore');
    Route::post('post/trash', 'PostsController@trash');
    Route::get('post/preview/{id}', 'PostsController@preview');
    Route::resource('post', 'PostsController');

    // Media Manager
    Route::get('images/load', 'PostsController@load_images');
    Route::post('images/delete', 'PostsController@delete_images');
    Route::post('images/upload', 'PostsController@upload_images');

    // Users Management Route

    Route::post('user/search', 'UAController@search');

    Route::resource('user', 'UAController');

    // Product Controller Route

    Route::resource('product', 'ProductsController');

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
    Route::get('sponsor/create', 'AdministratorController@getSponsorCreate');
    Route::post('sponsor/create', 'AdministratorController@postSponsorCreate');


    // Slider Management Route

    Route::get('slider', 'AdministratorController@getSlider');
    Route::get('slider/create', 'AdministratorController@getSliderCreate');
    Route::post('slider/create', 'AdministratorController@postSliderCreate');
    Route::post('slider/upload_slider', 'AdministratorController@upload_slider');

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
