<?php

use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
//use Mcamara\LaravelLocalization\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    // note that the prefix is admin for all file route
    Route::middleware('auth:admin')->prefix('admin')->group(function () {
        // TODO :: first page admin visited if authenticated
        Route::get('/', 'HomeController@index')->name('admin.home');

        Route::prefix('settings')->group(function () {
            Route::get('shipping-method/{type}', 'SettingController@editShippingMethod')->name('admin.edit.shipping.method');
            Route::put('shipping-method/{id}', 'SettingController@updateShippingMethod')->name('admin.update.shipping.method');
        });
        Route::prefix('profiles')->group(function () {
            Route::get('edit', 'ProfileController@edit')->name('admin.edit.profile');
            Route::put('update', 'ProfileController@update')->name('admin.update.profile');
            Route::get('edit-password', 'ProfileController@editPassword')->name('admin.edit.profile.password');
            Route::patch('update-password', 'ProfileController@updatePassword')->name('admin.update.profile.password');
        });

        // logout
        Route::get('logout', 'AuthController@logout')->name('admin.logout');
    });

    Route::middleware('guest:admin')->prefix('admin')->group(function () {
        Route::get('login', 'AuthController@showLogin')->name("admin.login");
        Route::post('login', 'AuthController@login')->name("admin.post.login");
    });
});


