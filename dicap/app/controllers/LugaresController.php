<?php
class LugaresController extends BaseController {

   private $private;
   
   public function __construct() {

      $this->autorizado = (Auth::check());
      $this->autorizado2 = (Auth::check() and Auth::user()->level > 1);
   }

	public function index() {
	
		if(!$this->autorizado) return Redirect::to('/auth/login');
	
  		$data['lugares'] = Lugares::all();
  		return View::make('lugares.index', $data);
 	}

	public function show($id) {

		if(!$this->autorizado) return Redirect::to('/auth/login');

		$lugar = Lugares::find($id);

		$data['lugar'] = $lugar;
		$data['productos'] = Lugarproductos::get_lugar($lugar->id);		
		$data['total'] = Lugarproductos::get_total_cantidad($lugar->id);

      	return View::make('lugares.show', $data);
	}

	public function create() {
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$data['lugar'] = new Lugares();

      	return View::make('lugares.save', $data);
	}

	public function store() {

		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$lugar = new Lugares();

		$lugar->nombre = Str::upper(Input::get('nombre'));

		$lugar->save();
		
		return Redirect::to('lugares')->with('notice', 'El Lugar ha sido creado correctamente.');
	}

	public function edit($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$data['lugar'] = Lugares::find($id);

      	return View::make('lugares.edit', $data);
	}

	public function update($id) { 
	
		if(!$this->autorizado2) return Redirect::to('/auth/login');
		
		$lugar = Lugares::find($id);

		$lugar->nombre = Str::upper(Input::get('nombre'));

		$lugar->save();
		
		return Redirect::to('lugares')->with('notice', 'Datos del Lugar modificados correctamente.');

	}

	public function destroy($id) {

		if(!$this->autorizado2) return Redirect::to('/auth/login');

		$lugar = Lugares::find($id);

		$lugar->delete();

      	return Redirect::to('lugares')->with('notice', 'El Lugar ha sido eliminado correctamente.');
	}

	public function pdf() {

		$lugar = Input::get('lugar');
		$suma = 0;

		//CREACIÓN DEL PDF
		$fpdf = new Fpdf('P','mm','Letter');							//Una hoja tamaño carta tiene 216mm de ancho

		//Establecemos los márgenes izquierda, arriba y derecha: 
		$fpdf->SetMargins(20, 20, 20);

		//Establecemos el margen inferior: 
		$fpdf->SetAutoPageBreak(true, 20);

		$fpdf->AddPage();
		$fpdf->SetFont('Arial','BIU',12);
		$fpdf->SetTextColor(0);
		$fpdf->Cell(176, 8, utf8_decode('PRODUCTOS ALMACENADOS EN EL LUGAR '.$lugar), 0, 0, 'C');
		$fpdf->Ln();
		$fpdf->Ln();
		$fpdf->SetFont('Arial','B',10);
		$fpdf->Cell(60, 8, utf8_decode('Cantidad Total Almacenada:'));
		$fpdf->SetFont('Arial','',10);
		$fpdf->Cell(60, 8, Input::get('total'));
		$fpdf->Ln();
		//cabecera de la tabla
		$fpdf->SetFont('Arial','B',9);
		$fpdf->SetTextColor(255);
		$fpdf->SetFillColor(6,42,249);
		$fpdf->SetDrawColor(255);
		$fpdf->Cell(55, 8, utf8_decode('Nombre Producto'), 1, 0, 'C' ,true);
		$fpdf->Cell(45, 8, utf8_decode('Codigo Producto'), 1, 0, 'C' ,true);
		$fpdf->Cell(30, 8, utf8_decode('Marca'), 1, 0, 'C' ,true);
		$fpdf->Cell(30, 8, utf8_decode('Categoría'), 1, 0, 'C' ,true);
		$fpdf->Cell(16, 8, utf8_decode('Cantidad'), 1, 0, 'C' ,true);
		$fpdf->Ln();
		//cuerpo de la tabla
		$fpdf->SetFillColor(224,235,255);
		$fpdf->SetTextColor(0);
		$fpdf->SetFont('Arial','',8);
		for ($i = 1; $i <= Input::get('filas'); $i++) {
			if (Input::has('codigo'.$i)) {
				$suma = $suma + Input::get('cantidad'.$i);
				$y1 = $fpdf->GetY();
				if($y1 > 239) {
					$y1 = 20;
				}
				$x1 = $fpdf->GetX();
				$fpdf->MultiCell(55, 6, utf8_decode(Input::get('nombre'.$i)), 1, 'L', true);
				$y2 = $fpdf->GetY();
				$alto_de_fila = $y2 - $y1;
				$posicionX = $x1 + 55;
				$fpdf->SetXY($posicionX,$y1);
				$fpdf->Cell(45, $alto_de_fila, utf8_decode(Input::get('codigo'.$i)), 1, 0, 'C', true);
				$fpdf->Cell(30, $alto_de_fila, utf8_decode(Input::get('marca'.$i)), 1, 0, 'C', true);
				$fpdf->Cell(30, $alto_de_fila, utf8_decode(Input::get('categoria'.$i)), 1, 0, 'C', true);
				$fpdf->Cell(16, $alto_de_fila, utf8_decode(Input::get('cantidad'.$i)), 1, 0, 'C', true);
				$fpdf->Ln();
			}				
		}
		//pie de la tabla
		$fpdf->SetFont('Arial','B',9);
		$fpdf->SetTextColor(255);
		$fpdf->SetFillColor(6,42,249);
		$fpdf->Cell(160, 8, utf8_decode('Total'), 1, 0, 'C' ,true);
		$fpdf->Cell(16, 8, $suma, 1, 0, 'C' ,true);
		$fpdf->Ln();

		//FIN DEL FORMULARIO
		$fpdf->Output('Lugar_'.$lugar.'.pdf', 'D');
		exit;
	}

	public function excel() {

		Excel::create('Lugar_'.Input::get('lugar'), function($excel) {

			$excel->sheet('1', function($sheet) {

				$lugar = Input::get('lugar');
				$cantidad = Input::get('total');
				$suma = 0;

				$sheet->cells('A5:E5', function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});

				$sheet->row(1, array('Nombre del Lugar', $lugar));
				$sheet->row(3, array('Cantidad Total Almacenada:', $cantidad));
				$sheet->row(5, array('CÓDIGO DEL PRODUCTO', 'NOMBRE DEL PRODUCTO', 'MARCA', 'CATEGORÍA', 'CANTIDAD'));
				$fila = 6;
				for ($i = 1; $i <= Input::get('filas'); $i++) {
					if (Input::has('codigo'.$i)) {
						$suma = $suma + Input::get('cantidad'.$i);
			            $sheet->row($fila, array(Input::get('codigo'.$i), Input::get('nombre'.$i), Input::get('marca'.$i), Input::get('categoria'.$i), Input::get('cantidad'.$i)));
			            $fila++;
					}					
				}
				$sheet->mergeCells('A'.$fila.':D'.$fila);
				$sheet->cells('A'.$fila, function($cells) {

				    $cells->setAlignment('center');
				    $cells->setFont(array('bold' => true));

				});
				$sheet->row($fila, array('TOTAL', '', '', '', $suma));

			});			
		}
		)->export('xls');
	}
}
