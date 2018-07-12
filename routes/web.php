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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/create-url', 'UrlsController@create')->name('create-url');
Route::get('/urls', 'UrlsController@index')->name('urls');
Route::get('/url/{id}', 'UrlsController@show')->name('url-show');
Route::post('/store-url', 'UrlsController@store')->name('store-url');

Route::get('/z/{short}', 'UrlsController@short')->name('short-url');
