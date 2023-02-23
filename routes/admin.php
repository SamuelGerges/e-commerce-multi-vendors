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

        // ########   settings   #########
        Route::prefix('settings')->group(function () {
            Route::get('shipping-method/{type}', 'SettingController@editShippingMethod')->name('admin.edit.shipping.method');
            Route::put('shipping-method/{id}', 'SettingController@updateShippingMethod')->name('admin.update.shipping.method');
        });
        // ########   end of settings  ############

        //  #######  profiles  ########
        Route::prefix('profiles')->group(function () {
            Route::get('edit', 'ProfileController@edit')->name('admin.edit.profile');
            Route::put('update', 'ProfileController@update')->name('admin.update.profile');
            Route::get('edit-password', 'ProfileController@editPassword')->name('admin.edit.profile.password');
            Route::patch('update-password', 'ProfileController@updatePassword')->name('admin.update.profile.password');
        });
        // #######   end of profiles   ########

        // #######   categories  #######
        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.index.categories');
            Route::get('create', 'CategoryController@create')->name('admin.create.categories');
            Route::post('store', 'CategoryController@store')->name('admin.store.categories');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin.edit.categories');
            Route::put('update/{id}', 'CategoryController@update')->name('admin.update.categories');
            Route::get('delete/{id}', 'CategoryController@delete')->name('admin.delete.categories');
        });
        // #######  end  categories  ######


        // #######  brands  ######
        Route::prefix('brands')->group(function () {
            Route::get('/', 'BrandController@index')->name('admin.index.brands');
            Route::get('create', 'BrandController@create')->name('admin.create.brands');
            Route::post('store', 'BrandController@store')->name('admin.store.brands');
            Route::get('edit/{id}', 'BrandController@edit')->name('admin.edit.brands');
            Route::put('update/{id}', 'BrandController@update')->name('admin.update.brands');
            Route::get('delete/{id}', 'BrandController@delete')->name('admin.delete.brands');
        });
        // #######  end brands  ######

        // #######  tags  ######
        Route::prefix('tags')->group(function () {
            Route::get('/', 'TagController@index')->name('admin.index.tags');
            Route::get('create', 'TagController@create')->name('admin.create.tags');
            Route::post('store', 'TagController@store')->name('admin.store.tags');
            Route::get('edit/{id}', 'TagController@edit')->name('admin.edit.tags');
            Route::put('update/{id}', 'TagController@update')->name('admin.update.tags');
            Route::get('delete/{id}', 'TagController@delete')->name('admin.delete.tags');
        });
        // #######  end tags  ######

        // logout
        Route::get('logout', 'AuthController@logout')->name('admin.logout');
    });

    Route::middleware('guest:admin')->prefix('admin')->group(function () {
        Route::get('login', 'AuthController@showLogin')->name("admin.login");
        Route::post('login', 'AuthController@login')->name("admin.post.login");
    });
});


