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


        //  #######  profiles  ########
        Route::prefix('profiles')->group(function () {
            Route::get('edit', 'ProfileController@edit')->name('admin.edit.profile');
            Route::put('update', 'ProfileController@update')->name('admin.update.profile');
            Route::get('edit-password', 'ProfileController@editPassword')->name('admin.edit.profile.password');
            Route::patch('update-password', 'ProfileController@updatePassword')->name('admin.update.profile.password');
        });
        // #######   end of profiles   ########

        // #######   categories  #######
        Route::prefix('categories')->middleware('can:categories')->group(function () {
            Route::get('/', 'CategoryController@index')->name('admin.index.categories');
            Route::get('create', 'CategoryController@create')->name('admin.create.categories');
            Route::post('store', 'CategoryController@store')->name('admin.store.categories');
            Route::get('edit/{id}', 'CategoryController@edit')->name('admin.edit.categories');
            Route::put('update/{id}', 'CategoryController@update')->name('admin.update.categories');
            Route::get('delete/{id}', 'CategoryController@delete')->name('admin.delete.categories');
        });
        // #######  end  categories  ######


        // #######  brands  ######
        Route::prefix('brands')->middleware('can:brands')->group(function () {
            Route::get('/', 'BrandController@index')->name('admin.index.brands');
            Route::get('create', 'BrandController@create')->name('admin.create.brands');
            Route::post('store', 'BrandController@store')->name('admin.store.brands');
            Route::get('edit/{id}', 'BrandController@edit')->name('admin.edit.brands');
            Route::put('update/{id}', 'BrandController@update')->name('admin.update.brands');
            Route::get('delete/{id}', 'BrandController@delete')->name('admin.delete.brands');
        });
        // #######  end brands  ######

        // #######  tags  ######
        Route::prefix('tags')->middleware('can:tags')->group(function () {
            Route::get('/', 'TagController@index')->name('admin.index.tags');
            Route::get('create', 'TagController@create')->name('admin.create.tags');
            Route::post('store', 'TagController@store')->name('admin.store.tags');
            Route::get('edit/{id}', 'TagController@edit')->name('admin.edit.tags');
            Route::put('update/{id}', 'TagController@update')->name('admin.update.tags');
            Route::get('delete/{id}', 'TagController@delete')->name('admin.delete.tags');
        });
        // #######  end tags  ######

        // #######  products  ######
        Route::prefix('products')->middleware('can:products')->group(function () {
            Route::get('/', 'ProductController@index')->name('admin.index.products');
            Route::get('general-information', 'ProductController@create')->name('admin.general.create.products');
            Route::post('store-general-information', 'ProductController@store')->name('admin.general.store.products');
            Route::get('edit-general-information/{id}', 'ProductController@edit')->name('admin.general.edit.products');
            Route::put('update-general-information/{id}', 'ProductController@update')->name('admin.general.update.products');
            Route::get('delete-general-information/{id}', 'ProductController@delete')->name('admin.general.delete.products');

            // price
            Route::get('price/{id}', 'ProductController@getPrice')->name('admin.price.create.products');
            Route::patch('price/{id}', 'ProductController@updatePrice')->name('admin.price.update.products');

            // stock
            Route::get('stock/{id}', 'ProductController@getStock')->name('admin.stock.create.products');
            Route::patch('stock/{id}', 'ProductController@updateStock')->name('admin.stock.update.products');

            // images
            Route::get('image/{id}', 'ImageController@addImages')->name('admin.images.create.products');
            Route::post('image', 'ImageController@saveProductImages')->name('admin.images.update.products');
            Route::post('save-image', 'ImageController@updateImages')->name('admin.save.images.update.products');
        });
        // #######  end products  ######

        // #######  attributes  ######
        Route::prefix('attributes')->middleware('can:attributes')->group(function () {
            Route::get('/', 'AttributeController@index')->name('admin.index.attributes');
            Route::get('create', 'AttributeController@create')->name('admin.create.attributes');
            Route::post('store', 'AttributeController@store')->name('admin.store.attributes');
            Route::get('edit/{id}', 'AttributeController@edit')->name('admin.edit.attributes');
            Route::put('update/{id}', 'AttributeController@update')->name('admin.update.attributes');
            Route::get('delete/{id}', 'AttributeController@delete')->name('admin.delete.attributes');
        });
        // #######  end attributes  ######

        // #######  options  ######
        Route::prefix('options')->middleware('can:options')->group(function () {
            Route::get('/', 'OptionController@index')->name('admin.index.options');
            Route::get('create', 'OptionController@create')->name('admin.create.options');
            Route::post('store', 'OptionController@store')->name('admin.store.options');
            Route::get('edit/{id}', 'OptionController@edit')->name('admin.edit.options');
            Route::put('update/{id}', 'OptionController@update')->name('admin.update.options');
            Route::get('delete/{id}', 'OptionController@delete')->name('admin.delete.options');
        });
        // #######  end options  ######

        // #######  sliders  ######
        Route::prefix('sliders')->group(function () {
            Route::get('/', 'SliderController@index')->name('admin.index.sliders');
            Route::get('create', 'SliderController@create')->name('admin.create.sliders');
            Route::post('slider', 'SliderController@saveSliderImages')->name('admin.save.sliders');
            Route::post('store/db', 'SliderController@store')->name('admin.store.sliders');
//            Route::get('edit/{id}', 'SliderController@edit')->name('admin.edit.sliders');
//            Route::put('update/{id}', 'SliderController@update')->name('admin.update.sliders');
            Route::get('delete/{id}', 'SliderController@delete')->name('admin.delete.sliders');
        });
        // #######  end sliders  ######


        // #######  roles  ######
        Route::prefix('roles')->middleware('can:roles')->group(function () {
            Route::get('/', 'RoleController@index')->name('admin.index.roles');
            Route::get('create', 'RoleController@create')->name('admin.create.roles');
            Route::post('store', 'RoleController@store')->name('admin.store.roles');
            Route::get('edit/{id}', 'RoleController@edit')->name('admin.edit.roles');
            Route::post('update/{id}', 'RoleController@update')->name('admin.update.roles');
            Route::get('delete/{id}', 'RoleController@delete')->name('admin.delete.roles');
        });
        // #######  end roles  ######

        //  admins Routes

        Route::group(['prefix' => 'users' , 'middleware' => 'can:users'], function () {
            Route::get('/', 'UserController@index')->name('admin.index.users');
            Route::get('/create', 'UserController@create')->name('admin.create.users');
            Route::post('/store', 'UserController@store')->name('admin.store.users');
        });

        //  admins Routes

        // ########   settings   #########
        Route::prefix('settings')->group(function () {
            Route::get('shipping-method/{type}', 'SettingController@editShippingMethod')->name('admin.edit.shipping.method');
            Route::put('shipping-method/{id}', 'SettingController@updateShippingMethod')->name('admin.update.shipping.method');
        });
        // ########   end of settings  ############

        // logout
        Route::get('logout', 'AuthController@logout')->name('admin.logout');
    });

    Route::middleware('guest:admin')->prefix('admin')->group(function () {
        Route::get('login', 'AuthController@showLogin')->name("admin.login");
        Route::post('login', 'AuthController@login')->name("admin.post.login");
    });
});


