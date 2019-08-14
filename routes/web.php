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
Route::get('/tagihan/status', 'TagihanController@status')->name('tagihan.status');
Route::get('/tagihan/reversal', 'TagihanController@reversal')->name('tagihan.reversal');
Route::get('/tagihan/enabled', 'TagihanController@enabled')->name('tagihan.enabled');
Route::get('/tagihan/disabled', 'TagihanController@reversal')->name('tagihan.reversal');

Route::get('/error', function () {
    dd($_GET);
})->name('error');
Route::get('/success', function () {
    // jika memasukkan pin pada pembayaran berhasil maka akan menyimpan
    if (isset($_GET['src']) && isset($_GET['trxId'])) {
        $tagihan = Tagihan::where('no_trx',$_GET['trxId'])->first();
        $tagihan['refNum'] = $_GET['refNum'];
        $tagihan['src'] = $_GET['src'];
        $tagihan->save();
    }

    dd($_GET);
    
})->name('success');
