<?php
class ProductosController extends BaseController {

   private $private;
   
	public function __construct() {

		$this->autorizado = (Auth::check());
		$this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
	}

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['productos'] = Productos::all();
  		return View::make('productos.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['producto'] = Productos::find($id);

      	return View::make('productos.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['producto'] = new Productos();

		$data['marcas'] = Marcas::all();

     	return View::make('productos.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$producto = new Productos();

		$producto->codigo = Str::upper(Input::get('codigo'));
		$producto->nombre = Str::upper(Input::get('nombre'));
		$producto->precio_compra = Input::get('precio_compra');
		$producto->precio_venta = Input::get('precio_venta');
		$producto->marca = Input::get('marca');
		$producto->categoria = Input::get('categoria');
		$producto->cantidad = 0;

		$producto->save();
		
		return Redirect::to('productos')->with('notice', 'El Producto ha sido creado correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$producto = Productos::find($id);
		$data['producto'] = $producto;

		$data['marcas'] = Marcas::all();
		$data['categorias'] = Categorias::get_categoria_x_marca($producto->marca);

     	return View::make('productos.edit', $data);
	}

	public function update($id) {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$producto = Productos::find($id);

		$producto->codigo = Str::upper(Input::get('codigo'));
		$producto->nombre = Str::upper(Input::get('nombre'));
		$producto->precio_compra = Input::get('precio_compra');
		$producto->precio_venta = Input::get('precio_venta');
		$producto->marca = Input::get('marca');
		$producto->categoria = Input::get('categoria');

		$producto->save();
		
		return Redirect::to('productos')->with('notice', 'Datos del Producto modificados correctamente.');
	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$producto = Productos::find($id);

		$producto->delete();

      	return Redirect::to('productos')->with('notice', 'El Producto ha sido eliminado correctamente.');
	}
}
