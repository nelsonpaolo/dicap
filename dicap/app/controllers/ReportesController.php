<?php
class ReportesController extends BaseController {

	private $autorizado;

	public function __construct() {

		$this->autorizado = (Auth::check());
	}

	public function getStock() {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$data['productos'] = Productos::all();

		return View::make('reportes.stock',$data);
	}
}
