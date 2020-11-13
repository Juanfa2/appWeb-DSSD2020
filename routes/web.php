<?php

use App\User;
use App\Proyect;

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
    $responsables = User::where('rol', 'Responsable')->pluck('name', 'id');
	return view('createProyect', ['responsables' => $responsables]);
});


Route::get('viewProtocols', function(){
	return view('viewProtocol');
});

Route::get('followProyects', function(){
    $proyects = Proyect::all();
	return view('followProyect',  ['proyects' => $proyects]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/proyect/store', 'ProyectController@store')->name('proyect.store');
