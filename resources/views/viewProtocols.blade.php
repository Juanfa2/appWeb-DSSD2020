@extends('layouts.app')
@php
    use Illuminate\Support\Facades\Input;
@endphp
@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @php
                    $request = Input::all();
                    $info = Input::get('info');
                    $estado = Input::get('estado');
                @endphp
                @if($info != null)
                <div id="top"> 
                    <a tabindex="-1" href="#" id="metadata-link" data-target="#modal" data-toggle="modal" hidden>Metadata</a>
                </div>

                <!-- Modal -->
                <div class="modal fade in" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $estado }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ $info }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card-header">Protocolos asignados</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Orden</th>
                                <th>Ejecución</th>
                                <th>Proyecto</th>
                                <th>Estado</th>
                                <th>Ejecutar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($protocols as $protocol)
                                @if(Auth::user()->id == $protocol['id_responsable'])
                                <tr>
                                    <td>{{ $protocol['nombre'] }}</td>
                                    <td>{{ $protocol['orden'] }}</td>
                                    <td>@if ($protocol['es_local']) Local @else Remoto @endif</td>
                                    <td>{{ (\App\Proyect::where('id', $protocol['id_proyecto'])->pluck('nombre'))[0] }}</td>
                                    @if( $protocol['fecha_lanzamiento'] != null )
                                        @if( $protocol['puntaje'] == null )
                                            <td>En ejecución...</td>
                                        @else
                                            <td>Ya fue ejecutado</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-success disabled" href="{{url('/protocol/exec/'.$protocol['id_protocolo'])}}">Ejecutar
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    @else
                                        <td>Sin ejecutar</td>
                                        <td>
                                            <a class="btn btn-success" href="{{url('/protocol/exec/'.$protocol['id_protocolo'])}}">Ejecutar
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                                </svg>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ URL::previous() }}" class="btn btn-info">Volver</a>
        </div>
    </div>
</div>
@endsection