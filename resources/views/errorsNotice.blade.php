@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">       
        @if( $protocols->count() > 0 )
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"> Notificaciones de errores </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>                                
                                    <th>Responsable</th>
                                    <th>Error</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($protocols as $protocol)
                                <tr>
                                    <td>{{ $protocol->nombre }}</td>
                                    <td>
                                        {{ (\App\User::where('id', $protocol->id_responsable)->pluck('name'))[0] }}
                                    </td>
                                    <td>{{ $protocol->exec_error }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger">¡Cancelar!</button>
                                        <button type="button" class="btn btn-primary">Re-ejecutar</button>
                                        <button type="button" class="btn btn-success">Continuar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ URL::previous() }}" class="btn btn-info" >Volver</a>
            </div>
        @else
            <div class="col-md-6">
                <h3>No hay protocolos que requieran su atención</h3>
                <a href="{{ URL::previous() }}" class="btn btn-info" >Volver</a>
            </div>
        @endif
    </div>
</div>
@endsection