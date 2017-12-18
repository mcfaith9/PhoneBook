<?php

Route::get('/', 'PhoneBookController@view');
Route::get('/state', 'PhoneBookController@getStates');
Route::get('/cities', 'PhoneBookController@getCities');
Route::post('/submit','PhoneBookController@submit');