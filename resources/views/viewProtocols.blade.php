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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($protocols as $protocol)
                            <tr>
                                <td>{{ $protocol->nombre }}</p>
                                <td>{{ $protocol->orden }}</p>
                                <td>@if ($protocol->es_local) Local @else Remoto @endif</p>
                                <td>{{ (\App\Proyect::where('id', $protocol->id_proyecto)->pluck('nombre'))[0] }}</p>
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
   