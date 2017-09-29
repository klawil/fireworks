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

  /**** USER LICENSE RESOURCE ****/
  Route::get('/user/{user}/license/create', 'LicenseController@create')->name('user.license.create');
  Route::post('/user/{user}/license', 'LicenseController@store')->name('user.license.store');
  Route::resource('license', 'LicenseController', [
    'except' => ['create', 'store', 'index'],
    'names' => [
      'show' => 'user.license.show',
      'edit' => 'user.license.edit',
      'update' => 'user.license.update',
      'destroy' => 'user.license.destroy',
    ],
  ]);

  /**** SHOW RESOURCE ****/
  Route::resource('show', 'ShowController');

  /**** SHOW USER RESOURCE ****/
  Route::get('/show/{show}/user', 'ShowUserController@index')->name('show.user.index');
  Route::get('/show/{show}/user/create', 'ShowUserController@create')->name('show.user.create');
  Route::post('/show/{show}/user', 'ShowUserController@store')->name('show.user.store');
  Route::get('/show/{show}/user/{user}/edit', 'ShowUserController@edit')->name('show.user.edit');
  Route::put('/show/{show}/user/{user}', 'ShowUserController@update')->name('show.user.update');
  Route::delete('/show/{show}/user/{user}', 'ShowUserController@destroy')->name('show.user.destroy');

  /**** SHOW FILE RESOURCE ****/
  Route::get('/show/{show}/file', 'ShowFileController@index')->name('show.file.index');
  Route::get('/show/{show}/file/create', 'ShowFileController@create')->name('show.file.create');
  Route::post('/show/{show}/file', 'ShowFileController@store')->name('show.file.store');
  Route::get('/show/{show}/file/{file}/edit', 'ShowFileController@edit')->name('show.file.edit');
  Route::put('/show/{show}/file/{file}', 'ShowFileController@update')->name('show.file.update');
  Route::delete('/show/{show}/file/{file}', 'ShowFileController@destroy')->name('show.file.destroy');

  /**** FILE RESOURCE ****/
  Route::resource('file', 'FileController', [
    'only' => ['show']
  ]);
});
