<?php

use Illuminate\Support\Facades\Route;
//ROUTES FOR TESTING THE API
Route::view('/','index');
Route::view('/users','users');
Route::view('/users/update/','update');
Route::view('/users/register','register');
Route::view('/users/login','login');
Route::view('/password/email','password');
