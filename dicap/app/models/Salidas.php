<?php
class Salidas extends Eloquent {

   protected $table = 'salidas';

   /**
    * función que retorna todos los registros donde el idcliente sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_cliente($id) {

      $query = DB::select("SELECT * FROM salidas WHERE idcliente ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna los datos de la salida del cual su codigo es el codigo proporcionado
    * @param  string $codigo
    * @return array $query
    */
   public static function get_salida($codigo) {

      $query = DB::select("SELECT * FROM salidas WHERE codigo ='".$codigo."'");

      return $query;
   }

   /**
    * función que retorna los datos de todas las salidas menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_salida($id) {

      $query = DB::select("SELECT * FROM salidas WHERE id !=".$id);

      return $query;
   }

}
