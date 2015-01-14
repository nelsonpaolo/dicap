<?php
class Salidaproductos extends Eloquent {

   protected $table = 'salidaproductos';

   /**
    * función que retorna todos los registros donde el idlugar sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_lugar($id) {

      $query = DB::select("SELECT * FROM salidaproductos WHERE idlugar ='".$id."'");

      return $query;
   }

   /**
    * función que retorna todos los registros donde el idproducto sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_producto($id) {

      $query = DB::select("SELECT * FROM salidaproductos WHERE idproducto ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna un arreglo con las salidas que tengan el idsalida igual al id proporcionado
    * @param  int $idsalida
    * @return array $query
    */
   public static function get_salidas($idsalida) {

      $query = DB::select("SELECT * FROM salidaproductos WHERE idsalida ='".$idsalida."'");

      return $query;
   }

   public static function eliminar($idsalida) {

      Salidaproductos::where('idsalida', $idsalida)->delete();
   }

}
