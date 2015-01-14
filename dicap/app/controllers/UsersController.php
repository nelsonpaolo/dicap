<?php
class UsersController extends BaseController {

   private $autorizado;

   public function __construct() {

      $this->autorizado = (Auth::check() and Auth::user()->level == 5);
   }

   public function index() {

      if(!$this->autorizado) return Redirect::to('/auth/login');
      
      $user = Auth::user();
      $users = User::all();
      return View::make('users.index')->with(array('users' => $users, 'user' => $user));
   }

   public function show($id) {

      if(!$this->autorizado) return Redirect::to('/auth/login');

      $user = User::find($id);
      $rol = Roles::find($user->level);
      return View::make('users.show')->with(array('user' => $user, 'rol' => $rol));
   }

   public function create() {

     if(!$this->autorizado) return Redirect::to('/auth/login');

     $user = new User();
     $roles = Roles::all();
     return View::make('users.save')->with(array('user' => $user, 'roles' => $roles));
   }

   public function store() {

      if(!$this->autorizado) return Redirect::to('/auth/login');

      $user = new User();
      $user->real_name = Input::get('real_name');
      $user->fono = Input::get('fono');
      $user->direccion = Input::get('direccion');
      $user->username = Input::get('username');
      $user->password = Hash::make(Input::get('password'));
      $user->level = Input::get('level');
      $user->active = true;
      $validator = User::validate(array(
         'real_name' => Input::get('real_name'),
         'username' => Input::get('username'),
         'password' => Input::get('password'),
         'repassword' => Input::get('repassword'),
         'level' => Input::get('level'),
      ));
      if($validator->fails()) {
         $errors = $validator->messages()->all();
         $user->password = null;
         return View::make('users.save')->with('user', $user)->with('errors', $errors);
      }
      else {
         $user->save();
         return Redirect::to('users')->with('notice', 'El usuario ha sido creado correctamente.');
      }
   }

   public function edit($id) {

      if(!$this->autorizado) return Redirect::to('/auth/login');

      $user = User::find($id);
      $roles = Roles::all();
      return View::make('users.edit')->with(array('user' => $user, 'roles' => $roles));
   }

   public function update($id) {

      if(!$this->autorizado) return Redirect::to('/auth/login');

      $user = User::find($id);
      $user->real_name = Input::get('real_name');
      $user->fono = Input::get('fono');
      $user->direccion = Input::get('direccion');
      $user->username = Input::get('username');
      $user->level = Input::get('level');
      $user->active = Input::get('estado');

      if (Input::get('password')) {
         $validator = User::validate(array(
            'real_name' => Input::get('real_name'),
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'repassword' => Input::get('repassword'),
            'level' => Input::get('level'), 
         ), $user->id);

         $user->password = Hash::make(Input::get('password'));    
      }
      else {
         $validator = User::validate(array(
            'real_name' => Input::get('real_name'),
            'username' => Input::get('username'),
            'password' => $user->password,
            'repassword' => $user->password,
            'level' => Input::get('level'),
         ), $user->id);
      }

      if($validator->fails()) {
         $errors = $validator->messages()->all();
         $user->password = null;
         return View::make('users.edit')->with('user', $user)->with('errors', $errors);
      }
      else {
         $user->save();
         return Redirect::to('users')->with('notice', 'Datos del usuario modificados correctamente.');
      }
   }

   public function destroy($id) {

      if(!$this->autorizado) return Redirect::to('/auth/login');

      $user = User::find($id);
      $user->delete();
      return Redirect::to('users')->with('notice', 'El usuario ha sido eliminado correctamente.');
   }
}