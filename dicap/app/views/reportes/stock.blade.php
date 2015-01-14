@extends('layouts.master')
@section('title')
   Stock
@stop
@section('content')

{{ HTML::script('js/productos/producto_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Stock</strong> </legend>

               @if($productos->count())
                  <table id="tabla_productos" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="10%"> <strong>Código</strong> </td>
                           <td width="30%"> <strong>Nombre</strong> </td>
                           <td width="10%"> <strong>Marca</strong> </td>
                           <td width="10%"> <strong>Categoría</strong> </td>
                           <td width="10%"> <strong>Cantidad Total</strong> </td>
                           <td width="30%">
                           	<strong>
                           		<label style="color: red;"> Lugar </label> - 
                           		<label style="color: blue;"> Cantidad Parcial </label>
                           	</strong>
                           </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($productos as $item)
                        <?php
                        $marca = Marcas::find($item->marca);
                        $categoria = Categorias::find($item->categoria);
                        $asociados = Lugarproductos::get_producto($item->id);
                        ?>
						<tr>
							<td> {{ $item->codigo }} </td>
							<td> {{ $item->nombre }} </td>
							<td> {{ $marca->nombre }} </td>
							<td> {{ $categoria->nombre }} </td>
							<td align="center"> {{ $item->cantidad }} </td>
							<td>
								<ul>
									<?php
									foreach($asociados as $value) {
										$lugar = Lugares::find($value->idlugar);
										echo '<li><label style="color: red;">'.$lugar->nombre.'</label> - <label style="color: blue;">'.$value->cantidad.'</label></li>';
									}
									?>
								</ul>
								</td>
						</tr>	                        
                        @endforeach
                     </tbody>
                  </table>
               @else
                  <div align="center" class="alert alert-info">
                     <strong> Aún no hay Productos en Stock !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop