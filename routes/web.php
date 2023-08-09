<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('index');
});

//Route::get('/login', 'HomeController@index');
Route::get('/home', 'HomeController@home');
Route::get('/dt', 'HomeController@dt');



