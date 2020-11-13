@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Formulario para crear Protocolo</div>

                <div class="card-body">
                    {{ Form::open(array('url' => 'proyect/store')) }}
                        <fieldset>
                            <!-- Nombre -->
                            <div class="form-group row">
                                {{ Form::Label('nombre', 'Nombre del proyecto:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('nombre', null, ['class' => 'form-control']) }}
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

                            <!-- Responsable -->
                            <div class="form-group row">
                                {{ Form::Label('id_responsable', 'Responsable:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::select('id_responsable', $responsables, null, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    {{ Form::submit('Guardar', ['class' => 'btn btn-lg pull-right']) }}
                                </div>
                            </div>
                        </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection