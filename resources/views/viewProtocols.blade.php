@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
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
                            <tr>
                                <td>{{ $protocol->nombre }}</td>
                                <td>{{ $protocol->orden }}</td>
                                <td>@if ($protocol->es_local == 0) Local @else Remoto @endif</td>
                                <td>{{ (\App\Proyect::where('id_proyecto', $protocol->id_proyecto)->pluck('nombre'))[0] }}</td>
                                <td>Sin ejecutar</td>

                                <td>
                                    <a class="btn btn-success" href="{{url('/protocol/exec/')}}">Ejecutar
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ URL::previous() }}">Volver</a>
        </div>
    </div>
</div>
@endsection
   