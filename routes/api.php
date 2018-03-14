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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Login
Route::post('/login','APIController@login');
Route::get('/tables','APIController@getTables');
Route::get('/menus', 'APIController@getMenus');
Route::get('/categories', 'APIController@getCategories');

Route::post('/order', 'APIController@postOrder');
Route::post('/checkout', 'APIController@postCheckout');