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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/logout','Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*User realted routes*/
Route::get('/user', 'UserController@index')->name('user.index');
Route::post('/user', 'UserController@store')->name('user.store');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::patch('/user/edit/{id}', 'UserController@update')->name('user.update');

/*Category related routes*/
Route::get('/category', 'CategoryController@index')->name('category.index');
Route::post('/category', 'CategoryController@store')->name('category.store');
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
Route::patch('/category/edit/{id}', 'CategoryController@update')->name('category.update');

/*Menu related routes*/
Route::get('/menu', 'MenuController@index')->name('menu.index');
Route::post('/menu', 'MenuController@store')->name('menu.store');
Route::get('/menu/edit/{id}', 'MenuController@edit')->name('menu.edit');
Route::patch('/menu/edit/{id}', 'MenuController@update')->name('menu.update');

/*Stock  related routes*/
Route::get('/stock', 'StockController@index')->name('stock.index');
Route::post('/stock', 'StockController@store')->name('stock.store');