@extends('layouts.master')
@section('title')
    Crear Categoria
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlCategoriaAlta = "{{ action('ValidacionesController@getCategoriaAlta') }}";
</script>

{{ HTML::script('js/categorias/categoria_save.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Registrar un Nueva Categoria</strong> </legend>

                    {{ Form::open(array('url' => 'categorias/' . $categoria->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        <div class="form-group notempty has-feedback" id="cat">
                            {{ Form::label ('nombre', 'Nombre de la Categoria', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $categoria->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre de la Categoria', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre de la Categoria', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_cat" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_cat">Debe llenar este campo con el Nombre de la Categoria.</span>
                            <span style="display:none;" class="help-block" id="error_cat2">Estos datos ya han sido Registrados.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="mar">
                            {{ Form::label ('marca', 'Marca a la que pertenece la Categoría', array('class' => 'control-label')) }}
                            <select class="form-control" name="marca" id="marca" data-toggle="tooltip" title="Click aquí para seleccionar una Marca">
                                <option value="">Seleccione una Marca</option>
                                @foreach($marcas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span style="display:none;" id="icon_mar" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_mar">Debe seleccionar una Marca para la Categoria.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Crear Categoria</strong>
                    </button>
                    <a href="{{ url('/categorias') }}" class="btn btn-default btn-lg">
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