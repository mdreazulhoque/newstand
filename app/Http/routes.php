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

Route::get('test','TestController@index');

Route::post('user/register','SignUpController@registerUser');

Route::post('email/verify/{id}','EmailVerificationController@verifyEmail');

Route::post('/login', 'LoginController@loginAttempt');



Route::group(['middleware' => 'AuthFilter'], function () {

    Route::post('/logout', 'LoginController@logout');

    Route::group(['middleware' => 'AdminRole'], function () {

        Route::post('admin/register','SignUpController@registerAdmin');
    });
});