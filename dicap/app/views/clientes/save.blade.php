@extends('layouts.master')
@section('title')
    Crear Cliente
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlClienteAlta = "{{ action('ValidacionesController@getClienteAlta') }}";
</script>

{{ HTML::script('js/clientes/cliente_save.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Registrar un Nuevo Cliente</strong> </legend>

                    {{ Form::open(array('url' => 'clientes/' . $cliente->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        <div class="form-group notempty has-feedback" id="cli">
                            {{ Form::label ('nombre', 'Nombre del Cliente', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $cliente->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre del Cliente', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre del Cliente', 'onkeypress' => 'return validarLetras(event)')) }}
                            <span style="display:none;" id="icon_cli" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_cli">Debe llenar este campo con el Nombre del Cliente.</span>
                            <span style="display:none;" class="help-block" id="error_cli2">Este Nombre ya ha sido Registrado.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="fon">
                            {{ Form::label ('fono', 'Teléfono del Cliente', array('class' => 'control-label')) }}
                            {{ Form::text ('fono', $cliente->fono, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Teléfono del Cliente', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Teléfono del Cliente', 'onkeypress' => 'return validarNumeros(event)')) }}
                            <span style="display:none;" id="icon_fon" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_fon">Debe llenar este campo con el Teléfono del Cliente.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="dir">
                            {{ Form::label ('direccion', 'Dirección del Cliente', array('class' => 'control-label')) }}
                            {{ Form::text ('direccion', $cliente->direccion, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe la Dirección del Cliente', 'data-toggle'=>'tooltip', 'title'=>'Escribe la Dirección del Cliente', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_dir" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_dir">Debe llenar este campo con la Dirección del Cliente.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Crear Cliente</strong>
                    </button>
                    <a href="{{ url('/clientes') }}" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
                    </a>

                    @if(isset($errors))
                       <ul>
                          @foreach($errors as $item)
                             <li style="color:red;"> {{ $item }} </li>
                          @endforeach
                       </ul>
                    @endif
                </div>
            </div>        
        </div>
    </div>    
@stop