@extends('layouts.master')
@section('title')
    Crear Marca
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlMarcaAlta = "{{ action('ValidacionesController@getMarcaAlta') }}";
</script>

{{ HTML::script('js/marcas/marca_save.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Registrar un Nueva Marca</strong> </legend>

                    {{ Form::open(array('url' => 'marcas/' . $marca->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        <div class="form-group notempty has-feedback" id="mar">
                            {{ Form::label ('nombre', 'Nombre de la Marca', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $marca->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre de la Marca', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre de la Marca', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_mar" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_mar">Debe llenar este campo con el Nombre de la Marca.</span>
                            <span style="display:none;" class="help-block" id="error_mar2">Esta Marca ya ha sido Registrada.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Crear Marca</strong>
                    </button>
                    <a href="{{ url('/marcas') }}" class="btn btn-default btn-lg">
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