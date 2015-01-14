<?php
class Fechas extends Eloquent {

	public static function formatoDiaMesAnio($fecha) {
		$formato = '';
		$meses = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
		if($fecha != '') {
			$datos = explode('-', $fecha);
			$ano = $datos[0];
			$mes = $datos[1];
			$dia = $datos[2];
			$formato = $dia.'-'.$meses[$mes-1].'-'.$ano;
		}
		return $formato;
	}
      
	public static function formatoAnioMesDia($fecha) {

		$meses = array('Ene' => '01',
						'Feb' => '02',
						'Mar' => '03', 
						'Abr' => '04', 
						'May' => '05', 
						'Jun' => '06', 
						'Jul' => '07',
						'Ago' => '08',
						'Sep' => '09', 
						'Oct' => '10', 
						'Nov' => '11', 
						'Dic' => '12');

		$fecha_array = explode('-',$fecha);

		$fechanueva = $fecha_array[2].'-'.$meses[$fecha_array[1]].'-'.$fecha_array[0];

		return $fechanueva;

	}

	public static function formatoCompleto($fecha) {
		$formato = '';
		$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		if($fecha != '') {
			$datos = explode('-', $fecha);
			$ano = $datos[0];
			$mes = $datos[1];
			$dia = $datos[2];
			$formato = $dia.' de '.$meses[$mes-1].' de '.$ano;
		}
		return $formato;
	}	
}