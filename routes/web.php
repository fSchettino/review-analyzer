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

// Home page route
Route::View('/', 'index');

// Hotels routes
Route::get('hotels', 'HotelsController@index');
Route::get('hotel/{id}', 'HotelsController@show');
Route::match(['get', 'post'], 'hotel', 'HotelsController@add');
Route::put('hotel/{id}', 'HotelsController@put');
Route::delete('hotel/{id}', 'HotelsController@delete');

// Services routes
Route::get('services', 'ServicesController@index');
Route::get('service/{id}', 'ServicesController@show');
Route::match(['get', 'post'], 'service', 'ServicesController@add');
Route::put('service/{id}', 'ServicesController@put');
Route::delete('service/{id}', 'ServicesController@delete');

// Whitelist routes
Route::get('whitelist', 'WhitelistController@index');
Route::get('whitelistKey/{id}', 'WhitelistController@show');
Route::match(['get', 'post'], 'whitelistKey', 'WhitelistController@add');
Route::put('whitelistKey/{id}', 'WhitelistController@put');
Route::delete('whitelistKey/{id}', 'WhitelistController@delete');

// Blacklist routes
Route::get('blacklist', 'BlacklistController@index');
Route::get('blacklistKey/{id}', 'BlacklistController@show');
Route::match(['get', 'post'], 'blacklistKey', 'BlacklistController@add');
Route::put('blacklistKey/{id}', 'BlacklistController@put');
Route::delete('blacklistKey/{id}', 'BlacklistController@delete');
