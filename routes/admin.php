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

        // #######  main categories  #######
        Route::prefix('main_categories')->group(function () {
            Route::get('/', 'MainCategoriesController@index')->name('admin.index.categories');
            Route::get('create', 'MainCategoriesController@create')->name('admin.create.categories');
            Route::post('store', 'MainCategoriesController@store')->name('admin.store.categories');
            Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.edit.categories');
            Route::put('update/{id}', 'MainCategoriesController@update')->name('admin.update.categories');
            Route::get('delete/{id}', 'MainCategoriesController@delete')->name('admin.delete.categories');
        });
        // #######  end main categories  ######

        // #######  sub categories  #######
        Route::prefix('sub_categories')->group(function () {
            Route::get('/', 'SubCategoriesController@index')->name('admin.index.subCategories');
            Route::get('create', 'SubCategoriesController@create')->name('admin.create.subCategories');
            Route::post('store', 'SubCategoriesController@store')->name('admin.store.subCategories');
            Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.edit.subCategories');
            Route::put('update/{id}', 'SubCategoriesController@update')->name('admin.update.subCategories');
            Route::get('delete/{id}', 'SubCategoriesController@delete')->name('admin.delete.subCategories');
        });
        // #######  end sub categories  ######

        // logout
        Route::get('logout', 'AuthController@logout')->name('admin.logout');
    });

    Route::middleware('guest:admin')->prefix('admin')->group(function () {
        Route::get('login', 'AuthController@showLogin')->name("admin.login");
        Route::post('login', 'AuthController@login')->name("admin.post.login");
    });
});


