<?php

Route::get('/', 'PhoneBookController@view');
Route::get('/state', 'PhoneBookController@getStates');

Route::post('/submit','PhoneBookController@submit');