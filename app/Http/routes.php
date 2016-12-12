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

Route::get('admin/home','Web\Admin\AdminHomeController@index');

Route::get('/home','Web\AppUser\UserHomeController@index');
Route::get('admin/category/all','Web\Admin\AdminCategoryController@getllCategoryView');
Route::get('admin/category/add-new','Web\Admin\AdminCategoryController@getAddNewCategoryView');
Route::post('admin/category/save-new-category','Web\Admin\AdminCategoryController@saveNewCategory');
Route::post('admin/category/activate/{catId}','Web\Admin\AdminCategoryController@activateCategory');
Route::post('admin/category/deactivate/{catId}','Web\Admin\AdminCategoryController@deactivateCategory');
Route::post('admin/category/delete/{catId}','Web\Admin\AdminCategoryController@deleteCategory');
Route::get('admin/category/edit/view/{catId}','Web\Admin\AdminCategoryController@getEditCategoryView');
Route::post('admin/category/edit','Web\Admin\AdminCategoryController@editCategory');



