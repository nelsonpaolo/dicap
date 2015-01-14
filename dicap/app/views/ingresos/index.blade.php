@extends('layouts.master')
@section('title')
   Ingresos
@stop
@section('content')

{{ HTML::script('js/ingresos/ingreso_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Ingresos</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/ingresos/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Registrar un Nuevo Ingreso</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Registrar">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Registrar un Nuevo Ingreso</strong>
                     </a>
                  </p>
               @endif

               @if($ingresos->count())
                  <table id="tabla_ingresos" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="20%"> <strong>Nº de Orden de Remisión</strong> </td>
                           <td width="25%"> <strong>Proveedor</strong> </td>
                           <td width="10%"> <strong>Fecha</strong> </td>
                           <td width="35%"> <strong><label style="color: green;"> Código de Producto </label> - <label style="color: red;"> Lugar <label> - <label style="color: blue;"> Cantidad <label></strong> </td>
                           <td> </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($ingresos as $item)
                        <?php
                        $proveedor = Proveedores::find($item->idproveedor);
                        $asociados = Ingresoproductos::get_ingresos($item->id);
                        ?>
                        <tr>
                           <td> {{ $item->codigo }} </td>
                           <td> {{ $proveedor->nombre }} </td>
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
                              <a href="{{ url('/ingresos/'.$item->id) }}" class="btn btn-info">
                                 <span class="glyphicon glyphicon-search"></span> <strong>Ver</strong>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
                  <div align="center" class="alert alert-info">
                     <strong> Aún no hay Ingresos registrados !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop