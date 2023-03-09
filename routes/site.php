<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    route::get('/', 'HomeController@home')->name('home')->middleware('verifyCode');
    route::get('category/{slug}', 'CategoryController@productsBySlug')->name('category');
    route::get('product/{slug}', 'ProductController@productsBySlug')->name('product.details');



    // Cart routes
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@getIndex')->name('site.cart.index');
        Route::post('/cart/add/{slug?}', 'CartController@postAdd')->name('site.cart.add');
        Route::post('/update/{slug}', 'CartController@postUpdate')->name('site.cart.update');
        Route::post('/update-all', 'CartController@postUpdateAll')->name('site.cart.update-all');
    });


    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', function () {
            return "<h1>You Are Authenticated</h1>";
        });

        // verification code
        Route::get('verify', 'VerificationCodeController@getVerifyPage')->name('get.verification.form');
        Route::post('user-verify', 'VerificationCodeController@verify')->name('user-verify');

        // reviews
        Route::get('products/{productId}/reviews', 'ProductReviewController@index')->name('products.reviews.index');
        Route::post('products/{productId}/reviews', 'ProductReviewController@store')->name('products.reviews.store');

        // payment
        Route::get('payment/{amount}', 'PaymentController@getPayments') -> name('payment');
        Route::post('payment', 'PaymentController@processPayment') -> name('payment.process');


        // wishlist
        Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
        Route::delete('wishlist', 'WishlistController@destroy')->name('wishlist.destroy');
        Route::get('wishlist/products', 'WishlistController@index')->name('wishlist.products.index');
    });


});

