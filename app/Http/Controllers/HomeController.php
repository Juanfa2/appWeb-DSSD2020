<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function enviar(Request $request){
 

    }
    
    public function recibir(Request $request){

        /*
        ###################################################
            Busco el id del proceso a traves del nombre.
        ###################################################     
        
        
        $client = GuzzleController::getGuzzleClient();
        /*
        $request = $client->request('GET', 'API/bpm/process?f=displayName=pool',
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
        

        /*
        ###############################################
             Creo una instancia del proceso
        ###############################################     
        */


        /*
        $request = $client->request('POST', '/bonita/API/bpm/case',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken(),
                    
                ], 
                'json'=>[   
                    'processDefinitionId' => $id,
                    'variables' =>[
                            [ 
                                'name' => 'local',
                                'value'=> 'true'
                            ],
                            [
                                'name' => 'nombre_proyecto',
                                'value' => 'proyecto 1'
                            ]
                    ]      
                ]

        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        $caseId = $response['data']->id; #Obtengo id de la instancia
        //dd($caseId);


        /*
        #############################################################
            Seteo la variable del proceso de la instancia ($caseId)
            Se tiene que hacer 1 vez por cada variable a setear
        #############################################################    
        


        $caseId = 17;
        $variable = "cant_protocolo";
        $data = 0;
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


        //dd($response);

        /* 
        #################################################################
            Busco id de la siguiente actividad perteneciente al case id
        #################################################################    
        


        //$caseId = 7;
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
        //dd($idTask);


        /*
        ###########################################################
             #Obtengo el id del usuario cuyo lastaname es Bates
        ###########################################################     
        
       
        $request = $client->request('GET', '/bonita/API/identity/user??p=0&c=10&o=lastname%20ASC&s=bates&f=enabled%3dtrue',
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

        //dd($response['data'][0]->id);


        /*
        ########################################################################
             #Asigno a la actividad ($idTask) el usuario que la va a ejecutar
        ########################################################################     
        

       

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
       
    
        /*
        ##################################################################################
            Ejecutar la actividad, queda como ejecutada y se guarda en case archivados
        ##################################################################################
          

        $request = $client->request('POST', '/bonita/API/bpm/userTask/'.$idTask.'/execution',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],
                 'json' => [
                              "ticket_comment"=>"This is a comment"
        
                ],   
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);

        dd($response);


     */   
    }

}


