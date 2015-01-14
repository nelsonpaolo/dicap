@extends('layouts.master')
@section('title')
   Salidas
@stop
@section('content')

{{ HTML::script('js/salidas/salida_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Salidas</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/salidas/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Registrar una Nueva Salida</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Registrar">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Registrar una Nueva Salida</strong>
                     </a>
                  </p>
               @endif

               @if($salidas->count())
                  <table id="tabla_salidas" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="20%"> <strong>Nº de Orden de Entrega</strong> </td>
                           <td width="25%"> <strong>Cliente</strong> </td>
                           <td width="10%"> <strong>Fecha</strong> </td>
                           <td width="35%"> <strong><label style="color: green;"> Código de Producto </label> - <label style="color: red;"> Lugar <label> - <label style="color: blue;"> Cantidad <label></strong> </td>
                           <td> </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($salidas as $item)
                        <?php
                        $cliente = Clientes::find($item->idcliente);
                        $asociados = Salidaproductos::get_salidas($item->id);
                        ?>
                        <tr>
                           <td> {{ $item->codigo }} </td>
                           <td> {{ $cliente->nombre }} </td>
                           <td> {{ Fechas::formatoDiaMesAnio($item->fecha) }} </td>
                           <td>
                              <ul>
                                 <?php
                                 foreach($asociados as $value) {
                                    $producto = Productos::find($value->idproducto);
                                    $lugar = Lugares::find($value->idlugar);
                                    echo '<li><label style="color: green;">'.$producto->codigo.'</label> - <label style="color: red;">'.$lugar->nombre.'</label> - <label style="color: blue;">'.$value->cantidad.'</label></li>';
                                 }
                                 ?>
                              </ul>                                 
                           </td>
                           <td align="center">
                              <a href="{{ url('/salidas/'.$item->id) }}" class="btn btn-info">
                                 <span class="glyphicon glyphicon-search"></span> <strong>Ver</strong>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
                  <div align="center" class="alert alert-info">
                     <strong> Aún no hay Salidas registrados !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop