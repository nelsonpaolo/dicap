@extends('layouts.master')
@section('title')
    Ver Usuario
@stop
@section('content')
<div class="row">
   <div class="col-md-1">
   </div>
   <div class="col-md-10">
      <div class="jumbotron">
         <div class="container">

            <legend> <strong>Datos del Usuario:</strong> {{ $user->real_name }} </legend>

            <ul class="list-group">
               <li class="list-group-item"> <strong>Nombre:</strong> {{ $user->real_name }} </li>
               <li class="list-group-item"> <strong>Teléfono:</strong> {{ $user->fono }} </li>
               <li class="list-group-item"> <strong>Dirección:</strong> {{ $user->direccion }} </li>
               <li class="list-group-item"> <strong>Username:</strong> {{ $user->username }} </li>
               <li class="list-group-item"> <strong>Rol:</strong> {{ $rol->rol }} </li>
               <li class="list-group-item"> <strong>Activo:</strong> {{ ($user->active) ? 'Sí' : 'No' }} </li>
            </ul>
            <br>
            <a href="{{ url('/users') }}" class="btn btn-default btn-lg">
               <span class="glyphicon glyphicon-arrow-left"></span> <strong>Volver</strong>
            </a>
         </div>
      </div>        
   </div>
</div> 
@stop
