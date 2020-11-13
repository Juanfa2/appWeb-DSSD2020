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
                                {{ Form::Label('nombrep', 'Nombre del proyecto:', ['class' => 'col-lg-4 col-form-label']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('nombrep', null, ['class' => 'form-control']) }}
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

                            <!--Protocolos del proyecto -->
                            <hr/>
                            <h3>Protocolos</h3>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Añadir protocolo</button>
                                </div>
                            </div>
                            <!--
                             <table class="form-group table" id="tabla">
                             <tr class="fila-fija">
                                 <td> <label class="col-lg-4 col-form-label" for="">Responsable</label><input  class="form-control" required name="responsable[]"></td>
                                 <td> <label class="col-lg-4 col-form-label" for="">Nombre</label><input  class="form-control" required name="nombre[]"></td>

                                 <td class="eliminar"> <input type="button" value="Menos -"></td>

                             </tr>
                            </table>
                        -->

                            <div class="form-group row" id="tabla">
                                <div class="fila-fija">

                                    {{ Form::Label('nombre', 'Nombre del protocolo:', ['class' => 'col-lg-10 col-form-label']) }}
                                     <div class="col-lg-12">
                                        {{ Form::text('nombre', null, ['class' => 'form-control', 'name' => 'nombre[]']) }}
                                    </div>

                                     {{ Form::Label('id_responsable', 'Responsable:', ['class' => 'col-lg-10 col-form-label']) }}
                                    <div class="col-lg-12">
                                        {{ Form::select('id_responsable', $responsables, null, ['class' => 'form-control', 'name' => 'responsable[]']) }}
                                    </div>

                                    
                                     {{ Form::Label('local', 'Es local ?:', ['class' => 'col-lg-10 col-form-label']) }}
                                     <div class="col-lg-12">
                                        {{ Form::text('local', null, ['class' => 'form-control', 'name' => 'local[]']) }}
                                    </div>

                                    {{ Form::Label('orden', 'Orden', ['class' => 'col-lg-10 col-form-label']) }}
                                     <div class="col-lg-12">
                                        {{ Form::text('orden', null, ['class' => 'form-control', 'name' => 'orden[]']) }}
                                    </div>



                                    <div class="form-group eliminar">
                                        <div class="col-lg-10 col-lg-offset-2">
                                            <input class="btn btn-danger mt-2" type="button" value="Menos -">
                                        </div> 
                                        
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            
                            {{ Form::hidden('idCreator', Auth::user()->id, ['class' => 'form-control' ]) }}

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
            <a href="{{ URL::previous() }}">Volver</a>
        </div>

    </div>

@endsection
