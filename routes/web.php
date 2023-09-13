<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', 'LoginController@index');
Route::get('/register', 'RegisterController@index');
Route::post('/register', 'RegisterController@store');

//Route::get('/login', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::get('/dt', 'HomeController@dt');



