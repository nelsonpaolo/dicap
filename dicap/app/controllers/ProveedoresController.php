<?php
class ProveedoresController extends BaseController {

   private $private;
   
	public function __construct() {

		$this->autorizado = (Auth::check());
		$this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
	}

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['proveedores'] = Proveedores::all();
  		return View::make('proveedores.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['proveedor'] = Proveedores::find($id);

      	return View::make('proveedores.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['proveedor'] = new Proveedores();

     	return View::make('proveedores.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$proveedor = new Proveedores();

		$proveedor->nombre = Str::upper(Input::get('nombre'));
		$proveedor->fono = Input::get('fono');
		$proveedor->direccion = Str::upper(Input::get('direccion'));

		$proveedor->save();
		
		return Redirect::to('proveedores')->with('notice', 'El Proveedor ha sido creado correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['proveedor'] = Proveedores::find($id);

     	return View::make('proveedores.edit', $data);
	}

	public function update($id) {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$proveedor = Proveedores::find($id);

		$proveedor->nombre = Str::upper(Input::get('nombre'));
		$proveedor->fono = Input::get('fono');
		$proveedor->direccion = Str::upper(Input::get('direccion'));

		$proveedor->save();
		
		return Redirect::to('proveedores')->with('notice', 'Datos del Proveedor modificados correctamente.');
	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$proveedor = Proveedores::find($id);

		$proveedor->delete();

     	return Redirect::to('proveedores')->with('notice', 'El Proveedor ha sido eliminado correctamente.');
	}
}
