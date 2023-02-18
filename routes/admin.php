<?php

use Illuminate\Support\Facades\Route;
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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

        // logout
        Route::get('logout', 'AuthController@logout')->name('admin.logout');
    });

    Route::middleware('guest:admin')->prefix('admin')->group(function () {
        Route::get('login', 'AuthController@login')->name("admin.login");
        Route::post('login', 'AuthController@postLogin')->name("admin.post.login");
    });
});


