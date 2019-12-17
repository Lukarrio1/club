<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/data', 'AdminController@getAdmin');
    Route::get('/edit', 'AdminController@edit')->name('admin.edit');
    Route::post('/edit', 'AdminController@update');
    Route::delete('/delete', 'AdminController@deleteUser');

    // user routes
    Route::get('/users', 'Admin\UserController@userPage')->name('admin.users');
    Route::post('/user/emailCheck', 'Admin\UserController@emailCheck');
    Route::post('/create', 'Admin\UserController@store');
    Route::post('/user/search', 'Admin\UserController@searchUser');
    Route::delete('/delete/user/{user}', 'Admin\UserController@removeMember');
    Route::get('/user/{user}', 'Admin\UserController@single');

    //clubs routes
    Route::get('/clubs', 'Admin\ClubController@index');
    Route::get('/clubsPage', 'Admin\ClubController@clubPage')->name('admin.clubs');
    Route::post('/clubs/search', 'Admin\ClubController@searchClubs');
    Route::post('/club', 'Admin\ClubController@store');
    Route::delete('/club/delete/{id}', 'Admin\ClubController@delete');
    Route::post('/club/{club}', 'Admin\ClubController@update');
    Route::get('/club/{club}', 'Admin\ClubController@show');

    //Message routes
    Route::get('/message/page', 'Admin\MessageController@messagePage')->name('admin.message');
    Route::get('/messages/{id}', 'Admin\MessageController@index');
    Route::post('/send/message', 'Admin\MessageController@store');
    Route::delete('/message/delete/{message}', 'Admin\MessageController@delete');

    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::prefix('user')->group(function () {
    Route::get('/', 'User\UserController@userPage');
    Route::get('/active/{key?}', 'User\UserController@index');
    Route::get('/profile', 'User\UserController@profilePage')->name('user.profile');
    Route::group(['middleware' => ['auth', 'leader']], function () {
        Route::get('/messagePage', 'User\MessageController@messagePage')->name('user.message');
        Route::get('/messages/{club}', 'User\MessageController@getMessages');
        Route::post('/message', 'User\MessageController@store');
    });

    Route::post('/clubs/search', 'User\ClubController@index');
    Route::get('/club/{club}', 'User\ClubController@single');

    Route::get('/notifications', 'User\NotificationController@getMessageNotifications');
    Route::delete('/notification/remove/{notification}', 'User\NotificationController@destroy');

});
