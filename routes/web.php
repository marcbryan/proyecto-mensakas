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
Route::get('/PanelUsers', 'HomeController@PanelUsers');

//Route::get('/newConsumer'), 'HomeController@newConsumer')->name('newConsumer');

Route::get('/newConsumer', function () {
    return view('newOrder.newConsumer');
});

Route::get('superusers/filter', 'SuperuserController@filter');
Route::resource('superusers', 'SuperuserController');
Route::resource('deliverers', 'DelivererController');
Route::resource('consumers', 'ConsumerController');
Route::resource('businesses', 'BusinessController');
Route::resource('orders', 'OrderController');
Route::resource('menus', 'MenuController');
Route::resource('items', 'ItemController');
Route::resource('categories', 'CategoryController');


