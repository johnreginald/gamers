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
Route::get('mail', function(){
    Mail::send('emails.register', array(
        'username' => 'johnthelinux',
        'password' => 'thisispassword',
        'activationcode' => "tasdfasd"
        ), function($message)
    {
        $message->to('johnthelinux@gmail.com', 'John Reginald')->subject('Account Information for For Gamers, By Gamers Website');
    });
});

Route::get('test', function(){
    $user = Sentry::findUserById(1);
    echo $user->email;
    // Sentry::createGroup(array(
    // 'name'        => 'Reseller',
    // ));
    // Sentry::createGroup(array(
    // 'name'        => 'Administrator',
    // ));    
});

Route::get('post/{id}', 'HomeController@single');
Route::get('categories/{name}', 'HomeController@categories');

Route::get('logout', array('as' => 'logout', 'uses' => 'AccountController@getLogout'));

Route::get('login', 'AccountController@getLogin');
Route::post('login', 'AccountController@postLogin');

Route::get('activate/{code}/{id}', 'AccountController@activate');

Route::get('register', 'AccountController@getRegister');
Route::post('register', 'AccountController@postRegister');

Route::get('reset', 'AccountController@getReset');
Route::post('reset', 'AccountController@postReset');

Route::get('shop', 'ProductsController@the_shop');

Route::get('item/{id}', 'ProductsController@detail');

Route::post('shop-add', 'ProductsController@add_item');

Route::get('shopping-cart', 'ProductsController@shopping_cart');

Route::post('clear-cart', 'ProductsController@clear_cart');

/* === Login Check === */

Route::group(['before' => 'normal'], function()
{
    // Account Route
    Route::get('dashboard', 'AccountController@getIndex');

    Route::post('password', 'AccountController@postPassword');

    Route::post('email', 'AccountController@postEmail');

    Route::post('prepaid', 'AccountController@postPrepaid');

    // Shopping Cart Route
    Route::post('checkout', 'ProductsController@checkout');
});

/* === Reseller Access === */

Route::group(['before' => 'reseller'], function()
{
    // Reseller Route
    Route::get('reseller', 'ResellerController@index');
    Route::get('reseller/product', 'ResellerController@new_product');
    Route::post('reseller/application', 'ResellerController@application');
    Route::post('reseller/save', 'ResellerController@save');
    Route::post('reseller/images/upload', 'ResellerController@upload_images');
});

/* === Administrator Route === */

Route::group(['before' => 'administrator', 'prefix' => 'administrator'], function()
{ 
    // Posts Management Route
    Route::post('post/search', 'PostsController@search');
    Route::post('post/restore', 'PostsController@restore');
    Route::post('post/trash', 'PostsController@trash');
    Route::post('post/status_update/{id}', 'PostsController@status_update');
    Route::get('post/preview/{id}', 'PostsController@preview');
    Route::resource('post', 'PostsController');

    // Categories
    Route::resource('categories', 'PostCategoriesController');

    // Froala Media Manager
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
    Route::post('order/accept/{id}', 'AdministratorController@order_accept');
    Route::post('order/cancel/{id}', 'AdministratorController@order_cancel');

    // Slider Management Route

    Route::get('slider', 'AdministratorController@getSlider');
    Route::get('slider/create', 'AdministratorController@getSliderCreate');
    Route::post('slider/create', 'AdministratorController@postSliderCreate');
    Route::post('slider/upload_slider', 'AdministratorController@upload_slider');
    Route::post('slider/delete/{id}', 'AdministratorController@delete_slider');

    // Advertisement Management Route TODO

    Route::get('advertisement', 'AdministratorController@getAdvertisement');
    Route::get('advertisement/create', 'AdministratorController@getAdvertisementCreate');
    Route::post('advertisement/create', 'AdministratorController@postAdvertisementCreate');
    Route::post('advertisement/upload_slider', 'AdministratorController@upload_slider');
    Route::post('advertisement/delete/{id}', 'AdministratorController@delete_advertisement');

    // Sponsor Management Route

    Route::get('sponsor', 'AdministratorController@getSponsor');
    Route::get('sponsor/create', 'AdministratorController@getSponsorCreate');
    Route::post('sponsor/create', 'AdministratorController@postSponsorCreate');
    Route::post('sponsor/upload_slider', 'AdministratorController@upload_slider');
    Route::post('sponsor/delete/{id}', 'AdministratorController@delete_sponsor');

    // Reseller Application Route

    Route::get('reseller', 'AdministratorController@getReseller');
    Route::get('reseller/product', 'AdministratorController@getResellerProduct');
    Route::post('reseller/product/accept/{id}', 'AdministratorController@reseller_product_accept');
    Route::post('reseller/product/cancel/{id}', 'AdministratorController@reseller_product_cancel');
    Route::post('reseller/accept/{id}', 'AdministratorController@reseller_accept');
    Route::post('reseller/cancel/{id}', 'AdministratorController@reseller_cancel');
    
    // Webstie Settings Management Route

    Route::get('settings', 'AdministratorController@getSettings');

    // Message Box
    Route::get('message', 'AdministratorController@getMessage');
    Route::post('message', 'AdministratorController@postMessage');
    
    // Other Route
    Route::post('upload_basic', 'AdministratorController@upload_basic');

    Route::post('upload_plus', 'AdministratorController@upload_plus');

    Route::post('upload_ide', 'AdministratorController@upload_ide');

    // Root Route
    Route::get('/', 'AdministratorController@getIndex');
    
});

Route::any('/', 'HomeController@index');
