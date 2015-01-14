<?php
class Lugares extends Eloquent {

   protected $table = 'lugares';

   /**
    * funcion que retorna los datos del lugar del cual su nombre es el nombre proporcionado
    * @param  string $nombre
    * @return array $query
    */
   public static function get_lugar($nombre) {

      $query = DB::select("SELECT * FROM lugares WHERE nombre ='".$nombre."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los lugares menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_lugar($id) {

      $query = DB::select("SELECT * FROM lugares WHERE id !=".$id);

      return $query;
   }

}
