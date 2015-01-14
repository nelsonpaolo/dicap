@extends('layouts.master')
@section('title')
	Panel Principal
@stop
@section('content')

{{ HTML::script('js/welcome.js') }}

	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="jumbotron">
				<div class="container">
					
					<div class="panel panel-primary" id="panel">
						<div class="panel-heading">
							<strong>PANEL PRINCIPAL</strong>
						</div>
						<ul class="list-group">
							@if(Auth::user()->level == 5)
							<li class="list-group-item">
								<a href="{{ url('/users') }}">
			                        <span class="glyphicon glyphicon-user"></span> <strong>Usuarios</strong>
			                    </a>
							</li>
							@endif
							<li class="list-group-item">
	                            <a href="{{ url('/productos') }}">
	                              <span class="glyphicon glyphicon-briefcase"></span> <strong>Productos</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
								<a href="{{ url('/lugares') }}">
									<span class="glyphicon glyphicon-globe"></span> <strong>Lugares</strong>
								</a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/marcas') }}">
	                               <span class="glyphicon glyphicon-picture"></span> <strong>Marcas</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/categorias') }}">
	                               <span class="glyphicon glyphicon-cog"></span> <strong>Categorías</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/clientes') }}">
	                               <span class="glyphicon glyphicon-user"></span> <strong>Clientes</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/proveedores') }}">
	                               <span class="glyphicon glyphicon-user"></span> <strong>Proveedores</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/ingresos') }}">
	                               <span class="glyphicon glyphicon-circle-arrow-right"></span> <strong>Ingresos</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/salidas') }}">
	                               <span class="glyphicon glyphicon-circle-arrow-left"></span> <strong>Salidas</strong>
	                            </a>
	                        </li>
	                        <li class="list-group-item">
	                            <a href="{{ url('/reportes/stock') }}">
	                               <span class="glyphicon glyphicon-list"></span> <strong>Stock</strong>
	                            </a>
	                        </li>
						</ul>
					</div>

				</div>
			</div>		    
		</div>
	</div>  
@stop