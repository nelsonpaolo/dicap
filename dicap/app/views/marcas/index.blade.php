@extends('layouts.master')
@section('title')
   Marcas
@stop
@section('content')
<script type="text/javascript">
    var ajaxUrlMarcaBuscar = "{{ action('ValidacionesController@getMarcaBuscar') }}";
</script>

{{ HTML::script('js/marcas/marca_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Marcas</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               @if(Auth::check() and Auth::user()->level > 1)
                  <p>
                     <a href="{{ url('/marcas/create') }}" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nueva Marca</strong>
                     </a>
                  </p>
               @else
                  <p>
                     <a class="btn btn-success btn-lg" data-toggle="tooltip" title="No tienes permiso para Crear">
                        <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nueva Marca</strong>
                     </a>
                  </p>
               @endif

               @if($marcas->count())
                  <table id="tabla_marcas" class="table table-bordered table-striped table-hover table-condensed">
                     <thead>
                        <tr align="center">
                           <td width="60%"> <strong>Nombre de la Marca</strong> </td>
                           <td> </td>
                           <td> </td>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($marcas as $item)
                        <tr>
                           <td> {{ $item->nombre }} </td>
                           <td align="center">
                              @if(Auth::check() and Auth::user()->level > 1)
                                 <a href="{{ url('/marcas/'.$item->id.'/edit') }}" class="btn btn-warning">
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
                                 {{ Form::open(array('url' => 'marcas/'.$item->id, 'id' => $item->id)) }}
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
                     <strong> Aún no hay Marcas registradas !!! </strong>
                  </div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop