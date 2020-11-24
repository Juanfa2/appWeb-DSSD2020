@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Bienvenido @auth {{ Auth::user()->name }} @endauth !</div>
                <div class="card-body">
                    @if(Auth::user()->rol == "Jefe")
                        <p>Jefe de proyecto ! </p>
                        <a href="{{url('create')}}" class="btn btn-primary">Crear proyecto nuevo</a>
                        <a href="{{url('followProyects')}}" class="btn btn-success">Seguimiento de proyectos</a>
                        <a href="{{url('errorsNotice')}}" class="btn btn-danger">Notificaciones de fallas</a>
                    @endif
                    @if(Auth::user()->rol == "Responsable")
                        <p>Responsable de protocolo</p>
                            <a href="{{url('viewProtocols')}}" class="btn btn-success">Seguimiento de proyectos</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

