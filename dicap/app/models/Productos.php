<?php
class Productos extends Eloquent {

   protected $table = 'productos';

   /**
    * función que retorna todos los productos donde la marca sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_marca($id) {

      $query = DB::select("SELECT * FROM productos WHERE marca ='".$id."'");

      return $query;
   }

   /**
    * función que retorna todos los productos donde la categoria sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_categoria($id) {

      $query = DB::select("SELECT * FROM productos WHERE categoria ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna los datos del producto del cual su codigo es el codigo proporcionado
    * @param  string $codigo
    * @return array $query
    */
   public static function get_producto($codigo) {

      $query = Productos::where('codigo', $codigo)->first();
      //$query = DB::select("SELECT * FROM productos WHERE codigo ='".$codigo."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los productos menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_producto($id) {

      $query = DB::select("SELECT * FROM productos WHERE id !=".$id);

      return $query;
   }

   /**
    * función que aumenta la cantidad del producto con la cantidad indicada y que tiene su id igual al proporcionado
    * @param  int $idproducto
    * @param  int $cantidad
    */
   public static function agregar_cantidad($idproducto, $cantidad) {

      $producto = Productos::find($idproducto);

      $producto->cantidad = $producto->cantidad + $cantidad;

      $producto->save();
   }

   /**
    * función que disminuye la cantidad del producto restando la cantidad indicada y el producto debe tener su id igual al proporcionado
    * @param  int $idproducto
    * @param  int $cantidad
    */
   public static function disminuir_cantidad($idproducto, $cantidad) {

      $producto = Productos::find($idproducto);

      $producto->cantidad = $producto->cantidad - $cantidad;

      $producto->save();
   }

}
