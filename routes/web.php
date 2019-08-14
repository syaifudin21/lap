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


Route::get('/', 'TagihanController@home')->name('tagihan.home');
Route::post('/tagihan', 'TagihanController@store')->name('tagihan.store');
Route::get('/tagihan/lunasi', 'TagihanController@lunasi')->name('tagihan.lunasi');

Route::get('/error', function () {
    return view('error');
})->name('error');
Route::get('/success', function () {
    return view('success');
})->name('success');
