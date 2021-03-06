<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'Api\ApiController@postLogin'); 
Route::get('/logout', 'Api\ApiController@getLogout'); 
Route::resource('/article', 'Api\ArticlesController'); 
