@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">       
        @if( count($protocols) > 0 )
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" style="background-color: #d9534f;"> Notificaciones de errores </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Proyecto</th>
                                    <th>Nombre</th>                                
                                    <th>Responsable</th>
                                    <th>Error</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($protocols as $protocol)
                                <tr>
                                    <td>{{(\App\Proyect::where('id_proyecto', $protocol['id_proyecto'])->pluck('nombre'))[0]}}</td>
                                    <td>{{ $protocol['nombre'] }}</td>
                                    <td>
                                        {{ (\App\User::where('id', $protocol['id_responsable'])->pluck('name'))[0] }}
                                    </td>
                                    <td>
                                        @if($protocol['exec_error'])
                                            <P>El puntaje es menor a 7<p>
                                        @else
                                            <P>"Comunicarse con el responsable"<p>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{url('/protocol/delete/'.$protocol['id_protocolo'])}}">¡Cancelar!
                                        </a>                                        
                                        <a class="btn btn-primary" href="{{url('/protocol/re-exec/'.$protocol['id_protocolo'])}}">Re-ejecutar
                                        </a>
                                        <a class="btn btn-success" href="{{url('/protocol/continue/'.$protocol['id_protocolo'])}}">Continuar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ url('/home') }}" class="btn btn-info" >Volver</a>
            </div>
        @else
            <div class="col-md-6">
                <h3>No hay protocolos que requieran su atención</h3>
                <a href="{{ url('/home') }}" class="btn btn-info" >Volver</a>
            </div>
        @endif
    </div>
</div>
@endsection