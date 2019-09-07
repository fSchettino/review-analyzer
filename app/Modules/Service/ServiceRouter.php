<?php

// Service module routes
Route::get('services', 'ServiceController@all');
Route::get('service/{id}', 'ServiceController@find');
Route::match(['get', 'post'], 'service', 'ServiceController@create');
Route::match(['get', 'post'], 'service/edit/{id}', 'ServiceController@edit');
Route::get('service/delete/{id}', 'ServiceController@delete');
