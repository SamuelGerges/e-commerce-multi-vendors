<?php

use Illuminate\Support\Facades\Route;

// note that the prefix is admin for all file route


Route::middleware('auth:admin')->group(function () {
    // TODO :: first page admin visited if authenticated
    Route::get('/', 'HomeController@index')->name('admin.home');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', 'AuthController@login')->name("admin.login");
    Route::post('login', 'AuthController@postLogin')->name("admin.post.login");
});



