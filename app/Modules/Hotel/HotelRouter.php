<?php

// Hotel module routes
Route::get('hotels', 'HotelController@all');
Route::get('hotel/{id}', 'HotelController@find');
Route::match(['get', 'post'], 'hotel', 'HotelController@create');
Route::match(['get', 'post'], 'hotel/edit/{id}', 'HotelController@edit');
Route::get('hotel/delete/{id}', 'HotelController@delete');
