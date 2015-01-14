<?php
class IngresosController extends BaseController {

   private $private;
   
	public function __construct() {

		$this->autorizado = (Auth::check());
		$this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
	}

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['ingresos'] = Ingresos::all();
  		return View::make('ingresos.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$ingreso = Ingresos::find($id);

		$data['ingreso'] = $ingreso;
		$data['proveedor'] = Proveedores::find($ingreso->idproveedor);
		$data['ingresos'] = Ingresoproductos::get_ingresos($id);

      	return View::make('ingresos.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['ingreso'] = new Ingresos();

		$data['proveedores'] = Proveedores::all();
		$data['lugares'] = Lugares::all();

     	return View::make('ingresos.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		DB::transaction(function() {

			$ingreso = new Ingresos();

			$ingreso->codigo = Input::get('codigo');
			$ingreso->iduser = Auth::user()->id;
			$ingreso->idproveedor = Input::get('idproveedor');
			$ingreso->fecha = Fechas::formatoAnioMesDia(Input::get('fecha'));
			$ingreso->costo = Input::get('costo');

			$ingreso->save();

			$ingreso_id = $ingreso->id;

			for ($i = 1; $i <= Input::get('filasprod'); $i++) {

				if (Input::has('codigo'.$i)) {

					$ingresoproductos = new Ingresoproductos();

					$ingresoproductos->idingreso = $ingreso_id;
					$ingresoproductos->idproducto = Input::get('producto'.$i);
					$ingresoproductos->idlugar = Input::get('lugar'.$i);
					$ingresoproductos->precio_compra = Input::get('precio'.$i);
					$ingresoproductos->cantidad = Input::get('cantidad'.$i);

					$ingresoproductos->save();

					Productos::agregar_cantidad($ingresoproductos->idproducto, $ingresoproductos->cantidad);
					Lugarproductos::agregar_cantidad($ingresoproductos->idproducto, $ingresoproductos->idlugar, $ingresoproductos->cantidad);
				}
			}
		});			
		
		return Redirect::to('ingresos')->with('notice', 'El Ingreso ha sido Registradp correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['ingreso'] = Ingresos::find($id);

		$data['proveedores'] = Proveedores::all();
		$data['lugares'] = Lugares::all();
		$data['ingresos'] = Ingresoproductos::get_ingresos($id);

     	return View::make('ingresos.edit', $data);
	}

	public function update($id) {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');

		DB::transaction(function($id) use ($id) {

			$ingreso = Ingresos::find($id);

			$ingreso->codigo = Input::get('codigo');
			$ingreso->iduser = Auth::user()->id;
			$ingreso->idproveedor = Input::get('idproveedor');
			$ingreso->fecha = Fechas::formatoAnioMesDia(Input::get('fecha'));
			$ingreso->costo = Input::get('costo');

			$ingreso->save();

			$ingreso_id = $id;

			$ingresos = Ingresoproductos::get_ingresos($ingreso_id);
			foreach ($ingresos as $value) {
				Productos::disminuir_cantidad($value->idproducto, $value->cantidad);
				Lugarproductos::disminuir_cantidad($value->idproducto, $value->idlugar, $value->cantidad);
			}

			Ingresoproductos::eliminar($ingreso_id);

			for ($i = 1; $i <= Input::get('filasprod'); $i++) {

				if (Input::has('codigo'.$i)) {

					$ingresoproductos = new Ingresoproductos();

					$ingresoproductos->idingreso = $ingreso_id;
					$ingresoproductos->idproducto = Input::get('producto'.$i);
					$ingresoproductos->idlugar = Input::get('lugar'.$i);
					$ingresoproductos->precio_compra = Input::get('precio'.$i);
					$ingresoproductos->cantidad = Input::get('cantidad'.$i);

					$ingresoproductos->save();

					Productos::agregar_cantidad($ingresoproductos->idproducto, $ingresoproductos->cantidad);
					Lugarproductos::agregar_cantidad($ingresoproductos->idproducto, $ingresoproductos->idlugar, $ingresoproductos->cantidad);
				}
			}
		});
		
		return Redirect::to('ingresos')->with('notice', 'Datos del Ingreso modificados correctamente.');
	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$ingreso = Ingresos::find($id);

		$ingreso->delete();

      	return Redirect::to('ingresos')->with('notice', 'El Ingreso ha sido eliminado correctamente.');
	}

	public function pdf($id) {

		$ingreso = Ingresos::find($id);
		$proveedor = Proveedores::find($ingreso->idproveedor);
		$ingresos = Ingresoproductos::get_ingresos($id);

		//CREACIÓN DEL PDF
		$fpdf = new Fpdf('P','mm','Letter');							//Una hoja tamaño carta tiene 216mm de ancho

		//Establecemos los márgenes izquierda, arriba y derecha: 
		$fpdf->SetMargins(20, 20, 20); 

		//Establecemos el margen inferior: 
		$fpdf->SetAutoPageBreak(true, 20);

		$fpdf->AddPage();
		$fpdf->SetFont('Arial','BIU',12);
		$fpdf->SetTextColor(0);
		$fpdf->Cell(176, 8, utf8_decode('DICAP - INGRESOS'), 0, 0, 'C');
		$fpdf->Ln();
		$fpdf->Ln();
   		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Número de Orden de Remisión:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, $ingreso->codigo);
		$fpdf->Ln();
		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Fecha del Ingreso:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, Fechas::formatoCompleto($ingreso->fecha));
		$fpdf->Ln();
		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Nombre del Proveedor:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(70, 8, utf8_decode($proveedor->nombre));
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
		$fpdf->Cell(24, 8, utf8_decode('Precio Compra'), 1, 0, 'C' ,true);
		$fpdf->Cell(15, 8, utf8_decode('Cantidad'), 1, 0, 'C' ,true);
		$fpdf->Cell(24, 8, utf8_decode('Sub total'), 1, 0, 'C' ,true);
		$fpdf->Ln();
		//cuerpo de la tabla
		$fpdf->SetFillColor(224,235,255);
		$fpdf->SetTextColor(0);
		$fpdf->SetFont('Arial','',8);
		foreach($ingresos as $row) {
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
			$fpdf->Cell(24, $alto_de_fila, round($row->precio_compra * 100) / 100, 1, 0, 'C', true);
			$fpdf->Cell(15, $alto_de_fila, $row->cantidad, 1, 0, 'C', true);
			$fpdf->Cell(24, $alto_de_fila, round($row->precio_compra * $row->cantidad * 100) / 100, 1, 0, 'C', true);
			$fpdf->Ln();
		}
		//pie de la tabla
		$fpdf->SetFont('Arial','B',9);
		$fpdf->SetTextColor(255);
		$fpdf->SetFillColor(6,42,249);
		$fpdf->Cell(152, 8, utf8_decode('Total Precio de Compra'), 1, 0, 'C' ,true);
		$fpdf->Cell(24, 8, round($ingreso->costo * 100) / 100, 1, 0, 'C' ,true);
		$fpdf->Ln();

