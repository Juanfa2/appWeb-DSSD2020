<?php

use App\User;
use App\Proyect;
use App\Protocol;
use App\HTTP\Controllers\ProtocolController;

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

//con esta ruta el logout siempre te lleva al loguin evitando el cartel de laravel,
//si deciden que lleve a ese cartel, que para mi no corresponde, usen el get de abajo.
Route::get('/','HomeController@index')->name('home');

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/prueba', 'HomeController@enviar');
Route::get('/recibir', 'HomeController@recibir');

Route::get('create', function(){
    $responsables = User::where('rol', 'Responsable')->pluck('name', 'id');
	return view('createProyect', ['responsables' => $responsables]);
})->middleware('jefe');

Route::get('viewProtocols', function(){
    $protocols = ProtocolController::getProtocols();
    return view('viewProtocols',  ['protocols' => $protocols]);
})->name('viewProtocols')->middleware('responsable');

Route::get('followProyects', function(){
   	$proyects = Proyect::all();
	return view('followProyect',  ['proyects' => $proyects]);
})->middleware('jefe');

Route::get('errorsNotice', function(){
   	$protocols = ProtocolController::getDisapproved();
	return view('errorsNotice',  ['protocols' => $protocols]);
})->name('errorsNotice')->middleware('jefe');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/proyect/store', 'ProyectController@store')->name('proyect.store')->middleware('jefe');
Route::get('/protocol/exec/{id}', 'ProtocolController@exec_protocol')->name('protocol.exec_protocol')->middleware('responsable');

Route::get('/protocol/re-exec/{id}', 'ProtocolController@re_exec_protocol')->name('protocol.re_exec_protocol')->middleware('jefe');

Route::get('/protocol/delete/{id}', 'ProtocolController@delete_protocol')->name('protocol.delete_protocol')->middleware('jefe');

Route::get('/protocol/continue/{id}', 'ProtocolController@continue_exec_protocol')->name('protocol.continue_exec_protocol')->middleware('jefe');
