<?php
class Proveedores extends Eloquent {

   protected $table = 'proveedores';

   /**
    * funcion que retorna los datos del proveedor del cual su nombre es el nombre proporcionado
    * @param  string $nombre
    * @return array $query
    */
   public static function get_proveedor($nombre) {

      $query = DB::select("SELECT * FROM proveedores WHERE nombre ='".$nombre."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los proveedores menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_proveedor($id) {

      $query = DB::select("SELECT * FROM proveedores WHERE id !=".$id);

      return $query;
   }

}
