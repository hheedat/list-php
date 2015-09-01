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
    echo "///aaa";
    return view('welcome');
});

Route::group(['prefix' => 'index'], function () {

    echo "index route";
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

//Route::group(['prefix' => 'list', 'namespace' => 'ListItem'], function () {
//
////    echo "a1";
//
//    Route::get('/check/{id}', 'ListItemController@show');
//
//});