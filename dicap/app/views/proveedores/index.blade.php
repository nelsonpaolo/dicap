@extends('layouts.master')
@section('title')
   Proveedores
@stop
@section('content')
<script type="text/javascript">
   var ajaxUrlProveedorBuscar = "{{ action('ValidacionesController@getProveedorBuscar') }}";
</script>

{{ HTML::script('js/proveedores/proveedor_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Proveedores</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/proveedores/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Proveedor</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Crear">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Proveedor</strong>
                     </a>
                  </p>
               @endif

               @if($proveedores->count())
                  <table id="tabla_proveedores" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="25%"> <strong>Nombre</strong> </td>
                           <td width="25%"> <strong>Teléfono</strong> </td>
                           <td width="25%"> <strong>Dirección</strong> </td>
                           <td> </td>
                           <td> </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($proveedores as $item)
                        <tr>
                           <td> {{ $item->nombre }} </td>
                           <td> {{ $item->fono }} </td>
                           <td> {{ $item->direccion }} </td>
                           <td align="center">
                              @if(Auth::check() and Auth::user()->level > 1)
                                 <a href="{{ url('/proveedores/'.$item->id.'/edit') }}" class="btn btn-warning">
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
                                 {{ Form::open(array('url' => 'proveedores/'.$item->id, 'id' => $item->id)) }}
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
                     <strong> Aún no hay Proveedores registrados !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop