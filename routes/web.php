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
Route::get('hotels', 'HotelsController@all');
Route::get('hotel/{id}', 'HotelsController@find');
Route::match(['get', 'post'], 'hotel', 'HotelsController@create');
Route::match(['get', 'post'], 'hotel/edit/{id}', 'HotelsController@edit');
Route::get('hotel/delete/{id}', 'HotelsController@delete');

// Services routes
Route::get('services', 'ServicesController@all');
Route::get('service/{id}', 'ServicesController@find');
Route::match(['get', 'post'], 'service', 'ServicesController@create');
Route::match(['get', 'post'], 'service/edit/{id}', 'ServicesController@edit');
Route::get('service/delete/{id}', 'ServicesController@delete');

// Reviews routes
Route::match(['get', 'post'], 'review/hotel/{hotel_id}', 'ReviewsController@create');
Route::get('review/delete/{id}', 'ReviewsController@delete');

// Keywords routes
Route::get('keywords', 'KeywordsController@all');
Route::get('keyword/{id}', 'KeywordsController@find');
Route::match(['get', 'post'], 'keyword', 'KeywordsController@create');
Route::match(['get', 'post'], 'keyword/edit/{id}', 'KeywordsController@edit');
Route::get('keyword/delete/{id}', 'KeywordsController@delete');

// Rueles routes
Route::get('rules', 'RulesController@all');
Route::get('rule/{id}', 'RulesController@find');
Route::match(['get', 'post'], 'rule', 'RulesController@create');
Route::match(['get', 'post'], 'rule/edit/{id}', 'RulesController@edit');
Route::get('rule/delete/{id}', 'RulesController@delete');
