@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #5bc0de;">Informe del protocolo para el proyecto {{$proyecto->nombre}}</div>
                <div class="card-body">
                    <h4> Nombre del protocolo: {{$protocolo->nombre}} </h4>
                    {{ Form::open(array('url' => '/protocol/informe')) }}
                        <fieldset>
                            <!--Comentario-->
                            <div class="form-group row">
                                {{ Form::Label('comentario', 'Comentario:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::textArea('comentario', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            {{ Form::hidden('idProtocolo', $protocolo->id_protocolo, ['class' => 'form-control' ]) }}
                            <!-- Submit Button -->
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    {{ Form::submit('Guardar', ['class' => 'btn btn-lg btn-success pull-right']) }}
                                </div>
                            </div>
                        </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
            <a href="{{ URL::previous() }}" class="btn btn-info">Volver</a>
        </div>

    </div>

@endsection
