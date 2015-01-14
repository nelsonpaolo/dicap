@extends('layouts.master')
@section('title')
    Nueva Salida
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlSalidaAlta = "{{ action('ValidacionesController@getSalidaAlta') }}",
        ajaxUrlGetDatosProdLug = "{{ action('ValidacionesController@getDatosProdLugSalida') }}";
</script>

{{ HTML::script('js/salidas/salida_save.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Nueva Salida de Productos de Stock</strong> </legend>

                    @if(Session::has('notice'))
                        <div class="alert alert-danger"><strong> {{ Session::get('notice') }} </strong></div>
                    @endif

                    {{ Form::open(array('url' => 'salidas/' . $salida->id, 'class' => 'form-group', 'id' => 'f', 'autocomplete' => 'off')) }}

                        <div class="form-group notempty has-feedback" id="cod">
                            {{ Form::label ('codigo', 'Número de Orden de Entrega', array('class' => 'control-label')) }}
                            {{ Form::text ('codigo', $salida->codigo, array('class' => 'form-control', 'placeholder'=>'Escribe el Número de Orden de Entrega', 'data-toggle'=>'tooltip', 'title'=>'Escribe el Número de Orden de Entrega', 'onkeypress' => 'return validarNumeros(event)')) }}
                            <span style="display:none;" id="icon_cod" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_cod">Debe llenar este campo con el Número de Orden de Entrega.</span>
                            <span style="display:none;" class="help-block" id="error_cod2">Este Número de Orden de Entrega ya ha sido Registrado.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="fec">
                            {{ Form::label ('fecha', 'Fecha de la Salida', array('class' => 'control-label')) }}
                            {{ Form::text ('fecha', $salida->fecha, array('class' => 'form-control', 'placeholder'=>'Indica la Fecha de la Salida', 'data-toggle'=>'tooltip', 'title'=>'Indica la Fecha de la Salida')) }}
                            <span style="display:none;" id="icon_fec" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_fec">Debe llenar este campo con la Fecha de la Salida.</span>
                        </div>

                        <div class="form-group notempty has-feedback" id="prov">
                            {{ Form::label ('idcliente', 'Cliente', array('class' => 'control-label')) }}
                            <select class="form-control" name="idcliente" id="idcliente" data-toggle="tooltip" title="Click aquí para seleccionar un Cliente">
                                <option value="">Seleccione un Cliente</option>
                                @foreach($clientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span style="display:none;" id="icon_prov" class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span style="display:none;" class="help-block" id="error_prov">Debe seleccionar un Cliente.</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group notemptyPRO has-feedback" id="prod">
                                    {{ Form::label ('producto', 'Código del Producto', array('class' => 'control-label')) }}
                                    {{ Form::text ('producto', '', array('class' => 'form-control mayusculas', 'placeholder'=>'Código del Producto', 'data-toggle'=>'tooltip', 'title'=>'Escriba el Código del Producto')) }}
                                    <span style="display:none;" id="icon_prod" class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span style="display:none;" class="help-block" id="error_prod">Debe indicar el Código del Producto</span>
                                    <span style="display:none;" class="help-block" id="error_prod2">Este Código no corresponde a ningún Producto registrado.</span>
                                    <span style="display:none;" class="help-block" id="error_prod3">No hay unidades de este Producto en el Lugar seleccionado.</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group notemptyPRO has-feedback" id="lug">
                                    {{ Form::label ('lugar', 'Lugar', array('class' => 'control-label')) }}
                                    <select class="form-control" name="lugar" id="lugar" data-toggle="tooltip" title="Click aquí para seleccionar el Lugar donde ingresará el Producto">
                                        <option value="">Seleccione un Lugar</option>
                                        @foreach($lugares as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <span style="display:none;" id="icon_lug" class="glyphicon glyphicon-remove form-control-feedback"></span>
                                    <span style="display:none;" class="help-block" id="error_lug">Debe seleccionar un Lugar.</span>
                                </div>
                            </div>                                
                        </div>

                        <a class="btn btn-success" id="agregar_producto" data-loading-text="Cargando...">
                            <span class="glyphicon glyphicon-plus"></span> <strong>Agregar Producto</strong>
                        </a><br><br>

                        <div class="form-group rowreq" id="agrpro">
                            <table id="tabla_productos" class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr align="center">
                                        <td width="10%"><strong>CÓDIGO</strong></td>
                                        <td width="26%"><strong>NOMBRE</strong></td>
                                        <td width="12%"><strong>LUGAR</strong></td>
                                        <td width="8%"><strong>EN STOCK</strong></td>
                                        <td width="13%"><strong>PRECIO VENTA</strong></td>
                                        <td width="12%"><strong>CANTIDAD</strong></td>
                                        <td width="12%"><strong>SUB TOTAL</strong></td>
                                        <td> </td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr align="center">
                                        <td colspan="6"><strong>TOTAL PRECIO DE VENTA</strong></td>
                                        <td>
                                            <strong>
                                                {{ Form::text ('costo', $salida->costo, array('class' => 'form-control', 'placeholder'=>'Total Precio', 'data-toggle'=>'tooltip', 'title'=>'TOTAL PRECIO VENTA', 'readonly', 'id'=>'costo')) }}
                                            </strong>
                                        </td>                                        
                                        <td> </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <span style="display:none;" class="help-block" id="error_agrpro">Debe agregar al menos un Producto para poder Registrar la Salida.</span>
                        </div> 
                        <input type="hidden" name="filasprod" id="filasprod" value="0"/>

                    {{ Form::close() }}

                    <button id="boton" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-thumbs-up"></span> <strong>Registrar Salida</strong>
                    </button>
                    <a href="{{ url('/salidas') }}" class="btn btn-default btn-lg">
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