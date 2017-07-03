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

Route::get('/','NavigationController@index')->name('index');
Route::get('login/twitter', 'Auth\LoginController@redirectToProvider');
Route::get('login/twitter/return', 'Auth\LoginController@handleProviderCallback');
Route::get('twitter/followers','NavigationController@followers');
Route::get('twitter/following','NavigationController@following');
Route::get('twitter/logout','NavigationController@logout');
