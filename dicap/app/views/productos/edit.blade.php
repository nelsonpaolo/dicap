@extends('layouts.master')
@section('title')
    Editar Producto
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlProductoEdit = "{{ action('ValidacionesController@getProductoEdit') }}",
        ajaxUrlGetCategorias = "{{ action('ValidacionesController@getCategorias') }}";
</script>

{{ HTML::script('js/productos/producto_edit.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Editar datos del Producto: </strong>{{ $producto->nombre }} </legend>

                    {{ Form::open(array('url' => 'productos/' . $producto->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        @if($producto->id)
                            {{ Form::hidden ('_method', 'PUT') }}
                        @endif

                        <input type="hidden" id="idproducto" value="{{ $producto->id }}">

                        <div class="form-group notempty has-feedback" id="pro">
                            {{ Form::label ('codigo', 'Código del Producto', array('class' => 'control-label')) }}
                            {{ Form::text ('codigo', $producto->codigo, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Código del Producto', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Código del Producto', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_pro" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_pro">Debe llenar este campo con el Código del Producto.</span>
                            <span style="display:none;" class="help-block" id="error_pro2">Este Código ya ha sido Registrado.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="nom">
                            {{ Form::label ('nombre', 'Nombre del Producto', array('class' => 'control-label')) }}
                            {{ Form::text ('nombre', $producto->nombre, array('class' => 'form-control mayusculas', 'placeholder'=>'Escribe el Nombre del Producto', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Nombre del Producto', 'onkeypress' => 'return validarLetrasNumeros(event)')) }}
                            <span style="display:none;" id="icon_nom" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_nom">Debe llenar este campo con el Nombre del Producto.</span>
                        </div>

                        <div class="form-group has-feedback" id="com">
                            {{ Form::label ('precio_compra', 'Precio de Compra', array('class' => 'control-label')) }}
                            {{ Form::text ('precio_compra', $producto->precio_compra, array('class' => 'form-control decimal', 'placeholder'=>'Escribe el Precio de Compra Referencial del Producto', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Precio de Compra Referencial del Producto', 'onkeypress' => 'return validarDecimales(event, this.id)')) }}
                            <span style="display:none;" id="icon_com" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_com">Debe llenar este campo con el Precio de Compra Referencial del Producto.</span>
                        </div>

                        <div class="form-group has-feedback" id="ven">
                            {{ Form::label ('precio_venta', 'Precio de Venta', array('class' => 'control-label')) }}
                            {{ Form::text ('precio_venta', $producto->precio_venta, array('class' => 'form-control decimal', 'placeholder'=>'Escribe el Precio de Venta Referencial del Producto', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Precio de Venta Referencial del Producto', 'onkeypress' => 'return validarDecimales(event, this.id)')) }}
                            <span style="display:none;" id="icon_ven" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_ven">Debe llenar este campo con el Precio de Venta Referencial del Producto.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="mar">
                            {{ Form::label ('marca', 'Marca del Producto', array('class' => 'control-label')) }}
                            <select class="form-control" name="marca" id="marca" data-toggle="tooltip" title="Click aquí para seleccionar una Marca">
                                <option value="">Seleccione una Marca</option>
                                @foreach($marcas as $item)
                                    <?php ($item->id == $producto->marca) ? $select1 = 'selected="selected"' : $select1 = ''; ?>
                                    <option value="{{ $item->id }}" {{ $select1 }}>{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span style="display:none;" id="icon_mar" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_mar">Debe seleccionar la Marca del Producto.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="cat">
                            {{ Form::label ('categoria', 'Categoría del Producto', array('class' => 'control-label')) }}
                            <select class="form-control" name="categoria" id="categoria" data-toggle="tooltip" title="Click aquí para seleccionar una Categoría">
                                <option value="">Seleccione una Categoría</option>
                                @foreach($categorias as $item)
                                    <?php ($item->id == $producto->categoria) ? $select1 = 'selected="selected"' : $select1 = ''; ?>
                                    <option value="{{ $item->id }}" {{ $select1 }}>{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span style="display:none;" id="icon_cat" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_cat">Debe seleccionar la Categoría del Producto.</span>
                        </div>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Editar Datos</strong>
                    </button>
                    <a href="{{ url('/productos') }}" class="btn btn-default btn-lg">
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