		//FIN DEL FORMULARIO
		$fpdf->Output('Ingreso_'.$ingreso->codigo.'.pdf', 'D');
		exit;
	}

	public function excel() {

		$id = Input::get('idingreso');
		$ingreso = Ingresos::find($id);

		Excel::create('Ingresos_'.$ingreso->codigo, function($excel) {

			$excel->sheet('1', function($sheet) {

				$id = Input::get('idingreso');
				$ingreso = Ingresos::find($id);
				$proveedor = Proveedores::find($ingreso->idproveedor);
				$ingresos = Ingresoproductos::get_ingresos($id);

				$sheet->mergeCells('A1:F1');

				$sheet->cells('A9:F9', function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});

				$sheet->cells('A1', function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});

				$sheet->row(1, array('DICAP - INGRESOS'));
				$sheet->row(3, array('Número de Orden de Remisión:', $ingreso->codigo.' '));
				$sheet->row(4, array('Fecha del Ingreso:', Fechas::formatoCompleto($ingreso->fecha)));
				$sheet->row(5, array('Nombre del Proveedor:', $proveedor->nombre));
				$sheet->row(7, array('Detalle:'));
				$sheet->row(9, array('CÓDIGO DEL PRODUCTO', 'NOMBRE DEL PRODUCTO', 'LUGAR', 'PRECIO COMPRA', 'CANTIDAD', 'SUB TOTAL'));
				$fila = 10;
				foreach($ingresos as $row) {
					$producto = Productos::find($row->idproducto);
		            $lugar = Lugares::find($row->idlugar);
		            $sheet->row($fila, array($producto->codigo, $producto->nombre, $lugar->nombre, round($row->precio_compra * 100) / 100, $row->cantidad, round($row->precio_compra * $row->cantidad * 100) / 100));
		            $fila++;
				}
				$sheet->mergeCells('A'.$fila.':E'.$fila);
				$sheet->cells('A'.$fila, function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});
				$sheet->row($fila, array('TOTAL PRECIO DE COMPRA', '', '', '', '', round($ingreso->costo * 100) / 100));

			});			
		}
		)->export('xls');
	}
}
