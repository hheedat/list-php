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

Route::get('/', function () {

    return view('welcome');

});

Route::group(['prefix' => 'index'], function () {

    // Matches The "/index/" URL
    Route::get('/', function () {

        return view('index', [
            'islogin' => true,
            'userinfo' => [
                'username' => ''
            ]
        ]);

    });

});

Route::group(['prefix' => 'list', 'namespace' => 'ListItem'], function () {

    Route::get('/check', 'ListItemController@show');

});