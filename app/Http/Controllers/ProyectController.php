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

    protected function store()
    {   $request = Input::all();
        //dd($request);


        $idP = Proyect::create([
            'nombre' => Input::get('nombrep'),
            'fecha_inicio' => Input::get('fecha_inicio'),
            'fecha_fin' => Input::get('fecha_fin'),
            'id_responsable' => Input::get('idCreator'),
        ]);

        $id = Proyect::where('nombre', Input::get('nombrep'))->pluck('id_proyecto');
        

        $cant = count($request["responsable"]);
        

        for ($i=0; $i < $cant ; $i++) { 
            Protocol::create([
                'nombre' => $request["nombre"][$i],
                
                'id_responsable' =>$request["responsable"][$i] ,
                'orden' => $request["orden"][$i],
                'es_local'=> ($request["local"][$i] == '0') ? 0 : 1,
                'id_proyecto' => (string)$idP["id"] , 
            ]);
        }

        return redirect()->route('home');
    }
}
