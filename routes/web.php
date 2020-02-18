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

Route::resource('businesses', 'BusinessController');
Route::resource('orders', 'OrderController');
Route::resource('menus', 'MenuController');

Route::get('/items/filter', 'ItemController@filter');
Route::resource('items', 'ItemController');

Route::resource('categories', 'CategoryController');
