@extends('layouts.master')
@section('title')
    Ver Lugar
@stop
@section('content')

<script type="text/javascript">
    var urlPdf = "{{ url('/lugarpdf') }}",
        urlExcel = "{{ url('/lugarexcel') }}";
</script>

{{ HTML::script('js/productos/producto_index.js') }}
{{ HTML::script('js/lugares/lugar_show.js') }}

    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <div class="jumbotron">
                <div class="container">

                    <legend> <strong>Nombre del Lugar: </strong>{{ $lugar->nombre }} </legend>

                    @if(count($productos) > 0)
                        
                        <h4>Cantidad Total Almacenada: {{ $total }}</h4>
                    
                        {{ Form::open(array('url' => '#', 'id' => 'f_lugar')) }}

                            <input type="hidden" name="lugar" value="{{ $lugar->nombre }}">
                            <input type="hidden" name="total" value="{{ $total }}">

                            <table id="tabla_productos" class="table table-bordered table-striped table-hover table-condensed">
                                <thead>
                                <tr align="center">
                                    <td width="20%"> <strong>CÓDIGO DEL PRODUCTO</strong> </td>
                                    <td width="35%"> <strong>NOMBRE DEL PRODUCTO</strong> </td>
                                    <td width="15%"> <strong>MARCA</strong> </td>
                                    <td width="15%"> <strong>CATEGORÍA</strong> </td>
                                    <td width="15%"> <strong>CANTIDAD</strong> </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $cont = 0;?>
                                @foreach($productos as $item)
                                    <?php
                                    $cont++;
                                    $producto = Productos::find($item->idproducto);
                                    $marca = Marcas::find($producto->marca);
                                    $categoria = Categorias::find($producto->categoria);
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="codigo{{ $cont }}" value="{{ $producto->codigo }}">
                                            {{ $producto->codigo }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="nombre{{ $cont }}" value="{{ $producto->nombre }}">
                                            {{ $producto->nombre }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="marca{{ $cont }}" value="{{ $marca->nombre }}">
                                            {{ $marca->nombre }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="categoria{{ $cont }}" value="{{ $categoria->nombre }}">
                                            {{ $categoria->nombre }}
                                        </td>
                                        <td align="center">
                                            <input type="hidden" class="suma" name="cantidad{{ $cont }}" value="{{ $item->cantidad }}">
                                            {{ $item->cantidad }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr align="center">
                                        <td colspan="4">
                                            <strong>Total</strong>
                                        </td>
                                        <td>
                                            <strong><label class="total">{{ $total }}</label></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <input type="hidden" name="filas" value="{{ $cont }}">                            
                        {{ Form::close() }}

                        <a href="{{ url('/lugares') }}" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
                        </a>

                        <button id="pdf" class="btn btn-danger btn-lg">
                            <span class="glyphicon glyphicon-download-alt"></span> <strong>PDF</strong>
                        </button>

                        <button id="excel" class="btn btn-success btn-lg">
                            <span class="glyphicon glyphicon-download-alt"></span> <strong>EXCEL</strong>
                        </button>
                    @else
                        <div align="center" class="alert alert-info">
                            <strong> No hay productos almacenados en este lugar !!! </strong>
                        </div>

                        <a href="{{ url('/lugares') }}" class="btn btn-default btn-lg">
                            <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
                        </a>
                    @endif
                </div>
            </div>        
        </div>
    </div>    
@stop