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
Route::get('hotels', 'HotelController@all');
Route::get('hotel/{id}', 'HotelController@find');
Route::match(['get', 'post'], 'hotel', 'HotelController@create');
Route::match(['get', 'post'], 'hotel/edit/{id}', 'HotelController@edit');
Route::get('hotel/delete/{id}', 'HotelController@delete');

// Services routes
Route::get('services', 'ServiceController@all');
Route::get('service/{id}', 'ServiceController@find');
Route::match(['get', 'post'], 'service', 'ServiceController@create');
Route::match(['get', 'post'], 'service/edit/{id}', 'ServiceController@edit');
Route::get('service/delete/{id}', 'ServiceController@delete');

// Reviews routes
Route::match(['get', 'post'], 'review/hotel/{hotel_id}', 'ReviewController@create');
Route::get('review/delete/{id}', 'ReviewController@delete');

// Keywords routes
Route::get('keywords', 'KeywordController@all');
Route::get('keyword/{id}', 'KeywordController@find');
Route::match(['get', 'post'], 'keyword', 'KeywordController@create');
Route::match(['get', 'post'], 'keyword/edit/{id}', 'KeywordController@edit');
Route::get('keyword/delete/{id}', 'KeywordController@delete');

// Rueles routes
Route::get('rules', 'RuleController@all');
Route::get('rule/{id}', 'RuleController@find');
Route::match(['get', 'post'], 'rule', 'RuleController@create');
Route::match(['get', 'post'], 'rule/edit/{id}', 'RuleController@edit');
Route::get('rule/delete/{id}', 'RuleController@delete');
