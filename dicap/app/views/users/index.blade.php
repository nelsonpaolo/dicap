@extends('layouts.master')
@section('title')
    Usuarios
@stop
@section('content')

{{ HTML::script('js/users/user_index.js') }}
    
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div class="jumbotron">
            <div class="container">

               <legend> <strong>Usuarios</strong> </legend>

               @if(Session::has('notice'))
                  <div class="alert alert-success"><strong> {{ Session::get('notice') }} </strong></div>
               @endif

               <p>
                  <a href="{{ url('/users/create') }}" class="btn btn-success btn-lg">
                     <span class="glyphicon glyphicon-plus"></span> <strong>Crear Nuevo Usuario</strong>
                  </a>
               </p>

               @if($users->count())
                  <table id="tabla_users" class="table table-bordered table-striped table-hover table-condensed paginacion">
                     <thead>
                        <tr>
                        <th> Nombre Real </th>
                        <th> Teléfono </th>
                        <th> Dirección </th>
                        <th> Username </th>
                        <th> Rol </th>
                        <th> Estado </th>
                        <th> </th>
                        <th> </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($users as $item)
                        <?php $rol = Roles::find($item->level);?>
                        <tr>
                           <td> {{ $item->real_name }} </td>
                           <td> {{ $item->fono }} </td>
                           <td> {{ $item->direccion }} </td>
                           <td> {{ $item->username }} </td>
                           <td> {{ $rol->rol }} </td>
                           <td> {{ ($item->active) ? 'Activo' : 'Inactivo' }} </td>
                           <td align="center">
                              <a href="{{ url('/users/'.$item->id) }}" class="btn btn-info">
                                 <span class="glyphicon glyphicon-search"></span> <strong>Ver</strong>
                              </a>
                           </td>
                           <td align="center">
                              <a href="{{ url('/users/'.$item->id.'/edit') }}" class="btn btn-warning">
                                 <span class="glyphicon glyphicon-pencil"></span> <strong>Editar</strong>
                              </a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
               <div class="alert alert-info"><strong> No se han encontrado usuarios </strong></div>
               @endif
            </div>
         </div>        
      </div>
   </div>
@stop