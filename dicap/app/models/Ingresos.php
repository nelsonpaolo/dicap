<?php
class Ingresos extends Eloquent {

   protected $table = 'ingresos';

   /**
    * función que retorna todos los registros donde el idproveedor sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_proveedor($id) {

      $query = DB::select("SELECT * FROM ingresos WHERE idproveedor ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna los datos del ingreso del cual su codigo es el codigo proporcionado
    * @param  string $codigo
    * @return array $query
    */
   public static function get_ingreso($codigo) {

      $query = DB::select("SELECT * FROM ingresos WHERE codigo ='".$codigo."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los ingresos menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_ingreso($id) {

      $query = DB::select("SELECT * FROM ingresos WHERE id !=".$id);

      return $query;
   }

}
