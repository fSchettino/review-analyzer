<?php

// Rule module routes
Route::get('rules', 'RuleController@all');
Route::get('rule/{id}', 'RuleController@find');
Route::match(['get', 'post'], 'rule', 'RuleController@create');
Route::match(['get', 'post'], 'rule/edit/{id}', 'RuleController@edit');
Route::get('rule/delete/{id}', 'RuleController@delete');
