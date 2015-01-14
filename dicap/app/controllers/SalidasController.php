<?php
class SalidasController extends BaseController {

   private $private;
   
	public function __construct() {

		$this->autorizado = (Auth::check());
		$this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
	}

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['salidas'] = Salidas::all();
  		return View::make('salidas.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$salida = Salidas::find($id);

		$data['salida'] = $salida;
		$data['cliente'] = Clientes::find($salida->idcliente);
		$data['lugar'] = Lugares::find($salida->idlugar);
		$data['salidas'] = Salidaproductos::get_salidas($id);

      	return View::make('salidas.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['salida'] = new Salidas();

		$data['clientes'] = Clientes::all();
		$data['lugares'] = Lugares::all();

     	return View::make('salidas.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$bandera = 1;

		for ($k = 1; $k <= Input::get('filasprod'); $k++) {

			if (Input::has('codigo'.$k)) {

				$prod = Input::get('producto'.$k);
				$luga = Input::get('lugar'.$k);
				$cant = Input::get('cantidad'.$k);

				$stock = Lugarproductos::get_producto_lugar($prod, $luga);

				if($stock->cantidad < $cant) {

					$bandera = 0;
				}
			}
		}

		if($bandera == 1) {

			DB::transaction(function() {

				$salida = new Salidas();

				$salida->codigo = Input::get('codigo');
				$salida->iduser = Auth::user()->id;
				$salida->idcliente = Input::get('idcliente');
				$salida->fecha = Fechas::formatoAnioMesDia(Input::get('fecha'));
				$salida->costo = Input::get('costo');

				$salida->save();

				$salida_id = $salida->id;

				for ($i = 1; $i <= Input::get('filasprod'); $i++) {

					if (Input::has('codigo'.$i)) {

						$salidaproductos = new Salidaproductos();

						$salidaproductos->idsalida = $salida_id;
						$salidaproductos->idproducto = Input::get('producto'.$i);
						$salidaproductos->idlugar = Input::get('lugar'.$i);
						$salidaproductos->precio_venta = Input::get('precio'.$i);
						$salidaproductos->cantidad = Input::get('cantidad'.$i);

						$salidaproductos->save();					

						Productos::disminuir_cantidad($salidaproductos->idproducto, $salidaproductos->cantidad);
						Lugarproductos::disminuir_cantidad($salidaproductos->idproducto, $salidaproductos->idlugar, $salidaproductos->cantidad);
					}
				}
			});			
			
			return Redirect::to('salidas')->with('notice', 'La Salida ha sido registrada correctamente.');
		}
		else {
			return Redirect::to('salidas.save')->with('notice', 'La Salida NO ha podido ser registrada, otro usuario ha modificado el Stock, por favor inténtelo nuevamente.');
		}

			
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['salida'] = Salidas::find($id);

		$data['clientes'] = Clientes::all();
		$data['lugares'] = Lugares::all();
		$data['salidas'] = Salidaproductos::get_salidas($id);

     	return View::make('salidas.edit', $data);
	}

	public function update($id) {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');

		DB::transaction(function($id) use ($id) {

			$salida = Salidas::find($id);

			$salida->codigo = Input::get('codigo');
			$salida->iduser = Auth::user()->id;
			$salida->idcliente = Input::get('idcliente');
			$salida->fecha = Fechas::formatoAnioMesDia(Input::get('fecha'));
			$salida->costo = Input::get('costo');

			$salida->save();

			$salida_id = $id;

			$salidas = Salidaproductos::get_salidas($salida_id);
			foreach ($salidas as $value) {
				Productos::agregar_cantidad($value->idproducto, $value->cantidad);
				Lugarproductos::agregar_cantidad($value->idproducto, $value->idlugar, $value->cantidad);
			}

			Salidaproductos::eliminar($salida_id);

			for ($i = 1; $i <= Input::get('filasprod'); $i++) {

				if (Input::has('codigo'.$i)) {

					$salidaproductos = new Salidaproductos();

					$salidaproductos->idsalida = $salida_id;
					$salidaproductos->idproducto = Input::get('producto'.$i);
					$salidaproductos->idlugar = Input::get('lugar'.$i);
					$salidaproductos->precio_venta = Input::get('precio'.$i);
					$salidaproductos->cantidad = Input::get('cantidad'.$i);

					$salidaproductos->save();

					Productos::disminuir_cantidad($salidaproductos->idproducto, $salidaproductos->cantidad);
					Lugarproductos::disminuir_cantidad($salidaproductos->idproducto, $salidaproductos->idlugar, $salidaproductos->cantidad);
				}
			}
		});
		
		return Redirect::to('salidas')->with('notice', 'Datos de la Salida modificados correctamente.');
	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$salida = Salidas::find($id);

		$salida->delete();

      	return Redirect::to('salidas')->with('notice', 'La Salida ha sido eliminada correctamente.');
	}

	public function pdf($id) {

		$salida = Salidas::find($id);
		$cliente = Clientes::find($salida->idcliente);
		$salidas = Salidaproductos::get_salidas($id);

		//CREACIÓN DEL PDF
		$fpdf = new Fpdf('P','mm','Letter');							//Una hoja tamaño carta tiene 216mm de ancho

		//Establecemos los márgenes izquierda, arriba y derecha: 
		$fpdf->SetMargins(20, 20, 20); 

		//Establecemos el margen inferior: 
		$fpdf->SetAutoPageBreak(true, 20);

		$fpdf->AddPage();
		$fpdf->SetFont('Arial','BIU',12);
		$fpdf->SetTextColor(0);
		$fpdf->Cell(176, 8, utf8_decode('DICAP - SALIDAS'), 0, 0, 'C');
		$fpdf->Ln();
		$fpdf->Ln();
   		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Número de Orden de Entrega:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, $salida->codigo);
		$fpdf->Ln();
		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Fecha de la Salida:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, Fechas::formatoCompleto($salida->fecha));
		$fpdf->Ln();
		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Nombre del Cliente:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, utf8_decode($cliente->nombre));
		$fpdf->Ln();
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(176, 8, utf8_decode('Detalle:'));
		$fpdf->Ln();
		//cabecera de la tabla
		$fpdf->SetFont('Arial','B',9);
		$fpdf->SetTextColor(255);
		$fpdf->SetFillColor(6,42,249);
		$fpdf->SetDrawColor(255);
		$fpdf->Cell(50, 8, utf8_decode('Nombre Producto'), 1, 0, 'C' ,true);
		$fpdf->Cell(40, 8, utf8_decode('Codigo Producto'), 1, 0, 'C' ,true);
		$fpdf->Cell(23, 8, utf8_decode('Lugar'), 1, 0, 'C' ,true);
		$fpdf->Cell(24, 8, utf8_decode('Precio Venta'), 1, 0, 'C' ,true);
		$fpdf->Cell(15, 8, utf8_decode('Cantidad'), 1, 0, 'C' ,true);
		$fpdf->Cell(24, 8, utf8_decode('Sub total'), 1, 0, 'C' ,true);
		$fpdf->Ln();
		//cuerpo de la tabla
		$fpdf->SetFillColor(224,235,255);
		$fpdf->SetTextColor(0);
		$fpdf->SetFont('Arial','',8);
		foreach($salidas as $row) {
			$producto = Productos::find($row->idproducto);
            $lugar = Lugares::find($row->idlugar);
			$y1 = $fpdf->GetY();
			if($y1 > 239) {
				$y1 = 20;
			}
			$x1 = $fpdf->GetX();
			$fpdf->MultiCell(50, 6, utf8_decode($producto->nombre), 1, 'L', true);
			$y2 = $fpdf->GetY();
			$alto_de_fila = $y2 - $y1;
			$posicionX = $x1 + 50;
			$fpdf->SetXY($posicionX,$y1);
			$fpdf->Cell(40, $alto_de_fila, utf8_decode($producto->codigo), 1, 0, 'C', true);
			$fpdf->Cell(23, $alto_de_fila, utf8_decode($lugar->nombre), 1, 0, 'C', true);
			$fpdf->Cell(24, $alto_de_fila, round($row->precio_venta * 100) / 100, 1, 0, 'C', true);
			$fpdf->Cell(15, $alto_de_fila, $row->cantidad, 1, 0, 'C', true);
			$fpdf->Cell(24, $alto_de_fila, round($row->precio_venta * $row->cantidad * 100) / 100, 1, 0, 'C', true);
			$fpdf->Ln();
		}
		//pie de la tabla
		$fpdf->SetFont('Arial','B',9);
		$fpdf->SetTextColor(255);
		$fpdf->SetFillColor(6,42,249);
		$fpdf->Cell(152, 8, utf8_decode('Total Precio de Venta'), 1, 0, 'C' ,true);
		$fpdf->Cell(24, 8, round($salida->costo * 100) / 100, 1, 0, 'C' ,true);
		$fpdf->Ln();

