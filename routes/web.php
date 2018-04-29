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

Route::group(['namespace' => 'Auth'], function () {
    Route::group(['prefix' => 'auth/qq'], function () {
        Route::get('/', 'SocialiteAuthController@redirectToProvider');
        Route::get('callback', 'SocialiteAuthController@handleProviderCallback');
        Route::get('test', 'SocialiteAuthController@test');
    });
});

Route::get('/', 'IndexController@index')->name('index');

Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
