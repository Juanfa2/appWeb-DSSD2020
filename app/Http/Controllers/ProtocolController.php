<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Protocol;
use App\Proyect;
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
        /*
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

        return view('protocolRemoto' ,['info' => $content['Info'], 'estado' => $content['Estado']]);
        //return view('protocolRemoto' ,compact('content'));
        */
    }


    public function re_exec_protocol($id){
    	$protocolo = Protocol::where('id_protocolo',$id)->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();
        $idCase = $proyecto->id_case;

        //dd($protocolo);

        $variable = "terminar";
        $data = "Reejecutar";
        $tipoData = "String";


        $responseBonita = RequestBonitaController::getIdNextActivityByCase($idCase);
        
        if ($responseBonita['data'][0]->name == "Analizar falla") {
            $idTask= $responseBonita['data'][0]->id;


            $Response = RequestBonitaController::setCaseVariable($idCase, $variable, $data, $tipoData);

            #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
            $response = RequestBonitaController::getIdUserByLastname();
            $idUser = $response['data'][0]->id;


            #A la actividad le asigno un usuario. 
            RequestBonitaController::assignActivityToUser($idTask, $idUser);

            #Ejecuto la actividad, queda guardad en tareas realizadas
            RequestBonitaController::executeActivity($idTask);

            $endpoint = "http://127.0.0.1:8001/api/services/protocol/refresh/".$id;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $endpoint);

            $protocolo->exec_error = 0;
            $protocolo->puntaje=null;
            $protocolo->fecha_terminacion=null;
            $protocolo->save();

            

        }


        return redirect()->route('errorsNotice');
        /*
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/refresh/".$id;
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);

       	return redirect()->route('errorsNotice');
        */
    }

    public function delete_protocol($id){
        $protocolo = Protocol::where('id_protocolo',$id)->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();
        $idCase = $proyecto->id_case;
        
        //dd($protocolo);

        $variable = "terminar";
        $data = "Terminar";
        $tipoData = "String";


        $responseBonita = RequestBonitaController::getIdNextActivityByCase($idCase);
        
        if ($responseBonita['data'][0]->name == "Analizar falla") {
            $idTask= $responseBonita['data'][0]->id;


            $Response = RequestBonitaController::setCaseVariable($idCase, $variable, $data, $tipoData);

            #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
            $response = RequestBonitaController::getIdUserByLastname();
            $idUser = $response['data'][0]->id;


            #A la actividad le asigno un usuario. 
            RequestBonitaController::assignActivityToUser($idTask, $idUser);

            #Ejecuto la actividad, queda guardad en tareas realizadas
            RequestBonitaController::executeActivity($idTask);

            $protocolo->exec_error = 0;
            $protocolo->save();

            $proyecto->exitoso = 1;
            $proyecto->save();
        }


        return redirect()->route('home');



        /*
    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/delete/".$id;
    	$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
		return redirect()->route('errorsNotice');
        */
    }

    public function continue_exec_protocol($id){

        $protocolo = Protocol::where('id_protocolo',$id)->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();
        $idCase = $proyecto->id_case;

        //dd($protocolo);

        $variable = "terminar";
        $data = "Seguir";
        $tipoData = "String";


        $responseBonita = RequestBonitaController::getIdNextActivityByCase($idCase);
        
        if ($responseBonita['data'][0]->name == "Analizar falla") {
            $idTask= $responseBonita['data'][0]->id;


            $Response = RequestBonitaController::setCaseVariable($idCase, $variable, $data, $tipoData);

            #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
            $response = RequestBonitaController::getIdUserByLastname();
            $idUser = $response['data'][0]->id;


            #A la actividad le asigno un usuario. 
            RequestBonitaController::assignActivityToUser($idTask, $idUser);

            #Ejecuto la actividad, queda guardad en tareas realizadas
            RequestBonitaController::executeActivity($idTask);

            

            $protocolo->exec_error = 0;
            $protocolo->save();
        }


        return redirect()->route('errorsNotice');
        /*

    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/continue/".$id;
    	$client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
		return redirect()->route('errorsNotice');
        */
    }


    public static function getDisapproved(){

        $protocolos = Protocol::where('exec_error', 1)->get();
        return $protocolos;

        /*

    	$endpoint = "http://127.0.0.1:8001/api/services/protocol/disapproved";
        $client = new \GuzzleHttp\Client();

		$response = $client->request('GET', $endpoint);
        $content = $response->getBody();

        return json_decode($content, true);
        */
    }

    public static function informe($id){
        $protocolo = Protocol::where('id_protocolo', $id)->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();

        return view('informe', compact('protocolo', 'proyecto'));

    }

    public static function uploadInforme(Request $request){
        $protocolo = Protocol::where('id_protocolo',$request["idProtocolo"])->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();
        $idCase= $proyecto->id_case;
        $responseBonita = RequestBonitaController::getIdNextActivityByCase($idCase);

        $protocolos = Protocol::where('id_proyecto',$protocolo->id_proyecto)->where('informe',0)->get();


        if ($responseBonita['data'][0]->name == "Enviar informe") {
            #Busco el proceso por el nombre

            $idTask= $responseBonita['data'][0]->id;

            $variable = "cant_protocolo";
            $data = count($protocolos) - 1; 
            $tipoData="Integer";


            $Response = RequestBonitaController::setCaseVariable($idCase, $variable, $data, $tipoData);

            
            #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
            $response = RequestBonitaController::getIdUserByLastname();
            $idUser = $response['data'][0]->id;

            #A la actividad le asigno un usuario. 
            RequestBonitaController::assignActivityToUser($idTask, $idUser);

            


            $protocolo->comentario = $request['comentario'];
            $protocolo->informe = 1; 
            $protocolo->save();

            #Busco el siguiente protocoo a ejecutar
            $protocolo = Protocol::where('informe', 0)->where('exec_error', 0)->where('id_proyecto', $proyecto->id_proyecto)->orderBy('orden', 'ASC')->first();
            if ($protocolo != null) {
                
            //dd($protocolo);

                if ($protocolo->es_local == 1) {
                    $variable1 = "tipo";
                    $data1 = "remoto";
                    $tipoData1 = "String";
                    RequestBonitaController::setCaseVariable($idCase, $variable1, $data1, $tipoData1);

                }else{
                    $variable1 = "tipo";
                    $data1 = "null";
                    $tipoDat1 = "String";
                    RequestBonitaController::setCaseVariable($idCase, $variable1, $data1, $tipoDat1);
                }

                #Seteo si el local o no 

                #Obtengo el id del proximo protocolo
                $var1= "id_protocolo";
                $data1 = $protocolo->id_protocolo;
                $tipoData1 = "Integer";

                #seteo id_protocolo en bonita
                RequestBonitaController::setCaseVariable($idCase, $var1, $data1, $tipoData1);

                $nombre= "nombre_protocolo";
                $datoNombre = $protocolo->nombre;
                $tipoDato = "String";
                RequestBonitaController::setCaseVariable($idCase, $nombre, $datoNombre, $tipoDato);

                $nombre= "info";
                $datoNombre = "null";
                $tipoDato = "String";
                RequestBonitaController::setCaseVariable($idCase, $nombre, $datoNombre, $tipoDato);



            }
        #Ejecuto la actividad, queda guardad en tareas realizadas
        RequestBonitaController::executeActivity($idTask);       
        }

        return redirect()->route('home');
    }

    public static function execute($id){

        $protocolo = Protocol::where('id_protocolo', $id)->first();
        if($protocolo->es_local == 1){

            $endpoint = "http://127.0.0.1:8001/api/services/run/".$id;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $endpoint);

            $endpoint = "http://127.0.0.1:8001/api/services/status/".$id;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $endpoint);

            $content = json_decode($response->getBody(), true);

            $puntaje = $content['Puntaje'];
            return view('formProtocol', compact('protocolo', 'puntaje'));

        }else{
            return view('formProtocol', compact('protocolo'));
        }

        
    }

    public static function updateProtocol(Request $request){
        $protocolo = Protocol::where('id_protocolo',$request["idProtocolo"])->first();
        $proyecto = Proyect::where('id_proyecto', $protocolo->id_proyecto)->first();

        $protocolos = Protocol::where('id_proyecto',$protocolo->id_proyecto)->where('informe',0)->get();

        #Busco el proceso por el nombre
        $responseBonita = RequestBonitaController::getIdNextActivityByCase($request["idcase"]);
        
        if ($responseBonita['data'][0]->name == "Ejecutar protocolo") {
            $idTask= $responseBonita['data'][0]->id;

            if($request["puntaje"] <= 6){
                $variable1 = "ejecucion";
                $data1 = "False";
                $tipoData = "Boolean";
                RequestBonitaController::setCaseVariable($request["idcase"], $variable1, $data1, $tipoData);
            }else{
                $variable1 = "ejecucion";
                $data1 = "True";
                $tipoData = "Boolean";
                RequestBonitaController::setCaseVariable($request["idcase"], $variable1, $data1, $tipoData);
            }

            $variable = "cant_protocolo";
            $data = count($protocolos) - 1; 
            $tipoData = "Integer";

            $Response = RequestBonitaController::setCaseVariable($request["idcase"], $variable, $data, $tipoData);

            #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
            $response = RequestBonitaController::getIdUserByLastname();
            $idUser = $response['data'][0]->id;


            #A la actividad le asigno un usuario. 
            RequestBonitaController::assignActivityToUser($idTask, $idUser);

            #Ejecuto la actividad, queda guardad en tareas realizadas
            RequestBonitaController::executeActivity($idTask);

            

            $protocolo->puntaje = $request["puntaje"];
            $protocolo->fecha_terminacion = $request["fecha_fin"];
            if($request["puntaje"] <= 6){
                  $protocolo->exec_error = 1;
            }
            //dd($protocolo);
            $protocolo->save();
        }
       


        

        return redirect()->route('viewProtocols');
    }


    public static function detail($id){
        $protocol = Protocol::where('id_protocolo',$id)->first();

        return view('detailsProtocol', compact('protocol'));
    }
}
