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
    }

    public function exec_protocol($id){
        
        #Busco el proceso por el nombre
        $responseBonita = RequestBonitaController::getActivityByName("Ejecutar protocolo");
        $idTask= $responseBonita['data'][0]->id;


        #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
        $response = RequestBonitaController::getIdUserByLastname();
        $idUser = $response['data'][0]->id;

        #A la actividad le asigno un usuario. 
        RequestBonitaController::assignActivityToUser($idTask, $idUser);

        #Ejecuto la actividad, queda guardad en tareas realizadas
        RequestBonitaController::executeActivity($idTask);

        
        $endpoint = "http://127.0.0.1:8001/api/services/run/".$id;
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

        $content = json_decode($response->getBody(), true);

        return redirect()->route('viewProtocols', ['info' => $content['Info'], 'estado' => $content['Estado']]);
    }

    public function re_exec_protocol($id){
    	
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/refresh/".$id;
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

       	return redirect()->route('errorsNotice');
    }

    public function delete_protocol($id){
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/delete/".$id;
    	$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
		return redirect()->route('errorsNotice');
    }

    public function continue_exec_protocol($id){
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/continue/".$id;
    	$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
		return redirect()->route('errorsNotice');
    }


    public static function getDisapproved(){
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/disapproved";
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
        $content = $response->getBody();

        return json_decode($content, true);
    }

    public static function informe(){
        #Busco el proceso por el nombre
        $responseBonita = RequestBonitaController::getActivityByName("Enviar Informe");
        $idTask= $responseBonita['data'][0]->id;
        $idCase= $responseBonita['data'][0]->caseId;

        $variable = "cant_protocolo";
        $data = 0 ; 
        $Response = RequestBonitaController::setCaseVariable($idCase, $variable, $data);


        #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
        $response = RequestBonitaController::getIdUserByLastname();
        $idUser = $response['data'][0]->id;

        #A la actividad le asigno un usuario. 
        RequestBonitaController::assignActivityToUser($idTask, $idUser);

        #Ejecuto la actividad, queda guardad en tareas realizadas
        RequestBonitaController::executeActivity($idTask);

        return redirect()->route('home');
    }
}
