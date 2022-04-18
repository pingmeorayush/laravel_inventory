<?php

use Illuminate\Support\Facades\Route;

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


Route::delete('/category/delete-all/', "CategoryController@destroy")->name("delete-category");
Route::resource('category', CategoryController::class);
Route::delete('/product/delete-all', "ProductController@destroy")->name("delete-product");
Route::resource('product', ProductController::class);