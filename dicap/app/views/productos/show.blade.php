@extends('layouts.master')
@section('title')
   Ver Producto
@stop
@section('content')
<div class="row">
   <div class="col-md-1">
   </div>
   <div class="col-md-10">
      <div class="jumbotron">
         <div class="container">

            <legend> <strong>Datos del Producto:</strong> {{ $producto->codigo }} </legend>

            <?php
            $marca = Marcas::find($producto->marca);
            $categoria = Categorias::find($producto->categoria);
            if($producto->precio_compra > 0) {
               $precio_compra = $producto->precio_compra;
            }
            else {
               $precio_compra = 'No tiene';
            }
            if($producto->precio_venta > 0) {
               $precio_venta = $producto->precio_venta;
            }
            else {
               $precio_venta = 'No tiene';
            }
            ?>

            <table class="table table-bordered table-striped">
               <tbody>
                  <tr>
                     <td width="15%"><strong>Código:</strong></td>
                     <td>{{ $producto->codigo }}</td>
                  </tr>
                  <tr>
                     <td width="15%"><strong>Nombre:</strong></td>
                     <td>{{ $producto->nombre }}</td>
                  </tr>
                  <tr>
                     <td width="15%"><strong>Precio Compra (Referencial):</strong></td>
                     <td>{{ $precio_compra }}</td>
                  </tr>
                  <tr>
                     <td width="15%"><strong>Precio Venta (Referencial):</strong></td>
                     <td>{{ $precio_venta }}</td>
                  </tr>
                  <tr>
                     <td width="15%"><strong>Marca:</strong></td>
                     <td>{{ $marca->nombre }}</td>
                  </tr>
                  <tr>
                     <td width="15%"><strong>Categoría:</strong></td>
                     <td>{{ $categoria->nombre }}</td>
                  </tr>
               </tbody>
            </table>
            <br>
            <a href="{{ url('/productos') }}" class="btn btn-default btn-lg">
               <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
            </a>
         </div>
      </div>        
   </div>
</div> 
@stop
