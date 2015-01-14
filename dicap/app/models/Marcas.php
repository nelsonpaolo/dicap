<?php
class Marcas extends Eloquent {

   protected $table = 'marcas';

   /**
    * funcion que retorna los datos del marca del cual su nombre es el nombre proporcionado
    * @param  string $nombre
    * @return array $query
    */
   public static function get_marca($nombre) {

      $query = DB::select("SELECT * FROM marcas WHERE nombre ='".$nombre."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los marcas menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_marca($id) {

      $query = DB::select("SELECT * FROM marcas WHERE id !=".$id);

      return $query;
   }

}
