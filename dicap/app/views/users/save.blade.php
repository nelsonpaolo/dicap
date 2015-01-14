@extends('layouts.master')
@section('title')
    Crear Usuario
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlUserAlta = "{{ action('ValidacionesController@getUserAlta') }}";
</script>

{{ HTML::script('js/users/user_save.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Registrar a un Nuevo Usuario</strong> </legend>

                    {{ Form::open(array('url' => 'users/' . $user->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        <div class="form-group notempty has-feedback" id="nom">
                            {{ Form::label ('real_name', 'Nombre Real', array('class' => 'control-label')) }}
                            {{ Form::text ('real_name', $user->real_name, array('class' => 'form-control', 'placeholder'=>'Escribe el Nombre Completo del Usuario', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre Completo del Usuario', 'onkeypress' => 'return validarLetras(event)')) }}
                            <span style="display:none;" id="icon_nom" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_nom">Debe llenar este campo con el Nombre Completo del Usuario.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="fon">
                            {{ Form::label ('fono', 'Número de Teléfono', array('class' => 'control-label')) }}
                            {{ Form::text ('fono', $user->fono, array('class' => 'form-control', 'placeholder'=>'Escribe el Número de Teléfono del Usuario', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Número de Teléfono del Usuario', 'onkeypress' => 'return validarNumeros(event)')) }}
                            <span style="display:none;" id="icon_fon" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_fon">Debe llenar este campo con el Número de Teléfono del Usuario.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="dir">
                            {{ Form::label ('direccion', 'Dirección', array('class' => 'control-label')) }}
                            {{ Form::text ('direccion', $user->direccion, array('class' => 'form-control', 'placeholder'=>'Escribe la Dirección del Usuario', 'data-toggle'=>'tooltip', 'title'=>'Escribe la Dirección del Usuario', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_dir" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_dir">Debe llenar este campo con la Dirección del Usuario.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="use">
                            {{ Form::label ('username', 'Username', array('class' => 'control-label')) }}
                            {{ Form::text ('username', $user->username, array('class' => 'form-control', 'placeholder'=>'Escribe el Username del Usuario', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Username del Usuario', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_use" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_use">Debe llenar este campo con el Username del Usuario.</span>
                            <span style="display:none;" class="help-block" id="error_use2">Este Username ya fué registrado, debe indicar otro Username.</span>
                        </div>               

                        <div class="form-group notempty has-feedback" id="pas">
                            {{ Form::label ('password', 'Contraseña', array('class' => 'control-label')) }}
                            <input type="password" class="form-control" id="password" name="password" placeholder="Introduce el Password del Usuario" data-toggle="tooltip" title="Introduce el Password del Usuario" onkeypress="return validarLetrasNumeros(event)">
                            <span style="display:none;" id="icon_pas" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_pas">Debe llenar este campo con la Contraseña del Usuario.</span>
                            <span style="display:none;" class="help-block" id="error_pas2">La Contraseña no coincide la Confirmación, intente nuevamente.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="con">
                            {{ Form::label ('repassword', 'Confirmar Contraseña', array('class' => 'control-label')) }}
                            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirma el Password del Usuario" data-toggle="tooltip" title="Confirma el Password del Usuario" onkeypress="return validarLetrasNumeros(event)">
                            <span style="display:none;" id="icon_con" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_con">Debe llenar este campo con la confirmación de la Contraseña del Usuario.</span>
                        </div>
                

                        <div class="form-group notempty has-feedback" id="niv">
                            {{ Form::label ('level', 'Rol', array('class' => 'control-label')) }}
                            <select name="level" id="level" class="form-control" data-toggle="tooltip" title="Seleccione un Rol para el Usuario">
                                <option value="">Seleccion un Rol</option>
                                @foreach($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->rol }}</option>
                                @endforeach
                            </select>
                            <span style="display:none;" id="icon_niv" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_niv">Debe seleccionar un Rol para el usuario.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Crear Usuario</strong>
                    </button>
                    <a href="{{ url('/users') }}" class="btn btn-default btn-lg">
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