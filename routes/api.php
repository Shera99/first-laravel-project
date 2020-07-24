<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    $methods = ['index', 'destroy', 'show', 'update'];

    Route::resource('post','PostController')
        ->only($methods)
        ->names('api.post');

    Route::resource('category','CategoryController')
        ->only($methods)
        ->names('api.category');
});

Route::group(['namespace' => 'Api', 'prefix' => '/post'], function () {
    Route::post('/', 'PostController@postStore')->name('api.post.store');
});

Route::group(['namespace' => 'Api', 'prefix' => '/category'], function () {
    Route::put('/{category}', 'CategoryController@categoryUpdate')->where(['post' => '[0-9+]'])->name('api.category.update');
    Route::post('/', 'CategoryController@categoryStore')->name('api.category.store');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
