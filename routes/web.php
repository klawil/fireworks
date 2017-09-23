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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('show', 'ShowController');
Route::get('/show/{show}/upload', 'ShowController@uploadForm')->name('show.upload');
Route::post('/show/{show}/upload', 'ShowController@upload');

Route::resource('file', 'FileController');
