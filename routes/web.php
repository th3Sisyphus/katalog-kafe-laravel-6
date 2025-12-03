<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/home', 'PageController@home');
    Route::get('/addmenu','PageController@addmenu');
    Route::post('/addmenu/save','PageController@saveMenu');
    Route::get('/editmenu/{id}','PageController@editMenu');
    Route::put('/editmenu/save/{id}','PageController@updateMenu');
    Route::get('/deletemenu/{id}','PageController@deleteMenu');
    Route::get('/users','PageController@users');
    Route::get('/users/addUser','PageController@addUserForm');
    Route::post('/users/save','PageController@saveAddUser');
    Route::get('/users/delete/{id}','PageController@deleteUser');

    Route::get('/logout', 'AuthController@logout');

    Route::get('/changepassword', 'PageController@changePassForm');
    Route::put('/changepassword/verify', 'AuthController@saveNewPass');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'VisitorController@home'); // endpoint utama web
    
    Route::get('/login33231244', 'PageController@loginPage')->name('login');
    Route::post('/login33231244', 'AuthController@login');
});