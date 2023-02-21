<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Setting;

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
//Route::get('test', function () {
//    return Setting::all();
//});


Route::get('test', function () {
    $category = Category::first();
    $category->makeVisible('translations');
    return $category;
});

