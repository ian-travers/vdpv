<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', 'InfoController@index')->name('root');
Route::get('/view/{wagon}', 'InfoController@showWagon')->name('show-wagon');
Route::get('/detained-by/{detainer}', 'InfoController@detainedBy')->name('detained-by');
Route::get('/detained-by/{detainer}/long', 'InfoController@detainedByLong')->name('detained-by-long');
Route::get('/recent/{day}/{type}', 'InfoController@recent')->name('recent');
Route::get('/long-only', 'InfoController@longOnly')->name('long-only');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/wagons', 'WagonsController@index')->name('wagons.index');
    Route::get('/wagons/create', 'WagonsController@create')->name('wagons.create');
    Route::get('/wagons/{wagon}', 'WagonsController@show')->name('wagons.show');
    Route::get('/wagons/{wagon}/edit', 'WagonsController@edit')->name('wagons.edit');
    Route::patch('/wagons/{wagon}', 'WagonsController@update')->name('wagons.update');
    Route::post('/wagons', 'WagonsController@store')->name('wagons.store');
    Route::delete('/wagons/{wagon}', 'WagonsController@destroy')->name('wagons.destroy');

    Route::get('/home', 'HomeController@index')->name('home');
});


