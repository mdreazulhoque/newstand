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

Route::post('user/password/set/{id}','web\AppUser\UserController@setPassword');

Route::get('user/password_set/view','web\AppUser\UserController@setPasswordView');

Route::get('email/verify/{id}','EmailVerificationController@verifyEmail');

Route::get('user/login/view','LoginController@loginView');
Route::get('admin','LoginController@adminloginView');
Route::post('login', 'LoginController@loginAttempt');

Route::get('resend_verification/view','EmailVerificationController@getResendVerificationView');
Route::post('resend_verification','EmailVerificationController@sendResendVerificationLink');

Route::group(['middleware' => 'AuthFilter'], function () {

    Route::get('/logout', 'LoginController@logout');
    Route::group(['middleware' => 'UserRole'], function () {
        Route::get('/createnews','web\appUser\UserNewsController@createNewsView');
        Route::post('/newsPost','web\appUser\UserNewsController@createNews');
        Route::get('/mynews','web\appUser\UserNewsController@getNewByUserIdView');
        Route::get('/delete_news/{id}','web\appUser\UserNewsController@deleteNews');
        Route::get('/allnews','web\appUser\UserNewsController@getAllNewsView');
        Route::get('/news/details/{slug}','web\appUser\UserNewsController@getNewsByMySlugView');
    });
    Route::group(['middleware' => 'AdminRole'], function () {
        Route::get('admin/home','web\admin\AdminHomeController@index');
        Route::get('admin/category/all','web\admin\AdminCategoryController@getllCategoryView');
        Route::get('admin/category/add-new','web\Admin\AdminCategoryController@getAddNewCategoryView');
        Route::post('admin/category/save-new-category','web\Admin\AdminCategoryController@saveNewCategory');
        Route::post('admin/category/activate/{catId}','web\Admin\AdminCategoryController@activateCategory');
        Route::post('admin/category/deactivate/{catId}','web\Admin\AdminCategoryController@deactivateCategory');
        Route::post('admin/category/delete/{catId}','web\Admin\AdminCategoryController@deleteCategory');
        Route::get('admin/category/edit/view/{catId}','web\Admin\AdminCategoryController@getEditCategoryView');
        Route::post('admin/category/edit','web\Admin\AdminCategoryController@editCategory');
        Route::get('admin/news/get-all-news','web\Admin\AdminNewsController@getAllNews');
        Route::post('admin/news/delete/{newsId}','web\Admin\AdminNewsController@deleteNews');
        Route::post('admin/news/publish/{newsId}','web\Admin\AdminNewsController@publishNews');
        Route::post('admin/news/unpublish/{newsId}','web\Admin\AdminNewsController@unpublishNews');
        Route::get('admin/app-user/all','web\Admin\AdminHomeController@userManagement');
        Route::get('admin/admin-user/add-new','web\Admin\AdminHomeController@userManagement');
    });
});



Route::get('/','web\appUser\UserHomeController@index');
Route::get('/home','web\appUser\UserHomeController@index');
Route::get('/about','web\appUser\UserHomeController@about');


Route::get('/rss','web\appUser\UserNewsController@rss');

Route::get('/news/{slug}','web\appUser\UserNewsController@getNewsBySlugView');
Route::get('/news/download/{slug}','web\AppUser\UserNewsController@getNewsBySlugDownload');

Route::get('/news/category/{catId}','web\appUser\UserNewsController@getNewsByCatIdView');
Route::get('/news/search/{search_val}','web\appUser\UserNewsController@getNewsBySearchView');










