<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('/groups', 'Backend\GroupsController');
	Route::resource('/users', 'Backend\UsersController');
	Route::resource('/news', 'Backend\NewsController');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
