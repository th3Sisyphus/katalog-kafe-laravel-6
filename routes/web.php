<?php

use App\Http\Controllers\PageController;

Route::get('/', 'PageController@home');

Route::get('/addmenu','PageController@addmenu');
Route::post('/addmenu/save','PageController@saveMenu');

Route::get('/editmenu/{id}','PageController@editMenu');
Route::put('/editmenu/save/{id}','PageController@updateMenu');

Route::get('/deletemenu/{id}','PageController@deleteMenu');