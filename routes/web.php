<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/wagons', 'WagonsController@index');
Route::post('/wagons', 'WagonsController@store');

Route::get('/home', 'HomeController@index')->name('home');
