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
        #Busco el id del proceso a traves del nombre. 
        $client = GuzzleController::getGuzzleClient();
        $request = $client->request('GET', 'API/bpm/case?name=configuracion',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
            ],
                
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
       
        dd($response);
        $id=$response['data'][0]->processDefinitionId; #Obtengo id del proceso
        //dd($response);
        

        #Creo una instancia del proceso
        $request = $client->request('POST', '/bonita/API/bpm/process/'.$id.'/instantiation',
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
        $caseId = $response['data']->caseId; #Obtengo id de la instancia
        

#######################################################################################################################
        #Seteo la variable del proceso de la instancia ($caseId)
        #Se tiene que hacer 1 vez por cada variable a setear
        $variable = "nombre";
        $data = "carlos";
        $request = $client->request('PUT', '/bonita/API/bpm/caseVariable/'.$caseId.'/'.$variable,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                'json' => [
                            'type' => 'java.lang.String',
                            'value'=> $data
                ]   
        ]);
        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);

        #Busco id de la actividad perteneciente al case id
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
        //dd($response['data'][0]->id);
        $idTask =  $response['data'][0]->id; #obtengo el id de la activdad 



        #Obtengo el id del usuario cuyo lastaname es Bates
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

        #Asigno a la actividad ($idTask) el usuario que la va a ejecutar

        $request = $client->request('PUT', '/bonita/API/bpm/userTask/'.$idTask,
            [
                'headers' => [
                    'X-Bonita-API-Token' => GuzzleController::getToken()
                ],   
                'json' => [
                            "assigned_id" => $idUser,
                            'state'=> 'skipped'
                ]   
        ]);

        $tareas = $request->getBody();
        $json = json_decode($tareas);
    
        $response['success'] = true;
        $response['data'] = json_decode($tareas);
       
        dd($response);


        ##Ejecutar la actividad, y le dejo un comentario.
        #NO FUNCIONA POR AHORA

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


        
    }
}


