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

Route::redirect('/','/welcome');
Route::get('/welcome','homecontroller@product');
Route::post('/add_cart','homecontroller@addcart');
Route::get('/welcome/{id}','homecontroller@recart');
Route::post('/transaksi','homecontroller@transaksi');


Auth::routes();

Route::get('/userpage', 'userpagecontroller@index')->name('userpage');
Route::post('/add_pro','userpagecontroller@addpro');
Route::post('/edit_pro','userpagecontroller@edit_pro');
Route::get('/hapus_pro/{id}','userpagecontroller@hapus_pro');