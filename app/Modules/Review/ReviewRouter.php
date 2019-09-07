<?php

// Review module routes
Route::match(['get', 'post'], 'review/hotel/{hotel_id}', 'ReviewController@create');
Route::get('review/delete/{id}', 'ReviewController@delete');
