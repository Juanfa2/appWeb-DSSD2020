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

Route::get('create', function(){
	return view('createProyect');
})->middleware('jefe');


Route::get('viewProtocols', function(){
	return view('viewProtocol');
})->middleware('responsable');

Route::get('followProyects', function(){
	return view('followProyect');
})->middleware('jefe');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
