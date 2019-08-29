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
Route::match(['get', 'post'], 'hotel/edit/{id}', 'HotelsController@edit');
Route::get('hotel/delete/{id}', 'HotelsController@delete');

// Services routes
Route::get('services', 'ServicesController@index');
Route::get('service/{id}', 'ServicesController@show');
Route::match(['get', 'post'], 'service', 'ServicesController@add');
Route::match(['get', 'post'], 'service/edit/{id}', 'ServicesController@edit');
Route::get('service/delete/{id}', 'ServicesController@delete');

// Whitelist routes
Route::get('whitelist', 'WhitelistController@index');
Route::get('whitelistKey/{id}', 'WhitelistController@show');
Route::match(['get', 'post'], 'whitelistKey', 'WhitelistController@add');
Route::match(['get', 'post'], 'whitelistKey/edit/{id}', 'WhitelistController@edit');
Route::get('whitelistKey/delete/{id}', 'WhitelistController@delete');

// Blacklist routes
Route::get('blacklist', 'BlacklistController@index');
Route::get('blacklistKey/{id}', 'BlacklistController@show');
Route::match(['get', 'post'], 'blacklistKey', 'BlacklistController@add');
Route::match(['get', 'post'], 'blacklistKey/edit/{id}', 'BlacklistController@edit');
Route::get('blacklistKey/delete/{id}', 'BlacklistController@delete');
