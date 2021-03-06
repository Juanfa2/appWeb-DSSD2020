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
	//$protocols = Protocol::where('informe', 0)->where('exec_error', 0)->orderBy('orden', 'ASC')->first();
	//dd($protocols);
    //$protocols = ProtocolController::getProtocols();
    $proyectos = Proyect::join('protocolos', 'proyectos.id_proyecto', '=', 'protocolos.id_proyecto')->where('protocolos.id_responsable',Auth::user()->id)->where('exitoso', 0)->select('proyectos.id_proyecto')->distinct()->get();
    //dd(count($proyectos));
    $protocols = [];
    for ($i=0; $i < count($proyectos) ; $i++) { 
    	$protocolos = Protocol::where('informe', 0)->where('exec_error', 0)->where('id_proyecto', $proyectos[$i]->id_proyecto)->orderBy('orden', 'ASC')->first();

    	array_push($protocols,$protocolos);
    }


    //dd($protocolos);
	//$protocols = Protocol::where('id_responsable', Auth::user()->id)->distinct('id_proyecto')->get();

    return view('viewProtocols',  ['protocols' => $protocols]);
})->name('viewProtocols')->middleware('responsable');




Route::get('followProyects', function(){

	$protocols = Protocol::all();
	$proyects = Proyect::all();
   	//$proyects = ProtocolController::getProtocols();

	return view('followProyect', compact('protocols','proyects') );
})->middleware('jefe');



Route::get('errorsNotice', function(){
   	$protocols = ProtocolController::getDisapproved();
	return view('errorsNotice',  ['protocols' => $protocols]);
})->name('errorsNotice')->middleware('jefe');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/proyect/store', 'ProyectController@store')->name('proyect.store')->middleware('jefe');
Route::get('/protocol/exec/{id}', 'ProtocolController@exec_protocol')->name('protocol.exec_protocol')->middleware('responsable');



#Ante falla de algun protocolo
Route::get('/protocol/re-exec/{id}', 'ProtocolController@re_exec_protocol')->name('protocol.re_exec_protocol')->middleware('jefe');

Route::get('/protocol/delete/{id}', 'ProtocolController@delete_protocol')->name('protocol.delete_protocol')->middleware('jefe');

Route::get('/protocol/continue/{id}', 'ProtocolController@continue_exec_protocol')->name('protocol.continue_exec_protocol')->middleware('jefe');





Route::get('/protocol/informe/{id}' ,'ProtocolController@informe');
Route::post('/protocol/informe' ,'ProtocolController@uploadInforme');

Route::get('/protocol/execute/{id}', 'ProtocolController@execute');
Route::post('/protocol/execute', 'ProtocolController@updateProtocol');


Route::get('viewProtocolsExecute', function(){
	$protocols = Protocol::where('informe', 1)->get();
    //$protocols = ProtocolController::getProtocols();
    return view('viewProtocols',  ['protocols' => $protocols]);
})->name('viewProtocolsExecute')->middleware('responsable');

Route::get('/protocol/detail/{id}', 'ProtocolController@detail');