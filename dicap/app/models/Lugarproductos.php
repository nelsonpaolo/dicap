<?php
class Lugarproductos extends Eloquent {

   protected $table = 'lugarproductos';

   /**
    * función que retorna todos los registros donde el idlugar sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_lugar($id) {

      $query = DB::select("SELECT * FROM lugarproductos WHERE idlugar ='".$id."' ORDER BY idproducto");

      return $query;
   }

   /**
    * función que retorna la suma de las cantidades donde el idlugar sea igual al id proporcionado
    * @param  int $id
    * @return int $suma
    */
   public static function get_total_cantidad($id) {

      $query = DB::select("SELECT SUM(cantidad) AS 'total' FROM lugarproductos WHERE idlugar ='".$id."'");
      foreach ($query as $value) {
         $suma = $value->total;
      }

      return $suma;
   }

   /**
    * función que retorna todos los registros donde el idproducto sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_producto($id) {

      $query = DB::select("SELECT * FROM lugarproductos WHERE idproducto ='".$id."'");

      return $query;
   }

   /**
    * función que recibe los datos de idproducto, idlugar y cantidad para crear un nuevo registro en la tabla lugarproductos, si ya existe el registro con el producto y lugar entonces le suma la cantidad a la cantidad actual
    * @param  int $idproducto
    * @param  int $idlugar
    * @param  int $cantidad
    */
   public static function agregar_cantidad($idproducto, $idlugar, $cantidad) {

      $existe = Lugarproductos::get_producto_lugar($idproducto, $idlugar);

      if($existe) {

         $lugarproducto = $existe;

         $lugarproducto->cantidad = $lugarproducto->cantidad + $cantidad;

         $lugarproducto->save();
      }
      else {

         $lugarproducto = new Lugarproductos();

         $lugarproducto->idproducto = $idproducto;
         $lugarproducto->idlugar = $idlugar;
         $lugarproducto->cantidad = $cantidad;

         $lugarproducto->save();  
      }
   }

   /**
    * función que recibe los datos de idproducto, idlugar y cantidad para disminuir la cantidad del registro del cual el idlugar y el id producto sean iguales a los proporcionados
    * @param  int $idproducto
    * @param  int $idlugar
    * @param  int $cantidad
    */
   public static function disminuir_cantidad($idproducto, $idlugar, $cantidad) {

      $lugarproducto = Lugarproductos::get_producto_lugar($idproducto, $idlugar);

      $lugarproducto->cantidad = $lugarproducto->cantidad - $cantidad;

      $lugarproducto->save();
   }

   /**
    * función que retorna un arreglo con los datos del regitro del cual su idlugar e idproducto sean iguales a los proporcionados
    * @param  int $idproducto
    * @param  int $idlugar
    * @return array $query
    */
   public static function get_producto_lugar($idproducto, $idlugar) {

      $query = Lugarproductos::where('idproducto', $idproducto)->where('idlugar', $idlugar)->first();

      return $query;
   }

}
