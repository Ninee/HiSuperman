<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'tools'], function () {
    Route::get('/image_generator', function () {
       return view('tools.image_generator');
    });
});

Route::get('/convenience/{city?}/{category?}', 'ConvenienceController@index')->name('convenience.index')->where(['city' => '[0-9]+', 'category' => '[0-9]+']);
Route::get('/convenience/share/{info_id}', 'ConvenienceController@share')->name('convenience.share');
Route::get('/convenience/detail/{info_id}', 'ConvenienceController@detail')->name('convenience.detail');