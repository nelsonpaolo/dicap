<?php
class MarcasController extends BaseController {

   private $private;

   public function __construct() {

      $this->autorizado = (Auth::check());
      $this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
   }

	public function index() {

		if(!$this->autorizado) return Redirect::to('/auth/login');

  		$data['marcas'] = Marcas::all();
  		return View::make('marcas.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['marca'] = Marcas::find($id);

      	return View::make('marcas.show', $data);
	}

	public function create() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['marca'] = new Marcas();

      	return View::make('marcas.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$marca = new Marcas();

		$marca->nombre = Str::upper(Input::get('nombre'));

		$marca->save();

		return Redirect::to('marcas')->with('notice', 'La Marca ha sido creada correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['marca'] = Marcas::find($id);

      	return View::make('marcas.edit', $data);
	}

	public function update($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$marca = Marcas::find($id);

		$marca->nombre = Str::upper(Input::get('nombre'));

		$marca->save();

		return Redirect::to('marcas')->with('notice', 'Datos de la Marca modificados correctamente.');

	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$marca = Marcas::find($id);

		$marca->delete();

      	return Redirect::to('marcas')->with('notice', 'La Marca ha sido eliminada correctamente.');
	}
}
