@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #5bc0de;">Informe del protocolo</div>
                <div class="card-body">
                    Creacion del informe ! 
                </div>
            </div>
            <a href="{{ URL::previous() }}" class="btn btn-info">Volver</a>
        </div>

    </div>

@endsection
