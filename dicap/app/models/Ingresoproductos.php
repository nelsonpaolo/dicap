<?php
class Ingresoproductos extends Eloquent {

   protected $table = 'ingresoproductos';

   /**
    * función que retorna todos los registros donde el idlugar sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_lugar($id) {

      $query = DB::select("SELECT * FROM ingresoproductos WHERE idlugar ='".$id."'");

      return $query;
   }

   /**
    * función que retorna todos los registros donde el idproducto sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_producto($id) {

      $query = DB::select("SELECT * FROM ingresoproductos WHERE idproducto ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna un arreglo con los ingresos que tengan el idingreso igual al id proporcionado
    * @param  int $idingreso
    * @return array $query
    */
   public static function get_ingresos($idingreso) {

      $query = DB::select("SELECT * FROM ingresoproductos WHERE idingreso ='".$idingreso."'");

      return $query;
   }

   public static function eliminar($idingreso) {

      Ingresoproductos::where('idingreso', $idingreso)->delete();
   }

}
