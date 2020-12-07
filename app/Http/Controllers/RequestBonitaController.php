<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class RequestBonitaController extends Controller
{
    public static function getIdProcessByName($name){
    	/*
        ###################################################
            Busco el id del proceso a traves del nombre.
        ###################################################     
        */

    	$client = GuzzleController::getGuzzleClient();
    	$request = $client->request('GET', 'API/bpm/process?f=displayName='.$name,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
            ],
                
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        $id=$response['data'][0]->id; #Obtengo id del proceso

        return $id;

    }

    public static function getAllProcess(){

    }

    public static function createInstanceProcess($id, $array=null){
    	/*
	        ###############################################
	             Creo una instancia del proceso, seteando
	             las variables de proceso.
	        ###############################################     
    

			el array debe tener este formato, el array es opcional se puede instanciar un proceso sin parametros
	         [ 
	                'name' => 'local',
	                'value'=> 'true'
	            ],
	            [
	                'name' => 'nombre_proyecto',
	                'value' => 'proyecto 1'
	            ]
			]    


    	*/
		$client = GuzzleController::getGuzzleClient();
    	$request = $client->request('POST', '/bonita/API/bpm/case',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken(),
                    
                ], 
                'json'=>[   
                    'processDefinitionId' => $id,
                    'variables' =>$array  
                ]

        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        $caseId = $response['data']->id; #Obtengo id de la instancia

        return $caseId;

    }

    public static function setCaseVariable($caseId, $variable, $data){

    	/*
        #############################################################
            Seteo la variable del proceso de la instancia ($caseId)
            Se tiene que hacer 1 vez por cada variable a setear
        #############################################################    
        */
        $client = GuzzleController::getGuzzleClient();  
    	$request = $client->request('PUT', '/bonita/API/bpm/caseVariable/'.$caseId."/".$variable,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken(),
                   
                ],   
                'json'=> [
                    [
                        'type' => 'java.lang.Integer',
                        'value'=> $data
                    ]
                                     
                            
                ]   
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
    }


    public static function getIdNextActivityByCase($caseId){


    	/* 
        #################################################################
            Busco id de la siguiente actividad perteneciente al case id
        #################################################################    
        */


        $client = GuzzleController::getGuzzleClient();
    	$request = $client->request('GET', '/bonita/API/bpm/task?f=caseId='.$caseId,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                
        ]);

        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        
        $idTask =  $response['data'][0]->id; #obtengo el id de la activdad 
        return $response;
    }

    public static function getActivityByName($name){
       
        $client = GuzzleController::getGuzzleClient();
        $request = $client->request('GET', 'API/bpm/activity?f=name='.$name,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                
        ]);

        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        
        return $response;

    }


    public static function getIdUserByLastname($lastname="bates"){
    	/*
        ###########################################################
             #Obtengo el id del usuario cuyo lastaname por defect 
             es Bates
        ###########################################################     
        */
        $client = GuzzleController::getGuzzleClient();
        $request = $client->request('GET', '/bonita/API/identity/user??p=0&c=10&o=lastname%20ASC&s='.$lastname.'&f=enabled%3dtrue',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);

        $idUser = $response['data'][0]->id; #Obtengo el id del usuario

        return $response;
    }

    public static function assignActivityToUser($idTask, $idUser){

    	/*
        ########################################################################
             #Asigno a la actividad ($idTask) el usuario($idUser) que la va a 
             ejecutar
        ########################################################################     
        */
        $client = GuzzleController::getGuzzleClient();
    	$request = $client->request('PUT', '/bonita/API/bpm/userTask/'.$idTask,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                'json' => [
                            "assigned_id" => $idUser,
                            
                ]   
        ]);

        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);

    }

    public static function executeActivity($idTask){

    	/*
        ##################################################################################
            Ejecutar la actividad, queda como ejecutada y se guarda en case archivados
        ##################################################################################
        */    

        $client = GuzzleController::getGuzzleClient();
        $request = $client->request('POST', '/bonita/API/bpm/userTask/'.$idTask.'/execution',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
    }


}
