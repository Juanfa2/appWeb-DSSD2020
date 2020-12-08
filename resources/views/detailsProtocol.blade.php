@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Detalles del protocolo</div>
                <div class="card-body">
                    <ul> <strong>Nombre</strong> 
                        <li>{{$protocol->nombre}} </li>
                    </ul>
                    <ul> <strong>Responsable </strong>
                        <li>{{ (\App\User::where('id', $protocol['id_responsable'])->pluck('name'))[0] }}</li>
                    </ul>
                    <ul> <strong>Puntaje</strong>
                        <li>{{$protocol->puntaje}}</li>
                    </ul>
                    <ul> <strong>Orden</strong>
                        <li>{{$protocol->orden}}</li>
                    </ul>
                    <ul> <strong>Tipo</strong> 
                        <li> {{($protocol->es_local == 0)? "Local" : "Remoto" }}</li>
                    </ul>
                    <ul> <strong>Nombre del proyecto</strong>
                        <li>{{ (\App\Proyect::where('id_proyecto', $protocol['id_proyecto'])->pluck('nombre'))[0] }}</li>
                    </ul>

                    <ul> <strong>Fecha Inicio</strong>
                        <li>{{$protocol->fecha_lanzamiento}}</li>
                    </ul>

                    <ul> <strong>Fecha Fin</strong>
                        <li>{{$protocol->fecha_terminacion}}</li>
                    </ul>
                    <ul> <strong>Informe</strong>
                        <li>{{$protocol->comentario}}</li>
                    </ul>
                    <ul> <strong>Errores ?</strong>
                        <li>{{($protocol->exec_error == 0)? "Sin errores" : "Con errores" }}</li>
                    </ul>
                </div>
            </div>
            <a href="{{ URL::previous() }}">Volver</a>
        </div>
    </div>
</div>
@endsection