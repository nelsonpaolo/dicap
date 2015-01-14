@extends('layouts.master')
@section('title')
   Clientes
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlClienteBuscar = "{{ action('ValidacionesController@getClienteBuscar') }}";
</script>

{{ HTML::script('js/clientes/cliente_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Clientes</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/clientes/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Cliente</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Crear">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Cliente</strong>
                     </a>
                  </p>
               @endif

               @if($clientes->count())
                  <table id="tabla_clientes" class="table table-bordered table-striped table-hover table-condensed">
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
                        @foreach($clientes as $item)
                        <tr>
                           <td> {{ $item->nombre }} </td>
                           <td> {{ $item->fono }} </td>
                           <td> {{ $item->direccion }} </td>
                           <td align="center">
                              @if(Auth::check() and Auth::user()->level > 1)
                                 <a href="{{ url('/clientes/'.$item->id.'/edit') }}" class="btn btn-warning">
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
                                 {{ Form::open(array('url' => 'clientes/'.$item->id, 'id' => $item->id)) }}
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
                     <strong> Aún no hay Clientes registrados !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop