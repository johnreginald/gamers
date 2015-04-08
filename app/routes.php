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

    // User Administration Controller Route

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
    Route::post('upload', function(){
        echo Input::file('file')->getClientOriginalName();
        // echo "asd";
    });

    Route::get('/', 'AdministratorController@getIndex');

});

Route::any('dshop', function(){
    // Cart::destroy();
});

Route::get('test', function() {
    return View::make('test');
});

Route::post('test', function () {

    // Grab our files input
    $files = Input::file('files');
    // We will store our uploads in public/uploads/basic
    $assetPath = '/uploads';
    $uploadPath = public_path($assetPath);
    // We need an empty arry for us to put the files back into
    $results = array();

    foreach ($files as $file) {
        // store our uploaded file in our uploads folder
        $file->move($uploadPath, $file->getClientOriginalName());
        // set our results to have our asset path
        $name = $assetPath . '/' . $file->getClientOriginalName();
        $results[] = compact('name');
    }

    // return our results in a files object
    // return array(
    //     'files' => $results
    // );
    return Response::json(array('files' => $results));

    // $file = Input::file('file');

    // if($file) {

    //     $destinationPath = public_path() . '/uploads/';
    //     $filename = $file->getClientOriginalName();

    //     $upload_success = Input::file('file')->move($destinationPath, $filename);

    //     if ($upload_success) {

    //         // resizing an uploaded file
    //         Image::make($destinationPath . $filename)->resize(100, 100)->save($destinationPath . "100x100_" . $filename);

    //         return Response::json('success', 200);
    //     } else {
    //         return Response::json('error', 400);
    //     }
    // }
});

Route::any('/', 'HomeController@index');