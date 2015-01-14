<?php
class AuthController extends BaseController {

   public function getLogin() {

      return View::make('auth.login');
   }

   public function postLogin() {

      $user_data = array(
         'username' => Input::get('username'),
         'password' => Input::get('password'),
         'active' => true
      );

      if(Auth::attempt($user_data)) {
         return Redirect::to('auth/welcome');
      }
      else {
         return $this->getLogin()->with('error', 'Los datos no son correctos o su usuario está Inactivo');
      }
   }

   public function getWelcome() {

      if(Auth::check()) {
         $user = Auth::user();
         return View::make('auth.welcome')->with('user', $user);
      }
      else {
         return $this->getLogin();
      }
   }

   public function postWelcome() {

      if(Auth::check()) {
         return View::make('auth.welcome');
      }
      else {
         return $this->getLogin();
      }
   }

   public function getLogout() {

      if(Auth::check()) {
         Auth::logout();
      }
      return Redirect::to('auth/login');
   }
      
   public function getCambiar() {

      $id = Auth::user()->id;
      $data['usuario'] = User::find($id);
      return View::make('auth.cambiar',$data);
   }

   public function postCambiar() {

      $newpass = Input::get("newpass");
      $id = Auth::user()->id;
      $datos = User::find($id);
      $datos->password = Hash::make($newpass);
      $datos->save();
      return View::make('auth.cambiar')->with('notice', 'Datos del usuario modificados correctamente.');
   }
}
