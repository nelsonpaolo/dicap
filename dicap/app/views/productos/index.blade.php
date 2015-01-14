@extends('layouts.master')
@section('title')
   Productos
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlProductoBuscar = "{{ action('ValidacionesController@getProductoBuscar') }}";
</script>

{{ HTML::script('js/productos/producto_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Productos</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/productos/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Producto</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Crear">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Producto</strong>
                     </a>
                  </p>
               @endif

               @if($productos->count())
                  <table id="tabla_productos" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="15%"> <strong>Código</strong> </td>
                           <td width="30%"> <strong>Nombre</strong> </td>
                           <td width="15%"> <strong>Marca</strong> </td>
                           <td width="15%"> <strong>Categoría</strong> </td>
                           <td> </td>
                           <td> </td>
                           <td> </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($productos as $item)
                        <?php
                        $marca = Marcas::find($item->marca);
                        $categoria = Categorias::find($item->categoria);
                        ?>
                        <tr>
                           <td> {{ $item->codigo }} </td>
                           <td> {{ $item->nombre }} </td>
                           <td> {{ $marca->nombre }} </td>
                           <td> {{ $categoria->nombre }} </td>
                           <td align="center">
                              <a href="{{ url('/productos/'.$item->id) }}" class="btn btn-info">
                                 <span class="glyphicon glyphicon-search"></span> <strong>Ver</strong>
                              </a>
                           </td>
                           <td align="center">
                              @if(Auth::check() and Auth::user()->level > 1)
                                 <a href="{{ url('/productos/'.$item->id.'/edit') }}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil"></span> <strong>Editar</strong>
                                 </a>
                              @else
                                 <a class="btn btn-warning" data-toggle="tooltip" title="No tienes permiso para Editar">
                                    <span class="glyphicon glyphicon-pencil"></span> <strong>Editar</strong>
                                 </a>
                              @endif
                           </td>
                           <td align="center">
                              @if(Auth::check() and Auth::user()->level > 1)
                                 {{ Form::open(array('url' => 'productos/'.$item->id, 'id' => $item->id)) }}
                                    {{ Form::hidden("_method", "DELETE") }}                                  
                                 {{ Form::close() }}
                                 <button class="btn btn-danger" id="{{ $item->id.'^'.$item->nombre }}" onclick="borrar(this.id)">
                                    <span class="glyphicon glyphicon-trash"></span> <strong>Eliminar</strong>
                                 </button>
                              @else
                                 <a class="btn btn-danger" data-toggle="tooltip" title="No tienes permiso para Eliminar">
                                    <span class="glyphicon glyphicon-trash"></span> <strong>Eliminar</strong>
                                 </a>
                              @endif
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
                  <div align="center" class="alert alert-info">
                     <strong> Aún no hay Productos registrados !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop