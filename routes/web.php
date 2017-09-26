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

Route::group([
  'middleware' => ['auth'],
], function() {
  /**** USER RESOURCE ****/
  Route::resource('user', 'UserController');

  /**** SHOW RESOURCE ****/
  Route::get('/show/{show}/upload', 'ShowController@uploadForm')->name('show.upload');
  Route::post('/show/{show}/upload', 'ShowController@upload');
  Route::get('/show/{show}/user', 'ShowController@userCreate')->name('show.user.create');
  Route::post('/show/{show}/user', 'ShowController@userStore')->name('show.user.store');
  Route::resource('show', 'ShowController');

  /**** FILE RESOURCE ****/
  Route::resource('file', 'FileController', [
    'only' => ['show']
  ]);
});
