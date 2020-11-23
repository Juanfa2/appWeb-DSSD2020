@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Seguimientos de proyectos </div>
                <div class="card-body">
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
                            @foreach ($proyects as $proyect)
                            <tr>
                                <td>{{ $proyect->nombre }}</td>
                                <td>{{ $proyect->fecha_inicio }}</td>
                                <td>{{ $proyect->fecha_fin }}</td>
                                <td>{{ (\App\User::where('id', $proyect->id_responsable)->pluck('name'))[0] }}</td>
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