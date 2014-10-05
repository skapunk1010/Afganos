<?php
	class reporteCtrl{
		private $modelo;
		private $conexion;

		/**
		 *Constructor
		 */
		function __construct(){
			require('model/reporteMdl.php');
			$this->modelo = new reporteMdl();
		}
		/**
		 *Recibe la acción que se desea ejecutar con respecto
		 *al reporte y ejecuta el método correspondiente.
		 *En caso de que la acción no sea correcta se muestra un error.
		 */
		public function run(){
			switch($_REQUEST['accion']){
				case 'insertar':
					$this->insertar();
					break;

				case 'buscar':
					$this->buscar();
					break;

				case 'eliminar':
					$this->eliminar();
					break;

				default:
					require('view/error.php');
					break;
			}
		}

		/**
		 *Ejecuta la acción insertar un nuevo reporte.
		 */
		public function insertar(){
			if( (isset($_REQUEST['Vehiculo_VIN']) && !empty($_REQUEST['Vehiculo_VIN'])) &&
				(isset($_REQUEST['fechaEntrada']) && !empty($_REQUEST['fechaEntrada'])) &&
				(isset($_REQUEST['status'])		  && !empty($_REQUEST['status'])) )
			{
				require('controller/validadorCtrl.php');
				$Vehiculo_VIN	= $_REQUEST['Vehiculo_VIN'];
				$fechaEntrada	= $_REQUEST['fechaEntrada'];
				$status			= $_REQUEST['status'];
				$detalle		= $_REQUEST['detalle'];

				$Vehiculo_VIN 	= (validadorCtrl::validarVin($Vehiculo_VIN))? $Vehiculo_VIN : die('Formato de VIN no válido');
				$fechaEntrada 	= (validadorCtrl::validarFecha($fechaEntrada))? $fechaEntrada : die('Formato de fecha no válido');
				$status			=  validadorCtrl::validarStatus($status);
				$detalle		= (validadorCtrl::validarTexto($detalle))? $detalle : null;

				$resultado = $this->modelo->insertar($Vehiculo_VIN,$fechaEntrada,$status,$detalle);

				if($resultado){
					require('view/reporteInsertado.php');
				}else{
					require('view/errorReporteInsertado.php');
				}
			}else{
				#Falta algún dato para poder insertar un nuevo reporte.
				#Se consideran los datos que son not null para poder hacer la inserción.
			}
		}

		/**
		 *Ejecuta la acción buscar un reporte existente.
		 */
		public function buscar(){
			if(isset($_REQUEST['numeroReporte']) && !empty($_REQUEST['numeroReporte'])){
				$numeroReporte	= $_REQUEST['numeroReporte'];

				$resultado = $this->modelo->buscar($numeroReporte);

				if($resultado){
					require('view/reporteBuscar.php');
				}else{
					require('view/errorReporteBuscar.php');
				}
			}else{
				#Número de reporte no se introdujo.
			}
		}
		/**
		 *Ejecuta la acción eliminar un reporte existente.
		 */
		public function eliminar(){
			if(isset($_REQUEST['numeroReporte']) && !empty($_REQUEST['numeroReporte'])){
				$numeroReporte	= $_REQUEST['numeroReporte'];

				$resultado = $this->modelo->eliminar($numeroReporte);

				if($resultado){
					require('view/reporteEliminar.php');
				}else{
					require('view/errorReporteEliminar.php');
				}
			}else{
				#Número de reporte no se introdujo.
			}
		}
	}
?>