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
  Route::resource('show', 'ShowController');

  /**** SHOW USER RESOURCE ****/
  Route::get('/show/{show}/user/create', 'ShowUserController@create')->name('show.user.create');
  Route::post('/show/{show}/user', 'ShowUserController@store')->name('show.user.store');
  Route::get('/show/{show}/user/{user}/edit', 'ShowUserController@edit')->name('show.user.edit');
  Route::put('/show/{show}/user/{user}', 'ShowUserController@update')->name('show.user.update');
  Route::delete('/show/{show}/user/{user}', 'ShowUserController@destroy')->name('show.user.destroy');

  /**** FILE RESOURCE ****/
  Route::resource('file', 'FileController', [
    'only' => ['show']
  ]);
});
