@extends('layouts.master')
@section('title')
    Editar Marca
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlMarcaEdit = "{{ action('ValidacionesController@getMarcaEdit') }}";
</script>

{{ HTML::script('js/marcas/marca_edit.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Editar datos de la Marca: </strong>{{ $marca->nombre }} </legend>

                    {{ Form::open(array('url' => 'marcas/' . $marca->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        @if($marca->id)
                            {{ Form::hidden ('_method', 'PUT') }}
                        @endif

                        <input type="hidden" id="idmarca" value="{{ $marca->id }}">

                        <div class="form-group notempty has-feedback" id="mar">
                            {{ Form::label ('nombre', 'Nombre de la Marca', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $marca->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre de la Marca', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre de la Marca', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_mar" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_mar">Debe llenar este campo con el Nombre de la Marca.</span>
                            <span style="display:none;" class="help-block" id="error_mar2">Esta Marca ya ha sido Registrada.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Editar Datos</strong>
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