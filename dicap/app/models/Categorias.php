<?php
class Categorias extends Eloquent {

   protected $table = 'categorias';

   /**
    * función que retorna todos las categorias donde la marca sea igual al id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_marca($id) {

      $query = DB::select("SELECT * FROM categorias WHERE marca ='".$id."'");

      return $query;
   }

   /**
    * funcion que retorna los datos del la categoria de la cual su nombre es el nombre proporcionado y su marca es la maraca proporcionada
    * @param  string $nombre
    * @param  int $marca
    * @return array $query
    */
   public static function get_categoria($nombre, $marca) {

      $query = DB::select("SELECT * FROM categorias WHERE nombre ='".$nombre."' AND marca='".$marca."'");

      return $query;
   }

   /**
    * función que retorna los datos de todas las categorias menos de la que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_categoria($id) {

      $query = DB::select("SELECT * FROM categorias WHERE id !=".$id);

      return $query;
   }

   /**
    * funcion que retorna los datos del la categoria de la cual su marca es la maraca proporcionada
    * @param  int $marca
    * @return array $query
    */
   public static function get_categoria_x_marca($marca) {

      $query = DB::select("SELECT * FROM categorias WHERE marca='".$marca."'");

      return $query;
   }

}
