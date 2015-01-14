<?php
class ClientesController extends BaseController {

   private $private;
   
	public function __construct() {

		$this->autorizado = (Auth::check());
		$this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
	}

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['clientes'] = Clientes::all();
  		return View::make('clientes.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['cliente'] = Clientes::find($id);

      	return View::make('clientes.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['cliente'] = new Clientes();

     	return View::make('clientes.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$cliente = new Clientes();

		$cliente->nombre = Str::upper(Input::get('nombre'));
		$cliente->fono = Input::get('fono');
		$cliente->direccion = Str::upper(Input::get('direccion'));

		$cliente->save();
		
		return Redirect::to('clientes')->with('notice', 'El Cliente ha sido creado correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['cliente'] = Clientes::find($id);

     	return View::make('clientes.edit', $data);
	}

	public function update($id) {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$cliente = Clientes::find($id);

		$cliente->nombre = Str::upper(Input::get('nombre'));
		$cliente->fono = Input::get('fono');
		$cliente->direccion = Str::upper(Input::get('direccion'));

		$cliente->save();
		
		return Redirect::to('clientes')->with('notice', 'Datos del Cliente modificados correctamente.');
	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$cliente = Clientes::find($id);

		$cliente->delete();

     	return Redirect::to('clientes')->with('notice', 'El Cliente ha sido eliminado correctamente.');
	}
}
