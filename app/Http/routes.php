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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('test','TestController@index');


Route::post('user/register','SignUpController@registerUser');

Route::get('user/register/view','SignUpController@registrationView');

Route::post('user/password/set/{id}','Web\AppUser\UserController@setPassword');

Route::get('user/password_set/view','Web\AppUser\UserController@setPasswordView');

Route::get('email/verify/{id}','EmailVerificationController@verifyEmail');

Route::get('user/login/view','LoginController@loginView');
Route::get('admin','LoginController@adminloginView');
Route::post('login', 'LoginController@loginAttempt');

Route::get('resend_verification/view','EmailVerificationController@getResendVerificationView');
Route::post('resend_verification','EmailVerificationController@sendResendVerificationLink');

Route::group(['middleware' => 'AuthFilter'], function () {

    Route::get('/logout', 'LoginController@logout');
    Route::group(['middleware' => 'UserRole'], function () {
        
    });
    Route::group(['middleware' => 'AdminRole'], function () {
        Route::get('admin/home','Web\Admin\AdminHomeController@index');
        Route::get('admin/category/all','Web\Admin\AdminCategoryController@getllCategoryView');
        Route::get('admin/category/add-new','Web\Admin\AdminCategoryController@getAddNewCategoryView');
        Route::post('admin/category/save-new-category','Web\Admin\AdminCategoryController@saveNewCategory');
        Route::post('admin/category/activate/{catId}','Web\Admin\AdminCategoryController@activateCategory');
        Route::post('admin/category/deactivate/{catId}','Web\Admin\AdminCategoryController@deactivateCategory');
        Route::post('admin/category/delete/{catId}','Web\Admin\AdminCategoryController@deleteCategory');
        Route::get('admin/category/edit/view/{catId}','Web\Admin\AdminCategoryController@getEditCategoryView');
        Route::post('admin/category/edit','Web\Admin\AdminCategoryController@editCategory');
        Route::get('admin/news/get-all-news','Web\Admin\AdminNewsController@getAllNews');
        Route::post('admin/news/delete/{newsId}','Web\Admin\AdminNewsController@deleteNews');
        Route::post('admin/news/publish/{newsId}','Web\Admin\AdminNewsController@publishNews');
        Route::post('admin/news/unpublish/{newsId}','Web\Admin\AdminNewsController@unpublishNews');
    });
});



Route::get('/','Web\AppUser\UserHomeController@index');
Route::get('/home','Web\AppUser\UserHomeController@index');
Route::get('/about','Web\AppUser\UserHomeController@about');


Route::get('/rss','Web\AppUser\UserNewsController@rss');

Route::get('/news/{slug}','web\appUser\UserNewsController@getNewsBySlugView');
Route::get('/news/download/{slug}','Web\AppUser\UserNewsController@getNewsBySlugDownload');

Route::get('/news/category/{catId}','Web\AppUser\UserNewsController@getNewsByCatIdView');
Route::get('/allnews','web\appUser\UserNewsController@getAllNewsView');
Route::get('/news/search/{search_val}','web\appUser\UserNewsController@getNewsBySearchView');


/// Raza Urls

Route::get('/createnews','web\appUser\UserNewsController@createNewsView');
Route::post('/newsPost','web\appUser\UserNewsController@createNews');
Route::get('/mynews','web\appUser\UserNewsController@getNewByUserIdView');
Route::get('/delete_news/{id}','web\appUser\UserNewsController@deleteNews');







