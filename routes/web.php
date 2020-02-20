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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/PanelDeControl', 'HomeController@index')->name('PanelDeControl');

Route::get('/superusers/filter', 'SuperuserController@filter');
Route::resource('superusers', 'SuperuserController');

Route::get('/deliverers/filter', 'DelivererController@filter');
Route::resource('deliverers', 'DelivererController');

Route::get('/consumers/filter', 'ConsumerController@filter');
Route::resource('consumers', 'ConsumerController');

Route::get('/businesses/filter', 'BusinessController@filter');
Route::resource('businesses', 'BusinessController');

Route::get('/orders/filter', 'OrderController@filter');
Route::resource('orders', 'OrderController');

Route::get('/menus/filter', 'MenuController@filter');
Route::resource('menus', 'MenuController');

Route::get('/items/filter', 'ItemController@filter');
Route::resource('items', 'ItemController');

Route::get('/categories/filter', 'CategoryController@filter');
Route::resource('categories', 'CategoryController');
