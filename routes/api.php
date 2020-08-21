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
//cart route
Route::group(['prefix'=>'/carts'],function(){	
		Route::get('/','Api\CartModelController@index')->name('carts');
		Route::post('/store','Api\CartModelController@store')->name('carts.store');
		Route::post('/update/{id}','Api\CartModelController@update')->name('carts.update');
		Route::post('/delete/{id}','Api\CartModelController@delete')->name('carts.delete');
	});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
