
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
                        <a href="{{url('create')}}" class="btn btn-success">Crear proyecto nuevo</a>
                        <a href="{{url('followProyects')}}" class="btn btn-success">Seguimiento de proyectos</a>
                    @endif
                    @if(Auth::user()->rol == "Responsable")
                        <p>Responsable de protocolo</p>


                        {{ Form::open(array('url' => 'viewProtocols')) }}
                        {{ Form::hidden('id', Auth::user()->id, ['class' => 'form-control' ]) }}
                         <div class="form-group">
                                <div>
                                    {{ Form::submit('Ver los protocolos', ['class' => 'btn btn-success']) }}
                                </div>
                            </div>
                        {{ Form::close() }}   


                       
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

