<?php

namespace App\Http\Controllers;

use App\Proyect;
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
    {
        Proyect::create([
            'nombre' => Input::get('nombre'),
            'fecha_inicio' => Input::get('fecha_inicio'),
            'fecha_fin' => Input::get('fecha_fin'),
            'id_responsable' => Input::get('id_responsable'),
        ]);
        return redirect()->route('home');
    }
}
