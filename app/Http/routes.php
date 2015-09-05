<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        \Log::error("test");
        return view('auth.auth');


    });

    Route::get('/login', function () {

        return view('auth.auth');

    });

    Route::get('/register', function () {

        return view('auth.auth');

    });

    Route::group(['prefix' => 'auth'], function () {

        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');

        Route::get('register', 'Auth\AuthController@getRegister');
        Route::post('register', 'Auth\AuthController@postRegister');

    });

    Route::group(['prefix' => 'list', 'namespace' => 'ListItem'], function () {

        Route::get('/check', 'ListItemController@show');

    });

});