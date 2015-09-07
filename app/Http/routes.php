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

        return view('index');

    });

    Route::get('/login', function () {

        return view('auth.login');

    });

    Route::get('/register', function () {

        return view('auth.register');

    });

    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');

        Route::post('register', 'Auth\AuthController@postRegister');

    });

    Route::group(['prefix' => 'list', 'namespace' => 'ListItem'], function () {

        Route::get('/', 'ListItemController@index');

        Route::post('/check/{status}', 'ListItemController@show');
        Route::post('/add', 'ListItemController@store');
        Route::post('/complete', 'ListItemController@complete');
        Route::post('/undo', 'ListItemController@undo');
        Route::post('/detail', 'ListItemController@detail');
        Route::post('/update', 'ListItemController@update');
        Route::post('/delete', 'ListItemController@destroy');

    });

});