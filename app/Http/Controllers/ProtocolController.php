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

    public function exec_protocol(){
    	return "holi";
    }
}
