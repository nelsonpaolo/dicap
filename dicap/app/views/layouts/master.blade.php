<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title> @yield('title') </title>

      {{ HTML::style('css/jquery-ui.css') }}
      {{ HTML::style('css/bootstrap.min.css') }}
      {{ HTML::style('css/formularios.css') }}
      {{ HTML::style('css/dataTables.bootstrap.css') }}

      {{ HTML::script('js/jquery.js') }}
      {{ HTML::script('js/jqueryui.js') }}
      {{ HTML::script('js/bootstrap.min.js') }}
      {{ HTML::script('js/bootbox.js') }}
      {{ HTML::script('js/formularios.js?1.1') }}
      {{ HTML::script('js/jquery.dataTables.min.js') }}
      {{ HTML::script('js/dataTables.bootstrap.js') }}

      <style type="text/css">
         body {
            padding-top: 5px;
         }
         .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
            background-color: #ACFA58;
         }
         .ui-datepicker .ui-state-active {
            background: orange;
            color: #FFFFFF;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <!-- El logotipo y el icono que despliega el menú se agrupan
         para mostrarlos mejor en los dispositivos móviles -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
               <span class="sr-only">Desplegar navegación</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            &nbsp;&nbsp;
            <a href="{{ url('/auth/welcome') }}">
               {{ HTML::image('imgs/logo_dicap.jpg', 'dicap', array('id' => 'dicap', 'height' => '50px'))  }}
            </a>
         </div>
         <!-- Agrupar los enlaces de navegación, los formularios y cualquier
         otro elemento que se pueda ocultar al minimizar la barra -->
         <div id="nav_opc" class="collapse navbar-collapse navbar-ex1-collapse">
            @if(Auth::check())

               <p class="navbar-text navbar-left">Has ingresado como:</p>
               <ul class="nav navbar-nav navbar-left">
                  <li>
                     <a href="{{ url('/auth/cambiar') }}" class="efecto" style="color: #5A6AD2;">
                        <strong>{{ Auth::user()->real_name }}</strong>
                     </a>
                  </li>
               </ul>

               <ul class="nav navbar-nav navbar-right">
                  <li>
                     <a href="{{ url('/auth/logout') }}" class="efecto" style="color: #5A6AD2;">
                        <strong>Cerrar sesión</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     </a>
                  </li>
               </ul>

               <ul class="nav navbar-nav navbar-right">
                  <li>
                     <a href="{{ url('/auth/welcome') }}">
                        <strong>Inicio</strong>
                     </a>
                  </li>
                  @if(Auth::user()->level == 5)
                     <li>
                        <a href="{{ url('/users') }}">
                           <strong>Usuarios</strong>
                        </a>
                     </li>
                  @endif
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <strong>Datos Primarios</strong> <b class="caret"></b>
                     </a>
                     <ul class="dropdown-menu">
                        <li>
                           <a href="{{ url('/productos') }}">
                              <span class="glyphicon glyphicon-briefcase"></span> <strong>Productos</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/lugares') }}">
                              <span class="glyphicon glyphicon-globe"></span> <strong>Lugares</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/marcas') }}">
                              <span class="glyphicon glyphicon-picture"></span> <strong>Marcas</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/categorias') }}">
                              <span class="glyphicon glyphicon-cog"></span> <strong>Categorías</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/clientes') }}">
                              <span class="glyphicon glyphicon-user"></span> <strong>Clientes</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/proveedores') }}">
                              <span class="glyphicon glyphicon-user"></span> <strong>Proveedores</strong>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <strong>Movimientos</strong> <b class="caret"></b>
                     </a>
                     <ul class="dropdown-menu">
                        <li>
                           <a href="{{ url('/ingresos') }}">
                              <span class="glyphicon glyphicon-circle-arrow-right"></span> <strong>Ingresos</strong>
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/salidas') }}">
                              <span class="glyphicon glyphicon-circle-arrow-left"></span> <strong>Salidas</strong>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="{{ url('/reportes/stock') }}">
                        <strong>Stock</strong>
                     </a>
                  </li>
               </ul>
            @endif
         </div>
      </nav>
      <br><br><br><br>
      @yield('content')
   </body>
</html>