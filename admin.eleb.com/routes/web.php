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

Route::get('/', function () {
    return view('welcome');
});

Route::domain('admin.eleb.test')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::resource('shop_categories','ShopCategoryController');

        //文件上传
        Route::post('/upload','ShopCategoryController@upload')->name('upload');
    });

});

