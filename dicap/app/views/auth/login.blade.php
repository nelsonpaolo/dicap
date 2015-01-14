@extends('layouts.master')
@section('title')
   Ingreso al Sistema
@stop
@section('content')
   <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
         <div align="center" class="alert alert-info">
            <h3> <strong>DICAP - SISTEMA DE CONTROL Y GESTIÓN DE STOCK </strong></h3>
         </div>
         <div class="page-header">
            <h2>INGRESO AL SISTEMA</h2>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-1">
      </div>

      <div class="col-md-4">

         @if(isset($error))
         <div class="alert alert-danger">
            <strong> {{ $error }} </strong>
         </div>
         @endif
         
         {{ Form::open(array('url' => 'auth/login', 'class' => 'form-group')) }}
            <div class="form-group">
               {{ Form::label('username', 'Username') }}
               {{ Form::text('username', '', array('class' => 'form-control', 'placeholder'=>'Escribe tu Username')) }}
            </div>
            <div class="form-group">
               {{ Form::label('password', 'Contraseña') }}
               <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu Password">
            </div>
            {{ Form::submit('Ingresar', array('class'=>'btn btn-primary btn-lg')) }}
         {{ Form::close() }}
      </div>
   </div>
@stop