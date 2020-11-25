@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulario para crear proyecto</div>
                <div class="card-body">
                    <h3 class="h3-create-proyect">Datos del proyecto</h3>
                    {{ Form::open(array('url' => 'proyect/store')) }}
                        <fieldset>
                            <!-- Nombre -->
                            <div class="form-group row">
                                {{ Form::Label('nombre_proyecto', 'Nombre del proyecto:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('nombre_proyecto', null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <!-- Fecha inicio -->
                            <div class="form-group row">
                                {{ Form::Label('fecha_inicio', 'Fecha de inicio:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::date('fecha_inicio', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <!-- Fecha fin -->
                            <div class="form-group row">
                                {{ Form::Label('fecha_fin', 'Fecha de finalización:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::date('fecha_fin', \Carbon\Carbon::now(), ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <hr/>

                            <!--Protocolos del proyecto -->
                            <h3>Protocolos</h3>
                            <div class="form-group">
                                <button id="adicional" name="adicional" type="button" class="btn btn-info">Añadir protocolo</button>
                            </div>

                            <div class="form-group row" id="tabla">
                                <div class="fila-fija">
                                    <div class="form-group">
                                        {{ Form::Label('nombre', 'Nombre del protocolo:', ['class' => 'col-lg-10 col-form-label']) }}
                                        <div class="col-lg-10">
                                            {{ Form::text('nombre', null, ['class' => 'form-control', 'name' => 'nombre[]']) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::Label('id_responsable', 'Responsable:', ['class' => 'col-lg-10 col-form-label']) }}
                                        <div class="col-lg-10">
                                            {{ Form::select('id_responsable', $responsables, null, ['class' => 'form-control', 'name' => 'responsable[]']) }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        {{ Form::Label('local', 'Ejecución:', ['class' => 'col-lg-10 col-form-label']) }}
                                        <div class="col-lg-10">
                                        {{ Form::select('id_responsable', ['0' => 'Local', '1' => 'Remota'], null, ['class' => 'form-control', 'name' => 'ejecucion[]']) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::Label('orden', 'Orden', ['class' => 'col-lg-10 col-form-label']) }}
                                        <div class="col-lg-6">
                                            {{ Form::number('orden', null, ['class' => 'form-control', 'name' => 'orden[]']) }}
                                        </div>
                                    </div>

                                    <div class="form-group eliminar">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <input class="btn btn-danger mt-2" type="button" value="Eliminar protocolo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            
                            {{ Form::hidden('idCreator', Auth::user()->id, ['class' => 'form-control' ]) }}

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
