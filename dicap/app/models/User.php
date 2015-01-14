<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Eloquent implements UserInterface{

   protected $table = 'users';

   public static $rules = array(
      'real_name' => 'required|min:2',
      'username' => 'required|unique:users,username,id',
      'password' => 'required|same:repassword',
      'level' => 'required|numeric'
   );

   public static $messages = array(
      'real_name.required' => 'El nombre es obligatorio.',
      'real_name.min' => 'El nombre debe contener al menos dos caracteres.',
      'username.required' => 'El username es obligatorio.',
      'username.unique' => 'El username pertenece a otro usuario.',
      'password.required' => 'La contraseña es obligatoria.',
      'password.same' => 'La contraseña de coincidir con la confirmación.',
      'level.required' => 'El nivel es obligatorio.',
      'level.numeric' => 'El nivel debe ser numérico.'
   );

   public static function validate($data, $id=null) {

      $reglas = self::$rules;
      $reglas['username'] = str_replace('id', $id, self::$rules['username']);
      $messages = self::$messages;
      return Validator::make($data, $reglas, $messages);
   }

   public function getAuthIdentifier() {
      return $this->getKey();
   }

   public function getAuthPassword() {
      return $this->password;
   }

   public function getRememberToken() {
       return $this->remember_token;
   }

   public function setRememberToken($value) {
       $this->remember_token = $value;
   }

   public function getRememberTokenName() {
       return 'remember_token';
   }

   /**
    * funcion que retorna los datos del usuario del cual su username es el username proporcionado
    * @param  string $username
    * @return array $query
    */
   public static function get_user($username) {

      $query = DB::select("SELECT * FROM users WHERE username ='".$username."'");

      return $query;
   }

   /**
    * función que retorna los datos de todos los usuarios menos del que tenga el id proporcionado
    * @param  int $id
    * @return array $query
    */
   public static function get_not_user($id) {

      $query = DB::select("SELECT * FROM users WHERE id !=".$id);

      return $query;
   }

}
