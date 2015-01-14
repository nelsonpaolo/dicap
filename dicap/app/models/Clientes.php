<?php
class Clientes extends Eloquent {

   protected $table = 'clientes';

   /**
    * funcion que retorna los datos del cliente del cual su nombre es el nombre proporcionado
    * @param  string $nombre
    * @return array $query
    */
   public static function get_cliente($nombre) {

      $query = DB::select("SELECT * FROM clientes WHERE nombre ='".$nombre."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los clientes menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_cliente($id) {

      $query = DB::select("SELECT * FROM clientes WHERE id !=".$id);

      return $query;
   }

}
