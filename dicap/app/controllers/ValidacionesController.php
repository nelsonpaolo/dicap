<?php
class ValidacionesController extends BaseController {

   public function getUserAlta() {
      $username = Input::get('username');
      $user = User::get_user($username);
      if($user) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getUserEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $username = Input::get('username');
      $users = User::get_not_user($id);
      foreach ($users as $user) {
         if($username == $user->username) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getPassValido() {
      $pass = Input::get('pass');
      $id = Auth::user()->id;
      $datos = User::find($id);
      $user_data = array(
         'username' => $datos->username,
         'password' => $pass,
         'active' => true
      );      
      if(Auth::attempt($user_data)){
         echo 'ok';
      }
      else
         echo 'duplicado';
   }

   public function postActualizarPass() {
      $newpass = Input::get('nuevopass');
      $id = Auth::user()->id;
      $datos = User::find($id);
      $datos->password = Hash::make($newpass);
      $datos->save();
      echo 'ok';  
   }

   public function getLugarAlta() {
      $nombre = Str::upper(Input::get('nombre'));
      $lugar = Lugares::get_lugar($nombre);
      if($lugar) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getLugarEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $nombre = Str::upper(Input::get('nombre'));
      $lugares = Lugares::get_not_lugar($id);
      foreach ($lugares as $lugar) {
         if($nombre == $lugar->nombre) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getLugarBuscar() {
      $bandera = 0;
      $id = Input::get('id');
      $prodlug = Lugarproductos::get_lugar($id);
      $proding = Ingresoproductos::get_lugar($id);
      $prodsal = Salidaproductos::get_lugar($id);

      if($prodlug) {
         $bandera = 1;
      }
      if($proding) {
         $bandera = 1;
      }
      if($prodsal) {
         $bandera = 1;
      }

      if($bandera == 1) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getMarcaAlta() {
      $nombre = Str::upper(Input::get('nombre'));
      $marca = Marcas::get_marca($nombre);
      if($marca) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getMarcaEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $nombre = Str::upper(Input::get('nombre'));
      $marcas = Marcas::get_not_marca($id);
      foreach ($marcas as $marca) {
         if($nombre == $marca->nombre) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getMarcaBuscar() {

      $bandera = 0;

      $id = Input::get('id');
      $prodmar = Productos::get_marca($id);
      $prodcat = Categorias::get_marca($id);

      if($prodmar) {
         $bandera = 1;
      }
      if($prodcat) {
         $bandera = 1;
      }

      if($bandera == 1) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getCategoriaAlta() {
      $nombre = Str::upper(Input::get('nombre'));
      $marca = Input::get('marca');
      $cate = Categorias::get_categoria($nombre, $marca);
      if($cate) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getCategoriaEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $nombre = Str::upper(Input::get('nombre'));
      $marca = Input::get('marca');
      $cates = Categorias::get_not_categoria($id);
      foreach ($cates as $cate) {
         if($nombre == $cate->nombre && $marca == $cate->marca) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getCategoriaBuscar() {

      $id = Input::get('id');
      $prodcat = Productos::get_categoria($id);

      if($prodcat) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getClienteAlta() {
      $nombre = Str::upper(Input::get('nombre'));
      $cliente = Clientes::get_cliente($nombre);
      if($cliente) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getClienteEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $nombre = Str::upper(Input::get('nombre'));
      $clientes = Clientes::get_not_cliente($id);
      foreach ($clientes as $cliente) {
         if($nombre == $cliente->nombre) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getClienteBuscar() {
      $id = Input::get('id');
      $clisal = Salidas::get_cliente($id);

      if($clisal) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getProductoAlta() {
      $codigo = Str::upper(Input::get('codigo'));
      $producto = Productos::get_producto($codigo);
      if($producto) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getProductoEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $codigo = Str::upper(Input::get('codigo'));
      $productos = Productos::get_not_producto($id);
      foreach ($productos as $producto) {
         if($codigo == $producto->codigo) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getProductoBuscar() {
      $bandera = 0;
      $id = Input::get('id');
      $prodlug = Lugarproductos::get_producto($id);
      $proding = Ingresoproductos::get_producto($id);
      $prodsal = Salidaproductos::get_producto($id);

      if($prodlug) {
         $bandera = 1;
      }
      if($proding) {
         $bandera = 1;
      }
      if($prodsal) {
         $bandera = 1;
      }

      if($bandera == 1) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getCategorias() {

      $marca = Input::get('marca');

      $categorias = Categorias::get_categoria_x_marca($marca);

      return json_encode($categorias);
   }

   public function getProveedorAlta() {
      $nombre = Str::upper(Input::get('nombre'));
      $proveedor = Proveedores::get_proveedor($nombre);
      if($proveedor) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getProveedorEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $nombre = Str::upper(Input::get('nombre'));
      $proveedores = Proveedores::get_not_proveedor($id);
      foreach ($proveedores as $proveedor) {
         if($nombre == $proveedor->nombre) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getProveedorBuscar() {
      $id = Input::get('id');
      $provsal = Ingresos::get_proveedor($id);

      if($provsal) {
         echo 'no_se_puede';
      }
      else {
         echo 'ok';
      }
   }

   public function getIngresoAlta() {
      $codigo = Str::upper(Input::get('codigo'));
      $ingreso = Ingresos::get_ingreso($codigo);
      if($ingreso) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getIngresoEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $codigo = Str::upper(Input::get('codigo'));
      $ingresos = Ingresos::get_not_ingreso($id);
      foreach ($ingresos as $ingreso) {
         if($codigo == $ingreso->codigo) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getDatosProdLug() {
      $resp = array();
      $codigo = Str::upper(Input::get('codigo'));
      $idlugar = Input::get('idlugar');
      $producto = Productos::get_producto($codigo);
      if($producto) {
         $lugar = Lugares::find($idlugar);
         $resp['idproducto'] = $producto->id;
         $resp['producto'] = $producto->nombre;
         $resp['precio'] = $producto->precio_compra;
         $resp['lugar'] = $lugar->nombre;
      }
      else {
         $resp['producto'] = 'no_registrado';
      }
      echo json_encode($resp);
   }

   public function getSalidaAlta() {
      $codigo = Str::upper(Input::get('codigo'));
      $salida = Salidas::get_salida($codigo);
      if($salida) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getSalidaEdit() {
      $bandera = 0;
      $id = Input::get('id');
      $codigo = Str::upper(Input::get('codigo'));
      $salidas = Salidas::get_not_salida($id);
      foreach ($salidas as $salida) {
         if($codigo == $ingreso->codigo) {
            $bandera = 1;
         }
      }
      if($bandera == 1) {
         echo 'duplicado';
      }
      else {
         echo 'ok';
      }
   }

   public function getDatosProdLugSalida() {
      $resp = array();
      $codigo = Str::upper(Input::get('codigo'));
      $idlugar = Input::get('idlugar');
      $producto = Productos::get_producto($codigo);
      if($producto) {
         $stock = Lugarproductos::get_producto_lugar($producto->id, $idlugar);
         if(count($stock) > 0 && $stock->cantidad > 0) {
            $lugar = Lugares::find($idlugar);
            $resp['idproducto'] = $producto->id;
            $resp['producto'] = $producto->nombre;
            $resp['precio'] = $producto->precio_venta;
            $resp['lugar'] = $lugar->nombre;
            $resp['stock'] = $stock->cantidad;
         }
         else {
            $resp['producto'] = 'no_hay';
         }
      }
      else {
         $resp['producto'] = 'no_registrado';
      }
      echo json_encode($resp);
   }
}