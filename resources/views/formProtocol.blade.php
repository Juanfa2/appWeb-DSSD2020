@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #5bc0de;">Formulario del protocolo </div>
                <div class="card-body">
                    
                    <h3 class="h3-create-proyect">Ejecucion de protocolo local</h3>
                    {{ Form::open(array('url' => '/protocol/execute')) }}
                        <fieldset>
                            <!-- Nombre -->
                            <div class="form-group row">
                                {{ Form::Label('puntaje', 'Puntaje del protocolo', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::number('puntaje', (isset($puntaje))? $puntaje : null, ['class' => 'form-control', 'min'=>"1", 'max'=>"10"]) }}
                                </div>
                            </div>

                            <!-- Fecha fin -->
                            <div class="form-group row">
                                {{ Form::Label('fecha_fin', 'Fecha de finalización:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::date('fecha_fin', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                                </div>
                            </div>

                            {{ Form::hidden('idProtocolo', $protocolo->id_protocolo, ['class' => 'form-control' ]) }}
                            {{ Form::hidden('idcase', (\App\Proyect::where('id_proyecto', $protocolo['id_proyecto'])->pluck('id_case'))[0], ['class' => 'form-control' ]) }}
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