		//FIN DEL FORMULARIO
		$fpdf->Output('Salida_'.$salida->codigo.'.pdf', 'D');
		exit;
	}

	public function excel() {

		$id = Input::get('idsalida');
		$salida = Salidas::find($id);

		Excel::create('Salida_'.$salida->codigo, function($excel) {

			$excel->sheet('1', function($sheet) {

				$id = Input::get('idsalida');
				$salida = Salidas::find($id);
				$cliente = Clientes::find($salida->idcliente);
				$salidas = Salidaproductos::get_salidas($id);

				$sheet->mergeCells('A1:F1');

				$sheet->cells('A9:F9', function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});

				$sheet->cells('A1', function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});

				$sheet->row(1, array('DICAP - SALIDAS'));
				$sheet->row(3, array('Número de Orden de Remisión:', $salida->codigo.' '));
				$sheet->row(4, array('Fecha de la Salida:', Fechas::formatoCompleto($salida->fecha)));
				$sheet->row(5, array('Nombre del Cliente:', $cliente->nombre));
				$sheet->row(7, array('Detalle:'));
				$sheet->row(9, array('CÓDIGO DEL PRODUCTO', 'NOMBRE DEL PRODUCTO', 'LUGAR', 'PRECIO VENTA', 'CANTIDAD', 'SUB TOTAL'));
				$fila = 10;
				foreach($salidas as $row) {
					$producto = Productos::find($row->idproducto);
		            $lugar = Lugares::find($row->idlugar);
		            $sheet->row($fila, array($producto->codigo, $producto->nombre, $lugar->nombre, round($row->precio_venta * 100) / 100, $row->cantidad, round($row->precio_venta * $row->cantidad * 100) / 100));
		            $fila++;
				}
				$sheet->mergeCells('A'.$fila.':E'.$fila);
				$sheet->cells('A'.$fila, function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});
				$sheet->row($fila, array('TOTAL PRECIO DE VENTA', '', '', '', '', round($salida->costo * 100) / 100));

			});			
		}
		)->export('xls');
	}
}