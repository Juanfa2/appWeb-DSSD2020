@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #5cb85c;"> Seguimientos de proyectos </div>
                <div class="card-body">
                    @foreach ($proyects as $proyect)
                        @if($proyect->id_responsable == Auth::id())
                            <p>Proyecto: {{$proyect->nombre}}</p>
                            @if($proyect->exitoso == 0)
                                <p>Proyecto sin problemas</p>
                            @else
                                <p>Proyecto cancelado</p>    
                            @endif
                            <p>Protocolos</p>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de fin</th>
                                        <th>Responsable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($protocols as $protocol)
                                    @if($protocol->id_proyecto == $proyect->id_proyecto)
                                    <tr>
                                        <td><a href="{{url('/protocol/detail/'.$protocol['id_protocolo'])}}">{{ $protocol->nombre }}</a></td>
                                        <td>{{ $protocol->fecha_lanzamiento}}</td>
                                        <td>{{ ($protocol->fecha_terminacion != null)? $protocol->fecha_terminacion : " "}}</td>
                                        <td>{{ (\App\User::where('id', $protocol['id_responsable'])->pluck('name'))[0] }}</td>
                                    </tr>
                                    @endif
                                @endforeach    
                                </tbody>
                            </table>
                        @endif    
                    @endforeach                           
                </div>
            </div>
            <a href="{{ URL::previous() }}">Volver</a>
        </div>
    </div>
</div>
@endsection