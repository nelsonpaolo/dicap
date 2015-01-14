@extends('layouts.master')
@section('title')
    Editar Lugar
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlLugarEdit = "{{ action('ValidacionesController@getLugarEdit') }}";
</script>

{{ HTML::script('js/lugares/lugar_edit.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Editar datos del Lugar: </strong>{{ $lugar->nombre }} </legend>

                    {{ Form::open(array('url' => 'lugares/' . $lugar->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        @if($lugar->id)
                            {{ Form::hidden ('_method', 'PUT') }}
                        @endif

                        <input type="hidden" id="idlugar" value="{{ $lugar->id }}">

                        <div class="form-group notempty has-feedback" id="lug">
                            {{ Form::label ('nombre', 'Nombre del Lugar', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $lugar->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre del Lugar', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre del Lugar', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_lug" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_lug">Debe llenar este campo con el Nombre del Lugar.</span>
                            <span style="display:none;" class="help-block" id="error_lug2">Este Lugar ya ha sido Registrado.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Editar Datos</strong>
                    </button>
                    <a href="{{ url('/lugares') }}" class="btn btn-default btn-lg">
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