<?php

use Illuminate\Support\Facades\Route;




// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@store');
Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@store');

//Route::get('/login', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::get('/dt', 'HomeController@dt');

Route::get('/master-barang', 'MasterBarangController@index');
Route::post('/insertBarang', 'MasterBarangController@insertBarang');
Route::post('/getData', 'MasterBarangController@getData');

Route::get('/master-member', 'MasterMemberController@index');
Route::post('/insertMember', 'MasterMemberController@insertMember');
Route::post('/getDataMember', 'MasterMemberController@getDataMember');

Route::get('/cart', 'CartController@index');
Route::post('/getBarang', 'CartController@getBarang');
Route::post('/getDataCart', 'CartController@getDataCart');
Route::post('/insertBarangCart', 'CartController@insertBarangCart');
Route::post('/deleteBarang', 'CartController@deleteBarang');