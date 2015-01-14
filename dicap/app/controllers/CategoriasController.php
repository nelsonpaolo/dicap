<?php
class CategoriasController extends BaseController {

   private $private;
   
   public function __construct() {

      $this->autorizado = (Auth::check());
      $this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
   }

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['categorias'] = Categorias::all();
  		return View::make('categorias.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['categoria'] = Categorias::find($id);

      	return View::make('categorias.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['categoria'] = new Categorias();

		$data['marcas'] = Marcas::all();

      	return View::make('categorias.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$categoria = new Categorias();

		$categoria->nombre = Str::upper(Input::get('nombre'));
		$categoria->marca = Input::get('marca');

		$categoria->save();
		
		return Redirect::to('categorias')->with('notice', 'La Categoria ha sido creada correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['categoria'] = Categorias::find($id);

		$data['marcas'] = Marcas::all();

      	return View::make('categorias.edit', $data);
	}

	public function update($id) { 
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$categoria = Categorias::find($id);

		$categoria->nombre = Str::upper(Input::get('nombre'));
		$categoria->marca = Input::get('marca');

		$categoria->save();
		
		return Redirect::to('categorias')->with('notice', 'Datos de la Categoria modificados correctamente.');

	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$categoria = Categorias::find($id);

		$categoria->delete();

      	return Redirect::to('categorias')->with('notice', 'La Categoria ha sido eliminada correctamente.');
	}
}
