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



Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('login', 'Auth\LoginController@showLoginForm');
	Route::post('login', 'Auth\LoginController@login')->name('adminlogin');;
	Route::get('register', 'Auth\RegisterController@showRegistrationForm');
	Route::post('register', 'Auth\RegisterController@register');
	Route::post('logout', 'Auth\LoginController@logout')->name('adminlogout');
});



Route::group(['middleware' => 'web'], function () {
    Auth::routes();
});

Route::group(['middleware' => ['web', 'auth:web']], function () {
	Route::get('/', function () {
	    return view('welcome');
	});
	Route::get('home', 'HomeController@index');
});

Route::group(['middleware' => ['web', 'auth.admin:admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('/', 'AdminController@index');

});
