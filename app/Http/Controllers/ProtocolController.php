<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Protocol;

class ProtocolController extends Controller
{
    public function show(){
    	$request = Input::all();
    	$protocolos = Protocol::where('id_responsable',$request["id"])->get();
    	return view('viewProtocol',['protocols' => $protocolos] );
    }	

    public function exec_protocol($id){
    	//$endpoint = "https://trabajo-practico-integrador.herokuapp.com/api/services/run/".$id;
//		$client = new \GuzzleHttp\Client();

    	$protocolos = Protocol::all();
		return view('viewProtocols',['protocols' => $protocolos, 'id' => $id] );

		//$response = $client->request('GET', $endpoint, ['query' => [
		//    'key1' => $id, 
		//    'key2' => $value,
		//]]);

		// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

		//$statusCode = $response->getStatusCode();
		//$content = $response->getBody();

		// or when your server returns json
		// $content = json_decode($response->getBody(), true);
    	#return view('viewProtocol',['protocols' => $protocolos] );
    }
}
