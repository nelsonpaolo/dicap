@extends('layouts.master')
@section('title')
   Ver Ingreso
@stop
@section('content')

<script type="text/javascript">
$(document).ready(function() {

   $('#boton_excel').on('click', clickExcel);

   function clickExcel() {
      $('#f_excel').submit();
   }
});
</script>

<div class="row">
   <div class="col-md-1">
   </div>
   <div class="col-md-10">
      <div class="jumbotron">
         <div class="container">

            <legend> <strong>Ingreso:</strong> {{ $ingreso->codigo }} </legend>

            <table class="table table-bordered table-striped">
               <tbody>
                  <tr>
                     <td width="25%"><strong>Número de Orden de Remisión:</strong></td>
                     <td>{{ $ingreso->codigo }}</td>
                  </tr>
                  <tr>
                     <td width="25%"><strong>Fecha del Ingreso:</strong></td>
                     <td>{{ Fechas::formatoCompleto($ingreso->fecha) }}</td>
                  </tr>
                  <tr>
                     <td width="25%"><strong>Nombre del Proveedor:</strong></td>
                     <td>{{ $proveedor->nombre }}</td>
                  </tr>
               </tbody>
            </table>
            <h4>Detalle:</h4>
            <table id="tabla_productos" class="table table-bordered table-striped table-hover table-condensed">
               <thead>
                  <tr align="center">
                     <td width="14%"><strong>CÓDIGO PRODUCTO</strong></td>
                     <td width="28%"><strong>NOMBRE PRODUCTO</strong></td>
                     <td width="12%"><strong>LUGAR</strong></td>
                     <td width="13%"><strong>PRECIO COMPRA</strong></td>
                     <td width="10%"><strong>CANTIDAD</strong></td>
                     <td width="13%"><strong>SUB TOTAL</strong></td>
                  </tr>
               </thead>
               <tbody>
                  @foreach($ingresos as $item)
                     <?php
                     $producto = Productos::find($item->idproducto);
                     $lugar = Lugares::find($item->idlugar);
                     ?>
                     <tr class="flagprod">
                        <td>
                           {{ $producto->codigo }}
                        </td>
                        <td>
                           {{ $producto->nombre }}
                        </td>
                        <td>
                           {{ $lugar->nombre }}
                        </td>
                        <td align="center">
                           {{ round($item->precio_compra * 100) / 100 }}
                        </td>
                        <td align="center">
                           {{ $item->cantidad }}
                        </td>
                        <td align="center">
                           {{ round($item->precio_compra * $item->cantidad * 100) / 100 }}
                        </td>
                     </tr>
                  @endforeach
               </tbody>
               <tfoot>
                  <tr align="center">
                     <td colspan="5"><strong>TOTAL PRECIO DE COMPRA</strong></td>
                     <td>
                        <strong>
                           {{ round($ingreso->costo * 100) / 100 }}
                        </strong>
                     </td>
                  </tr>
               </tfoot>
            </table>
            <br>
            <a href="{{ url('/ingresos') }}" class="btn btn-default btn-lg">
               <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
            </a>
            <a href="{{ url('/ingresopdf/'.$ingreso->id) }}" class="btn btn-danger btn-lg">
               <span class="glyphicon glyphicon-download-alt"></span> <strong>PDF</strong>
            </a>
            <a class="btn btn-success btn-lg" id="boton_excel">
               <span class="glyphicon glyphicon-download-alt"></span> <strong>EXCEL</strong>
            </a>
            {{ Form::open(array('url' => 'ingresoexcel', 'id' => 'f_excel')) }}
               <input type="hidden" name="idingreso" value="{{ $ingreso->id }}">
            {{ Form::close() }}
         </div>
      </div>        
   </div>
</div> 
@stop
