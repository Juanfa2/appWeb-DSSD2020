<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Protocol;
use Illuminate\Routing\Redirector;

class ProtocolController extends Controller
{
    public static function getProtocols(){
        $endpoint = "http://127.0.0.1:8001/api/services/protocol/all";
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
        $content = $response->getBody();

        return json_decode($content, true);

    	/*$request = Input::all();
    	$protocolos = Protocol::where('id_responsable',$request["id"])->get();
    	return view('viewProtocol',['protocols' => $protocolos] );*/
    }	

    public function exec_protocol($id){
        $endpoint = "http://127.0.0.1:8001/api/services/run/".$id;
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

        $content = json_decode($response->getBody(), true);

        return redirect()->route('viewProtocols', ['info' => $content['Info'], 'estado' => $content['Estado']]);
        

		// or when your server returns json
		/*$content = json_decode($response->getBody(), true);
    	return view('viewProtocol',['protocols' => $protocolos] );*/
    }

    public function re_exec_protocol($id){
    	//protocolo a priori igual que exec protocol, pero hago uno nuevo por cualquier diferencia que peuda surgir.
    	$endpoint = "http://127.0.0.1:8001/api/services/run/".$id;
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

        $content = json_decode($response->getBody(), true);
        $protocolos = self::getProtocols();

        return view('errorsNotice', ['protocols' => $protocolos, 'estado' => $content['Estado']]);
    }
}
