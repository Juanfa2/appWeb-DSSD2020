<?php

namespace App\Http\Controllers;

use App\Proyect;
use App\Protocol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Redirector;

class ProyectController extends Controller
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

    public function store()

    {   
        #Busco el proceso por su nombre, en este caso "Pool", que me devuelve el id.
        $idProcess = RequestBonitaController::getIdProcessByName('pool');

        #Armo el array con las variables de proceso que se van a setear
        $array = [
            [
                'name' => 'nombre_proyecto',
                'value'=> Input::get('nombre_proyecto')
            ],
            [
                'name' => 'fecha_inicio',
                'value'=> Input::get('fecha_inicio')
            ],
            [
                'name' => 'fecha_fin',
                'value'=> Input::get('fecha_fin')
            ],
        ];

        #Instancio un nuevo caso del proceso con las variables definidas. 
        $caseId = RequestBonitaController::createInstanceProcess($idProcess, $array);



        $request = Input::all();
        Proyect::create([
            'nombre' => Input::get('nombre_proyecto'),
            'fecha_inicio' => Input::get('fecha_inicio'),
            'fecha_fin' => Input::get('fecha_fin'),
            'id_responsable' => Input::get('idCreator'),
            'id_case' => $caseId
        ]);

        $id = Proyect::where('nombre', Input::get('nombre_proyecto'))->first();
        //dd($id->id_proyecto);
        

        $cant = count($request["responsable"]);

        $endpoint = "http://127.0.0.1:8001/api/services/protocol/add";
        $client = new \GuzzleHttp\Client();
        /*
        for ($i=0; $i < $cant ; $i++) { 
            $response = $client->request('POST', $endpoint, [
                'form_params' => [
                    'nombre' => $request["nombre"][$i],
                    'id_responsable' => $request["responsable"][$i],
                    'orden' => $request["orden"][$i],
                    'es_local'=> $request["ejecucion"][$i],
                    'id_proyecto' => $id->id_proyecto, 
                ]
            ]);
        }
        */
        for ($i=0;
         $i < $cant ; $i++) { 
            $port = Protocol::create([
                'nombre' => $request["nombre"][$i],
                'id_responsable' => $request["responsable"][$i],
                'orden' => $request["orden"][$i],
                'es_local'=> $request["ejecucion"][$i],
                'id_proyecto' => $id->id_proyecto, 
                'fecha_lanzamiento' => Input::get('fecha_inicio')
            ]);
            $idapp= $port->id_protocolo;
            $response = $client->request('POST', $endpoint, [
                'form_params' => [
                    'nombre' => $request["nombre"][$i],
                    'id_responsable' => $request["responsable"][$i],
                    'orden' => $request["orden"][$i],
                    'es_local'=> $request["ejecucion"][$i],
                    'id_proyecto' => $id->id_proyecto,
                    'id_app'=> $idapp 
                ]
            ]);
        }

        $protocolo = Protocol::where('informe', 0)->where('exec_error', 0)->where('id_proyecto', $id->id_proyecto)->orderBy('orden', 'ASC')->first();

        if ($protocolo->es_local == 1) {
            $variable = "tipo";
            $data = "remoto";
            $tipoData = "String";

        }else{
            $variable = "tipo";
            $data = "local";
            $tipoData = "String";
        }

        #Seteo si la variable local es true
        RequestBonitaController::setCaseVariable($caseId, $variable, $data, $tipoData);

        $var1= "id_protocolo";
        $data1 = $protocolo->id_protocolo;
        $tipoData1 = "Integer";

        #Seteo el id del protocolo
        RequestBonitaController::setCaseVariable($caseId, $var1, $data1, $tipoData1);


        $nombre= "nombre_protocolo";
        $datoNombre = $protocolo->nombre;
        $tipoDato = "String";

        #Seteo nombre del protocolo
        RequestBonitaController::setCaseVariable($caseId, $nombre, $datoNombre, $tipoDato);

        #Busca la siguiente actividad a ejecutar, y me quedo con el id
        $response =  RequestBonitaController::getIdNextActivityByCase($caseId);
        $idTask =  $response['data'][0]->id;

        #Busco el usuario por lastname, "en este caso viene predefinido con bates", y me quedo con el id
        $response = RequestBonitaController::getIdUserByLastname();
        $idUser = $response['data'][0]->id;

        #A la actividad le asigno un usuario. 
        RequestBonitaController::assignActivityToUser($idTask, $idUser);

        #Ejecuto la actividad, queda guardad en tareas realizadas
        RequestBonitaController::executeActivity($idTask);

        //$response = RequestBonitaController::getActivityByName("Configuracion de proyecto");

        return redirect()->route('home');
    }

    public function getProyects(){

    }
}
