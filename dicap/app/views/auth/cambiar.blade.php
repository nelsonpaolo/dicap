@extends('layouts.master')
@section('title')
    Cambiar Password
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlPass = "{{ action('ValidacionesController@getPassValido') }}",
        ajaxUrlUpdatePost = "{{ action('ValidacionesController@postActualizarPass') }}";
</script>

{{ HTML::script('js/users/user_cambio.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                	<div id="mensaje" class="alert alert-success" align="center" style="display: none;">
                        <strong>Tu Contraseña ha sido actualizada Exitosamente</strong>
                    </div>

                    <legend> <strong>Cambiar Password, Usuario:</strong> {{ $usuario->real_name }} </legend>

                    {{ Form::open(array('url' => 'auth/cambiar', 'class' => 'form-group')) }}

                        <div class="form-group notempty has-feedback" id="pas">
                            {{ Form::label ('password', 'Contraseña Actual', array('class' => 'control-label')) }}
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Introduce tu Password Actual" data-toggle="tooltip" title="Introduce tu Password Actual">
                            <span style="display:none;" id="icon_pas" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_pas">Debes llenar este campo con tu Password Actual.</span>
                            <span style="display:none;" class="help-block" id="error_pas2">El Password es Incorrecto.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="nuevo">
                            {{ Form::label ('nuevopass', 'Nueva Contraseña', array('class' => 'control-label')) }}
                            <input type="password" class="form-control" id="nuevopass" name="nuevopass" placeholder="Introduce tu nuevo Password" data-toggle="tooltip" title="Introduce tu nuevo Password">
                            <span style="display:none;" id="icon_nuevo" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_nuevo">Debes llenar este campo con tu nuevo Password.</span>
                            <span style="display:none;" class="help-block" id="error_nuevo2">La nueva Contraseña no Coincide con la Confirmación.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="con">
                            {{ Form::label ('repass', 'Confirmar Contraseña', array('class' => 'control-label')) }}
                            <input type="password" class="form-control" id="repass" name="repass" placeholder="Confirma tu Nuevo Password" data-toggle="tooltip" title="Confirma tu Nuevo Password">
                            <span style="display:none;" id="icon_con" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_con">Debes llenar este campo con la Confirmación de tu nuevo Password.</span>
                        </div>                  

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Cambiar Password</strong>
                    </button>
                    <a href="{{ url('/auth/welcome') }}" class="btn btn-default btn-lg">
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