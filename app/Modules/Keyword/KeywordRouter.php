<?php

// Keyword module routes
Route::get('keywords', 'KeywordController@all');
Route::get('keyword/{id}', 'KeywordController@find');
Route::match(['get', 'post'], 'keyword', 'KeywordController@create');
Route::match(['get', 'post'], 'keyword/edit/{id}', 'KeywordController@edit');
Route::get('keyword/delete/{id}', 'KeywordController@delete');
