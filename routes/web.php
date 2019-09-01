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

// Reviews routes
Route::get('reviews/{hotel_id}', 'ReviewsController@index');
Route::get('review/{id}', 'ReviewsController@show');
Route::match(['get', 'post'], 'review/hotel/{hotel_id}', 'ReviewsController@add');
Route::match(['get', 'post'], 'review/edit/{id}', 'ReviewsController@edit');
Route::get('review/delete/{id}', 'ReviewsController@delete');

// Keywords routes
Route::get('keywords', 'KeywordsController@index');
Route::get('keyword/{id}', 'KeywordsController@show');
Route::match(['get', 'post'], 'keyword', 'KeywordsController@add');
Route::match(['get', 'post'], 'keyword/edit/{id}', 'KeywordsController@edit');
Route::get('keyword/delete/{id}', 'KeywordsController@delete');

// Rueles routes
Route::get('rules', 'RulesController@index');
Route::get('rule/{id}', 'RulesController@show');
Route::match(['get', 'post'], 'rule', 'RulesController@add');
Route::match(['get', 'post'], 'rule/edit/{id}', 'RulesController@edit');
Route::get('rule/delete/{id}', 'RulesController@delete');
