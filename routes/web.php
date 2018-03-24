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

//Dashboard Related Routed
Route::get('/', 'HomeController@index')->name('home');
Route::get('/checkoutTable/{id}', 'HomeController@checkoutTable')->name('checkoutTable');
Route::get('/editorder/{id}', 'HomeController@editOrder')->name('editorder');
Route::get('/deleteOrder/{id}', 'HomeController@deleteOrder')->name('deleteOrder');

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

/*Table Related routes*/
Route::get('/table', 'TableController@index')->name('table.index');
Route::post('/table', 'TableController@store')->name('table.store');
Route::get('/table/edit/{id}', 'TableController@edit')->name('table.edit');
Route::patch('/table/edit/{id}', 'TableController@update')->name('table.update');

/*Report related routes*/
Route::get('/report', 'RecordController@index')->name('record.index');
Route::post('/search', 'RecordController@search')->name('record.search');
Route::get('/stockreport', 'StockController@report')->name('stock.report');
Route::post('/stocksearch', 'StockController@search')->name('stock.search');


/*Print From thermal printer*/
Route::get('/print', 'PrintController@printTest')->name('print');

