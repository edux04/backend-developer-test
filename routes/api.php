<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth routes
Route::post('/register','App\Http\Controllers\Api\AuthController@register');
Route::post('/login','App\Http\Controllers\Api\AuthController@login');
//password forgot and reset routes
Route::post('/password/email','App\Http\Controllers\Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset','App\Http\Controllers\Api\ResetPasswordController@reset');
//Crud resource
route::apiResource('users','App\Http\Controllers\Api\UserCrudController')->middleware('auth:api');