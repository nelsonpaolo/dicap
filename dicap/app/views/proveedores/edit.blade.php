@extends('layouts.master')
@section('title')
    Editar Proveedor
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlProveedorEdit = "{{ action('ValidacionesController@getProveedorEdit') }}";
</script>

{{ HTML::script('js/proveedores/proveedor_edit.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Editar datos del Proveedor: </strong>{{ $proveedor->nombre }} </legend>

                    {{ Form::open(array('url' => 'proveedores/' . $proveedor->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        @if($proveedor->id)
                            {{ Form::hidden ('_method', 'PUT') }}
                        @endif

                        <input type="hidden" id="idproveedor" value="{{ $proveedor->id }}">

                        <div class="form-group notempty has-feedback" id="prov">
                            {{ Form::label ('nombre', 'Nombre del Proveedor', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $proveedor->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre del Proveedor', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre del Proveedor', 'onkeypress' => 'return validarLetras(event)')) }}
                            <span style="display:none;" id="icon_prov" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_prov">Debe llenar este campo con el Nombre del Proveedor.</span>
                            <span style="display:none;" class="help-block" id="error_prov2">Este Nombre ya ha sido Registrado.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="fon">
                            {{ Form::label ('fono', 'Teléfono del Proveedor', array('class' => 'control-label')) }}
                            {{ Form::text ('fono', $proveedor->fono, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Teléfono del Proveedor', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Teléfono del Proveedor', 'onkeypress' => 'return validarNumeros(event)')) }}
                            <span style="display:none;" id="icon_fon" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_fon">Debe llenar este campo con el Teléfono del Proveedor.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="dir">
                            {{ Form::label ('direccion', 'Dirección del Proveedor', array('class' => 'control-label')) }}
                            {{ Form::text ('direccion', $proveedor->direccion, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe la Dirección del Proveedor', 'data-toggle'=>'tooltip', 'title'=>'Escribe la Dirección del Proveedor', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_dir" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_dir">Debe llenar este campo con la Dirección del Proveedor.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Editar Datos</strong>
                    </button>
                    <a href="{{ url('/proveedores') }}" class="btn btn-default btn-lg">
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